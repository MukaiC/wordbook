<?php
class QuizModel extends Model{
  public function Index(){
    // !! Retrieve the title and the user's name of all quizzes to list on index page
    $this->query('SELECT quizzes.*, users.name FROM quizzes JOIN users ON quizzes.user_id = users.id ORDER BY created_at DESC');
    $rows = $this->resultSet();
    // echo '<pre>';
    // print_r($rows);
    // echo '</pre>';
    return $rows;
    }

  public function create(){
      // echo 'from models/quiz/create';
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if(isset($post['submit'])){
        if($post['question'] == '' || $post['option1'] == '' || $post['option2'] =='' || $post['option3'] == '' || $post['option4'] ==''){
          Messages::setMsg('Please Fill In all Fields', 'error');
          return;
        }
        elseif(empty($post['correct'])){
          Messages::setMsg('Please choose the correct answer', 'error');
          return;
        }

        // Insert user_id and title to table quizzes
        $this->query('INSERT INTO quizzes (user_id, title) VALUES (:user_id, :title)');
        // Get the loggedin user's id from $_SESSION[user_data] and bind it
        $this->bind(':user_id', $_SESSION['user_data']['id']);
        $this->bind(':title', $post['title']);
        $this->execute();
        // Get the lastinserted id for this quiz
        $quiz_id = $this->lastInsertId();

        // Insert question into MySQL
        $this->query('INSERT INTO questions (content, quiz_id, user_id) VALUES (:content, :quiz_id, :user_id)');
        $this->bind(':content', $post['question']);
        $this->bind(':quiz_id', $quiz_id);
        $this->bind(':user_id', $_SESSION['user_data']['id']);
        $this ->execute();
        // echo 'executed';
        // get the lastinserted id for this questions's options
        $question_id = $this->lastInsertId();
        // echo $question_id;
        // die;
        // if($this->lastInsertId()){
        //   $question_id = $this->lastInsertId();
        //   echo $question_id;
        // } else {
        //   echo 'no question_id';
        //   die;
        // }

        // 　Loop through the options 1-4 and insert them into MySQL
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
          header('Location: '.ROOT_URL.'quizzes');
        }

        // echo '<pre>';
        // print_r($post);
        // echo '</pre>';
        // var_dump($post);
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
       Messages::setMsg('No quizzes yet', 'error');
    } else {
      return $rows;
    }
    // return $rows;
  }


  public function takeAll(){
    // This is for a quizz where all questions are displayed at onece
      if(isset($_POST['submit'])){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          var_dump($post);
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

          // // var_dump ($_SESSION['quiz_data']);
          // // $choice = intval($post['choice']);
          // // $is_correct = $_SESSION['quiz_data']['春'][$choice]['is_answer'];
          // // Check the 'is_answer' value for the chosen option
          // $indexed_array = array_values($_SESSION['quiz_data']);
          // $is_answer = array_values($_SESSION['quiz_data']) [0][$choice]['is_answer'];
          //
          // if($is_answer == 1){
          //   Messages::setMsg('Correct!', 'success');
          // } else {
          //   Messages::setMsg('Wrong!', 'error');
          // }
          // echo $is_correct;
          // echo 'INDEXED';
          // var_dump($indexed_array);
          return;

      } else {

        // Retrieve the quiz from database
        // $this->query('SELECT * FROM questions JOIN options ON options.question_id = questions.id WHERE question_id = 3');

        // Retrieve questions and answer options created by the user whose ID is 1
        // $this->query('SELECT questions.content, options.content, options.is_answer FROM questions INNER JOIN users ON questions.user_id = users.id WHERE users.id = 1 INNER JOIN options ON options.question_id = questions.id' );
        // $this->query('SELECT questions.* FROM questions JOIN users ON questions.user_id = user.id' );

        $this->query('SELECT questions.content, options.content, options.is_answer FROM questions JOIN users ON questions.user_id = users.id JOIN options ON options.question_id = questions.id WHERE users.id = :user_id');

        // Bind the user_id to the current user id
        $userId = $_SESSION['user_data']['id'];
        $this->bind(':user_id', $userId);

        // $this->query('SELECT questions.content, options.content, options.is_answer FROM questions INNER JOIN options ON questions.id = options.question_id WHERE questions.id = 3' );

        // $this->query('SELECT * FROM questions WHERE id = 3');

        // $rows = $this->resultSetGroup();
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
