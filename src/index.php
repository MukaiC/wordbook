<?php

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start Session
session_start();

// Include config
require 'config.php';
require 'classes/Messages.php';
require 'classes/Bootstrap.php';
require 'classes/Controller.php';
require 'classes/Model.php';
require 'controllers/home.php';
require 'controllers/users.php';
require 'controllers/words.php';
require 'controllers/quizzes.php';
require 'models/home.php';
require 'models/user.php';
require 'models/word.php';
require 'models/quiz.php';

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
  $controller->executeAction();
}
