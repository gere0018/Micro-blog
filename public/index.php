<?php require_once("../includes/db-connect.php")?>
<?php include("../includes/layouts/header.php"); ?>
<?php

// Log in page html code ********************************************************
 if (isset($_POST["selectLogIn"])){
    //create the header for log in form
      $header = '<div class = "formContainer clearfix">
              <form name="Log-in" method="post" action="index.php">
              Username: <input type="text" name="userName" id="userName"/><br/>
              Password: <input type="password" name="password" id="password"/>
              </br></br>
              <input type="submit" name="submitLogIn" id="submitLogIn"
              value="Log In"/></form></div></header>';

 }else if(isset($_POST["submitLogIn"])){
      if(isset($_POST["userName"])){
          $userName = $_POST["userName"];
      }else{
          $userName = "";
      }
      $header = '<div class = "formContainer clearfix">
              <form name="Log-in" method="post" action="index.php">
              Username: <input type="text" name="userName" id="userName" value = "'
              . $userName . '" /><br/>
              Password: <input type="password" name="password" id="password"/>
              </br></br>
              <input type="submit" name="submitLogIn" id="submitLogIn"
              value="Log In"/></form></div></header>';
     echo "debug";

      if (isset($_POST["userName"]) && isset($_POST["password"])){
          // Verify there is data in the variables.
           // if( !empty($_POST['username']) && !empty($_POST['password']) ){
                 //Request Data to validate user name and password
                $sqlQuery = 'SELECT * FROM users
                         WHERE  user_name = "' . $userName . '"';
                $result = $con->query($sqlQuery);
                    if( $result ){
                        while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
                            $correctPassword = $row['user_hash'];
                            if ($correctPassword == md5($_POST["password"])){
                                $header .= "password is correct";
                                $loggedIn = true;
                            }else{
                                $loggedIn = false;
                                $header .= "password incorrect";
                            }
                        }
                        if($loggedIn == true){
                            // create the logged in form
                        }else{
                            // bring them back to login page
                        }



//                    }else{
//                        $header .= "Please enter a user name and password";
//                    }
//

            }
      }


 }else if (isset($signUp)){
        //create the header for signUp form
           $signUp = $_POST["btnSignUp"];

 }else{
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
            </div>
        </header>';

      }


?>
<!-- Request data: Pass the query to the PDO's query() method-->
     <?php $sqlQuery = " SELECT m.messages_text, m.time_stamp, u.user_name
                         FROM messages AS m INNER JOIN users AS u
                         ON m.user_id = u.user_id
                         ORDER BY m.time_stamp DESC";

            $result = $con->query($sqlQuery);
//  Use data: Loop through the results of the PDO query with while loop

// Landing page html code ********************************************************

if( $result ){
          $output = "<ul>";
         while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
             $output .= "<li><p>" . $row['messages_text'] . "</p>\n\t\t" .
                       "<p class = 'timeStamp'>" . "Posted by " . $row['user_name'].
                       " at " . $row['time_stamp'] . "</p></li></br>";
         }
         $output .= "</ul>";

     }else{
//         if $result was not set display error messages from our link
         $output = "<p>" . mysqli_error($con ) . "</p>\n\t\t";
      }
        ?>

<?php echo $header; ?>
<div class = "pageBodyContainer">
    <h1>Blog Messages</h1>
    <div class = "messages">
        <?php echo $output; ?>

    </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>
