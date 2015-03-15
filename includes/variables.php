<?php
//variables that will contain the html
$header = '';
$output = '';
$alertMsg1 = '';
$alertMsg2 = '';
$queryMsg = '';
$msgBox = '';
$user_name = '';
$message = '';
//session variables
if(isset($_POST['userName'])) {
    if(!empty(trim($_POST["userName"]))){
       $userName = trim($_POST['userName']);
        $user_name = $userName;
    }else{
      $alertMsg1 = 'Please enter a valid user name to log in';
    }
}
if(isset($_POST['password'])) {
    if(!empty(trim($_POST["password"]))){
       $password = md5(trim($_POST["password"]));
    }else{
      $alertMsg2 = 'Please enter a valid password to log in';
    }
}
if(isset($_POST['message'])) {
    if(!empty(trim($_POST["message"]))){
       $message = $_POST['message'];
    }
}


?>
