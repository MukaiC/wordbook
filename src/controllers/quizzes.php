<?php
class Quizzes extends Controller{
  protected function Index(){
    // echo 'QUIZZES/INDEX';
    $viewmodel = new QuizModel();
    $this->returnView($viewmodel->Index(), true);
  }
}
