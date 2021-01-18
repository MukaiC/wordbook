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

  protected function edit(){
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'users/login');
    }
    $viewmodel = new WordModel();
    $this->returnView($viewmodel->edit(), true);
  }

  protected function delete(){
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'users/login');
    }
    $viewmodel = new WordModel();
    $this->returnView($viewmodel->delete(), true);
  }

}
