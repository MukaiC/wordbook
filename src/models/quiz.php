<?php
class QuizModel extends Model{
  public function Index(){
    // Retrieve the title and the user's name of all quizzes to list on index page
    $this->query('SELECT quizzes.*, users.name FROM quizzes JOIN users ON quizzes.user_id = users.id ORDER BY created_at DESC');
    $rows = $this->resultSet();
    // print_r($rows);
    return $rows;
  }

  public function manage(){
    // echo 'QUIZZES/MANAGE PAGE';
    // Retrieve all quizzes created by the logged in user
    $this->query('SELECT quizzes.* FROM quizzes JOIN users ON quizzes.user_id = users.id WHERE users.id = :user_id ORDER BY created_at DESC');
    $this->bind(':user_id', $_SESSION['user_data']['id']);
    $rows = $this->resultSet();
    // print_r($rows);
    return $rows;
  }

  public function edit(){
    // if(isset($_POST['submit'])){
    if(isset($_POST['submit'])){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // echo '<pre>';
      // print_r($post);
      // echo '</pre>';

      // !!!Validation-form dissapears when merror message is shown
      // Make sure all fields are filled

      foreach($post as $key => $value){
        if($value == ''){
          Messages::setMsg('Please Fill In All Fields', 'error');
          return;
        }
      }

      // if($post['title'] ==''){
      //   Messages::setMsg('Please Fill In Title', 'error');
      //   return;
      // }
      //
      // for($q = 1; $q <= $post['num-questions']; $q++){
      //   if($post["question{$q}"] == ''){
      //     Messages::setMsg('Please Fill In All Questions', 'error');
      //     return;
      //   }
      //   for($i = 1; $i < 5; $i++){
      //     if($post["question{$q}option{$i}"] == ''){
      //       Messages::setMsg('Please Fill In All Answer Options', 'error');
      //   }
      //   return;
      //   }
      // }

      // Update Title
      $this->query('UPDATE quizzes SET title = :title WHERE quizzes.id = :quiz_id');
      $this->bind(':title', $post['title']);
      $this->bind(':quiz_id', $post['quiz-id']);
      $this->execute();

      // Update questions
      $num_questions = $post['num-questions'];
      for($q = 1; $q <= $num_questions; $q++ ){
        $this->query('UPDATE questions SET content = :question WHERE questions.id = :question_id');
        $this->bind(':question', $post["question{$q}"]);
        $this->bind(':question_id', $post["question{$q}-id"]);
        $this->execute();

        // Update answer options
        for ($i = 1; $i < 5; $i++){
          $this->query('UPDATE options SET is_answer = :is_answer, content = :option WHERE options.id = :option_id');
          $this->bind(':option', $post["question{$q}option{$i}"]);
          // 'correct1' means correct answer for question 1
          if($post["correct{$q}"] == "option{$i}"){
            $this->bind(':is_answer', true);
          } else {
            $this->bind(':is_answer', false);
          }
          $this->bind(':option_id', $post["question{$q}option{$i}-id"]);
          $this->execute();
        }
      }



      // Redirect to quizes manage page
      header('Location: '.ROOT_URL.'quizzes/manage');
    }

    // Request to edit a quiz
    if(isset($_GET['quiz_id'])){
      $quiz_id = intval($_GET['quiz_id']);
      // Retrieve the quiz title
      $this->query('SELECT * FROM quizzes WHERE quizzes.id = :quiz_id');
      $this->bind(':quiz_id', $quiz_id);
      $row = $this->single();
      // echo $row['user_id'];
      // echo $_SESSION['user_data']['id'];
      // Make sure if the logged in user is the author of the quiz
      if($row['user_id'] != $_SESSION['user_data']['id']){
        // Logged in user is not the author
        // Redirect to manage quiz page
        header('Location: '.ROOT_URL.'quizzes/manage');
      } else {
        // Logged in user is the author of the quiz
        // Retrieve the questions and options
        // Quiz title
        $title = $row['title'];

        $this->query('SELECT questions.id, questions.content, options.id, options.content, options.is_answer FROM quizzes JOIN questions ON questions.quiz_id = quizzes.id JOIN options ON options.question_id = questions.id WHERE quizzes.id = :quiz_id');
        $this-> bind(':quiz_id', $quiz_id);

        $rows = $this->resultSetGroup();


        // Count the number of questions
        $num_questions = count($rows);

        $quiz_data = array('title' => $title, 'quiz_id' => $quiz_id, 'questions' => $rows, 'num_questions' => $num_questions );
        // echo '<pre>';
        // print_r($quiz_data);
        // echo '</pre>';
        return $quiz_data;
      }
    }
    return;
  }

  public function delete(){
    if(isset($_POST['submit'])){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // print_r ($post);
      $quiz_id = $post['quiz_id'];
      $this->query('DELETE FROM quizzes WHERE id = :quiz_id');
      $this->bind(':quiz_id', $quiz_id);
      $this->execute();

      header('Location: '.ROOT_URL.'quizzes/manage');
      exit;
    }

    // Request to delete a quiz
    if(isset($_GET['id']) && !isset($_POST['submit'])){
      $quiz_id = intval($_GET['id']);
      // Retrieve the quiz title
      $this->query('SELECT * FROM quizzes WHERE quizzes.id = :quiz_id');
      $this->bind(':quiz_id', $quiz_id);
      $row = $this->single();
      print_r($row);
      return $row;
    }
  }

  public function create(){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // Cancel button is pressed
    if(isset($post['cancel'])){
      if(isset($_SESSION['create_data'])){
        // Delete the quiz
        $this->query('DELETE FROM quizzes WHERE quizzes.id = :quiz_id');
        $this->bind(':quiz_id', $_SESSION['create_data']['quiz_id']);
        $this->execute();
        // Clear create_data
        unset($_SESSION['create_data']);
        // Redirect to quizzes index
        header('Location: '.ROOT_URL.'quizzes/index');
        exit;
      } else {
        // Redirect to quizzes index
        header('Location: '.ROOT_URL.'quizzes/index');
        exit;
      }
    }
    // Form is submitted
    if(isset($post['submit']) || isset($post['submit-last'])){
      // Make sure all fields are filled
      if($post['title'] == '' || $post['question'] == '' || $post['option1'] == '' || $post['option2'] =='' || $post['option3'] == '' || $post['option4'] ==''){
        Messages::setMsg('Please Fill In all Fields', 'error');
        return;
      } elseif(empty($post['correct'])){
        Messages::setMsg('Please choose the correct answer', 'error');
        return;
      }

      // First question
      if(!isset($_SESSION['create_data'])){
        // First question of a new quiz
        // Insert user_id and title to table quizzes
        $this->query('INSERT INTO quizzes (user_id, title) VALUES (:user_id, :title)');

        // Get the loggedin user's id from $_SESSION[user_data] and bind it
        $this->bind(':user_id', $_SESSION['user_data']['id']);
        // $this->bind(':user_id', 1);
        $this->bind(':title', $post['title']);
        $this->execute();

        // Get lastinserted id for this quiz
        $quiz_id = $this->lastInsertId();

        // Insert question into MySQL
        $this->query('INSERT INTO questions (content, quiz_id) VALUES (:content, :quiz_id)');
        $this->bind(':content', $post['question']);
        $this->bind(':quiz_id', $quiz_id);
        $this ->execute();

        // Get the lastinserted id for this questions's options
        $question_id = $this->lastInsertId();

        // Loop through the options 1-4 and insert them into MySQL
        for($i = 1; $i < 5; $i++){
          $this->query('INSERT INTO options (question_id, content, is_answer) VALUES (:question_id, :content, :is_answer)');
          $this->bind(':question_id', $question_id);
          $this->bind(':content', $post["option{$i}"]);
          if($post['correct'] == "{$i}"){
            $this->bind(':is_answer', true);
          } else {
            $this->bind(':is_answer', false);
          }
          $this->execute();
        }
        if($this->lastInsertId()){
          // Store quiz_id in session data
          $_SESSION['create_data'] = array (
            'quiz_id' => $quiz_id,
            'title' => $post['title'],
            'num_question' => 1
          );
          // stay on the same page
          // return;
          header('Location: '.ROOT_URL.'quizzes/create');
          exit;
        }

      } else {
        // Not first question
        $quiz_title = $_SESSION['create_data']['title'];
        $quiz_id = $_SESSION['create_data']['quiz_id'];
        // Insert question with the same quiz_id
        $this->query('INSERT INTO questions (content, quiz_id) VALUES (:content, :quiz_id)');
        $this->bind(':content', $post['question']);
        $this->bind(':quiz_id', $quiz_id);
        $this ->execute();
        // get the lastinserted id for this questions's options
        $question_id = $this->lastInsertId();
        // insert answer choices
        for($i = 1; $i < 5; $i++){
          $this->query('INSERT INTO options (question_id, content, is_answer) VALUES (:question_id, :content, :is_answer)');
          $this->bind(':question_id', $question_id);
          $this->bind(':content', $post["option{$i}"]);
          if($post['correct'] == "{$i}"){
            $this->bind(':is_answer', true);
          } else {
            $this->bind(':is_answer', false);
          }
          $this->execute();
        }
        // Answer options successfully inserted
        if($this->lastInsertId()){
          // Increment num_question in session
          $_SESSION['create_data']['num_question']++;
          // In case of the last question
          if(isset($post['submit-last'])){
            // clear create_data
            unset($_SESSION['create_data']);
            // redirect to quizzes index
            header('Location: '.ROOT_URL.'quizzes/index');
            exit;
          } else {
            // redirect to create page for next question
            header('Location: '.ROOT_URL.'quizzes/create');
            exit;
            // return;
          }
        }
      }
    }
    return;
  }


  public function take(){
    /*This is for a quizz page where questions are displayed one at a time*/
    // Id of the selected quiz
    if(isset($_GET['id'])){
      $quiz_id = intval($_GET['id']);
      // echo $quiz_id;
    } else {
      Messages::setMsg('Quiz not found', 'error');
      // Redirect
      header('Location: '.ROOT_URL.'quizzes');
    }
    // Retrieve the quiz
    $this->query('SELECT questions.content, options.content, options.is_answer FROM quizzes JOIN questions ON questions.quiz_id = quizzes.id JOIN options ON options.question_id = questions.id WHERE quizzes.id = :quiz_id');
    $this-> bind(':quiz_id', $quiz_id);
    $rows = $this->resultSetGroup();
    // echo '<pre>';
    // print_r($rows);
    // echo '</pre>';
    if(!$rows){
       Messages::setMsg('No quiz yet', 'error');
    } else {
      return $rows;
    }
    // return $rows;
  }

  // This is to display a quizz with all questions at onece
  // !!Query does not work (table altered)
  public function takeAll(){
      if(isset($_POST['submit'])){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          // var_dump($post);
          // Messages::setMsg('Answer is submitted', 'success');
          // Check if the answer is correct
          // echo 'session data:';

          // Put the submitted chosen answers into an array
          $choices = array();
          // Check the number of questions
          $num_q = count($_SESSION['quiz_data']);
          // Add the choices into an array
          for($i = 0; $i < $num_q; $i++){
            $choices[] = intval($post["choice{$i}"]);
          }
          echo 'CHOICES';
          var_dump($choices);
          echo 'NUMBER OF QUESTIONS IS: ';
          echo $num_q;

          // Loop through the answers and count the correct answers
          $score = 0;
          $question = 0;
          foreach($choices as $choice){
            // $indexed_array = array_values($_SESSION['quiz_data']);
            $is_answer = array_values($_SESSION['quiz_data']) [$question][$choice]['is_answer'];
            if($is_answer == 1){
              $score++;
              $question++;
            }
          }
          Messages::setMsg("You scored {$score} out of {$num_q}", 'success');
          return;
      } else {
        // !!! Need to modified, question.user_id does not exist amy more
        $this->query('SELECT questions.content, options.content, options.is_answer FROM questions JOIN users ON questions.user_id = users.id JOIN options ON options.question_id = questions.id WHERE users.id = :user_id');
        // Bind the user_id to the current user id
        $userId = $_SESSION['user_data']['id'];
        $this->bind(':user_id', $userId);
        $rows = $this->resultSetGroup();
        // echo '<pre>';
        // print_r($rows);
        // echo '</pre>';
        // var_dump($rows);
        // print_r($rows);
        // Store $row in session to check the answer once it is submitted
        if($rows){
          $_SESSION['quiz_data'] = $rows;
        } else {
          Messages::setMsg('No quizzes yet', 'error');
        }
        return $rows;
      }
    }
  }
