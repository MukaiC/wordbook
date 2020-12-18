<?php
class Words extends Controller{
  protected function Index(){
    // Make sure the user is logged in
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'users/login');
    }
    $viewmodel = new WordModel();
    $this->returnView($viewmodel->Index(), true);
  }

  protected function add(){
    $viewmodel = new WordModel();
    $this->returnView($viewmodel->add(), true);
  }
  //
  // protected function search(){
  //   $viewmodel = new WordModel();
  //   $this->returnView($viewmodel->index(), true);
  // }
  //
  // protected function results(){
  //   // echo 'WORDS/RESULTS';
  //   $viewmodel = new WordModel();
  //   $this->returnView($viewmodel->results(), true);
  // }
}
