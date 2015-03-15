<?php
  //header for the landing page
$header = '<div class = "formContainer clearfix">
         <form name="formLogin" method="post" action="index.php">
         <input class ="btn" type="submit" name="selectLogIn" id="selectLogIn"
         value="Log in" /></form>
         <p> Or </p>
         <form name="formSignUp" method="post" action="signUp.php">
          <input class ="btn" type="submit" name="btnSignUp" id="btnSignUp"
          value="Sign up" />
        </form>
        <p>'. $alertMsg1 . '</p>
        </div>
        </header>';
$msgBox = '';

?>
