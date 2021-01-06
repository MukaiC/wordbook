<?php
class Quizzes extends Controller{
  protected function Index(){
    // echo 'QUIZZES/INDEX';
    $viewmodel = new QuizModel();
    // Quizzes index page rendered through main.php
    $this->returnView($viewmodel->Index(), true);
    // $this->returnView($viewmodel->Index(), false);
  }

  protected function create(){
    // Make sure the user is logged in
    if(!isset($_SESSION['is_logged_in'])){
      $_SESSION['next'] = 'quizzes/create';
      header('Location: '.ROOT_URL.'users/login');
    }
    $viewmodel = new QuizModel();
    $this->returnView($viewmodel->create(), true);
  }

  protected function take(){
    $viewmodel = new QuizModel();
    $this->returnView($viewmodel->take(), true);
  }

  protected function takeAll(){
    $viewmodel = new QuizModel();
    $this->returnView($viewmodel->takeAll(), true);
  }
}
