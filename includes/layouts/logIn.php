<?php //The header for log in page that contains the log in form
$header = '<div class = "formContainer clearfix">
              <form name="Log-in" method="post" action="index.php"><p>'.
              $alertMsg1 . '</p>
              Username: <input type="text" name="userName" id="userName" value = "'
              . $user_name . '" /><br/><p>'. $alertMsg2. '</p>
              Password: <input type="password" name="password" id="password"/>
              </br></br>
              <input type="submit" name="submitLogIn" id="submitLogIn"
              value="Log In"/></form></div></header>';

    ?>
