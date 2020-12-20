<?php
class WordModel extends Model{
  public function Index(){
    // If search form is submitted
    if(isset($_POST['submit'])){
        $_SESSION['is_search'] = true;
      // $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // $this->query('SELECT * FROM words WHERE entry LIKE :keyword');
      // $search = $post['keyword'];
      // $this->bind(':keyword', '%'.$search.'%');
      // $rows = $this->resultSet();
      // // print_r($rows);
      // print_r($_POST);
      $rows = $this->search();
      // return $rows;

      // $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // $this->search();
    } else {
      if(!isset($_SESSION['is_logged_in'])){
        // Redirect
        header('Location: '.ROOT_URL.'users/login');
      } else {
        $this->query('SELECT * FROM words WHERE user_id = :user_id ORDER BY create_date DESC');
        $this->bind(':user_id', $_SESSION['user_data']['id']);
        $rows = $this->resultSet();
      }

      // return $rows;
    }

  //   $this->query('SELECT * FROM words ORDER BY create_date DESC');
  //   $rows = $this->resultSet();
    return $rows;
    $_SESSION['is_search'] = false;
  }

  public function add(){
    //Sanitize POST
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if(isset($post['submit'])){
      if($post['entry'] == '' || $post['meaning'] ==''){
        Messages::setMsg('Please Fill In both Word/Phrase and Meaning Fields', 'error');
        return;
      }

      // Insert into MySQL
      $this->query('INSERT INTO words (entry, meaning, notes, user_id) VALUES (:entry, :meaning, :notes, :user_id)');
      $this->bind(':entry', $post['entry']);
      $this->bind(':meaning', $post['meaning']);
      $this->bind(':notes', $post['notes']);
      $this->bind(':user_id', $_SESSION['user_data']['id']);
      // $this->bind(':user_id', 1);
      $this->execute();
      // Verify
      if($this->lastInsertId()){
        // Redirect
        header('Location: '.ROOT_URL.'words');
      }
    }
    return;
  }

  public function search(){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // // Search word in entry and meaning collums
    // $this->query('SELECT * FROM words WHERE user_id = :user_id AND (entry LIKE :keyword OR meaning LIKE :keyword)');
    // // Alternative to the above query
    // // $this->query('SELECT * FROM words WHERE user_id = :user_id AND entry LIKE :keyword UNION SELECT * FROM words WHERE user_id = :user_id AND meaning LIKE :keyword');

    // If the value of $post['submit'] == 'meaning';
    if($post['submit'] == 'Search meaning'){
      $this->query('SELECT * FROM words WHERE user_id = :user_id AND meaning LIKE :keyword');
      // echo 'searching meaning';
    } elseif($post['submit'] == 'Search notes'){
      $this->query('SELECT * FROM words WHERE user_id = :user_id AND notes LIKE :keyword');
      // echo 'searching notes';
    } else {
      $this->query('SELECT * FROM words WHERE user_id = :user_id AND entry LIKE :keyword');
      // echo 'searching entry';
    }

    $search = $post['keyword'];
    $this->bind(':user_id', $_SESSION['user_data']['id']);
    $this->bind(':keyword', '%'.$search.'%');
    $rows = $this->resultSet();
    return $rows;
  }
  //  Multiple word search - not working
  //   $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  //   $search = $post['keyword'];
  //
  //   $numWord = str_word_count($search, 0);
  //   if ($numWord > 1){
  //     $keywords = explode(' ', $search);
  //     var_dump($keywords);
  //     $this->query = 'SELECT * FROM words WHERE';
  //     $i = 0;
  //       foreach($keywords as $keyword){
  //         $keyword = trim($keyword);
  //         if($i == 0){
  //           $this->query.=' entry LIKE :keyword OR meaning LIKE :keyword';
  //           echo $this->query;
  //           $this->bind(':keyword', '%'.$keyword.'%');
  //         } else {
  //           $this->query.=' UNION entry LIKE :keyword OR meaning LIKE :keyword';
  //           $this->bind(':keyword', '%'.$keyword.'%');
  //         }
  //           echo $this->query;
  //           $i++;
  //       }
  //   } else {
  //     $this->query('SELECT * FROM words WHERE entry LIKE :keyword OR meaning LIKE :keyword');
  //     $search = $post['keyword'];
  //     $this->bind(':keyword', '%'.$search.'%');
  //   }
  //
  //   $rows = $this->resultSet();
  //   return $rows;
  // }


}
