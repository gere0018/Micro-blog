<?php
  //header for the loggedIn page
          $header = '<div class = "formContainer clearfix">
            <p id = "welcomeMsg">Welcome ' . $_SESSION['user_name'] . '</p>
            <form name="Log-out" method="post" action="index.php">
                <input class ="btn" type="submit" name="logOut" id="logOut"
                value="Log Out" />
            </form>
            </div>
        </header>';
         $msgBox = '<form id = "msgBox" class = "clearfix" name="postMessage"
                    method="post" action="index.php">
                    <input id= "msgContainer" type = "text" name = "message"
                    id = "message">
                    <input class = "btn" type = "submit" name = "postMessage"
                    id = "postMessage" value = "Post Message">
                    </form>';


?>
