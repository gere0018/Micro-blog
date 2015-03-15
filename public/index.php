<?php require("../includes/db-connect.php"); ?>
<?php require("../includes/variables.php"); ?>
<?php
//Create header for the landing page/default page
include("../includes/layouts/landing.php");

 if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
  include("../includes/layouts/loggedIn.php");
 }

// When user selects to log in he will be directed to login form.
 if (isset($_POST["selectLogIn"])){
   include("../includes/layouts/logIn.php");
 }
//When user fills his username and password and submits the login form
 if(isset($_POST["submitLogIn"])){
     include("../includes/layouts/logIn.php");
       if(!empty($userName) && !empty($password)){
           // 2-Request Data to validate user name and password
            $sqlQuery_checkNamePassword = 'SELECT * FROM users
                        WHERE  user_name = "' . $userName .
                        '" AND user_hash = "' . $password .  '"';
            $result1 = $con->query($sqlQuery_checkNamePassword);
           //if query is successful
            if($result1){
                //there should be only one result
                if( $result1->rowCount() == 1){
                    $row = $result1->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    include("../includes/layouts/loggedIn.php");
                }else{
                    include("../includes/layouts/landing.php");
                    $alertMsg1 = 'User info is not correct!!';

                }
            }else{
            // query has failed to run
               $queryMsg = "query failed";
            }
         }

}
 if(isset($_POST["logOut"])){
     session_destroy();
     include("../includes/layouts/landing.php");
 }
if(isset($_POST["postMessage"])){
    if(!empty($message)){
        $sqlQuery_addMessage = 'INSERT INTO `messages`
                                    (`user_id`, `messages_text`)
                                  VALUES ("'. $_SESSION['user_id'] .'", "' .
                                    $message . '")';
                    $result2 = $con->query($sqlQuery_addMessage);

    }



}


?>
<!--The body for all pages **************************************************-->
<!-- Request data: Pass the query to the PDO's query() method-->
<?php
    $sqlQuery_getMessages = " SELECT m.messages_text, m.time_stamp, u.user_name
                             FROM messages AS m INNER JOIN users AS u
                             ON m.user_id = u.user_id
                             ORDER BY m.time_stamp DESC";

    $result = $con->query($sqlQuery_getMessages);
    //  Use data: Loop through the results of the PDO query with while loop
    if( $result ){
              $output = "<ul>";
             while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
                 $output .= "<li><p>" . $row['messages_text'] . "</p>\n\t\t" .
                           "<p class = 'timeStamp'>" . "Posted by " .
                            $row['user_name'].
                           " at " . $row['time_stamp'] . "</p></li></br>";
             }
             $output .= "</ul> </div>";

    }else{
    //         if $result was not set display error messages from our link
         $output = "<p>" . mysqli_error($con ) . "</p>\n\t\t";
      }

?>

<!--pages output **************************************************************-->
<?php include("../includes/layouts/header.php"); ?>
<!-- echo the header variable that changes the header for every page -->
            <?php echo $header; ?>

    <div class = "pageBodyContainer">
        <h1>Blog Messages</h1>
        <div class = "messages">
<!-- echo the output variable that changes the body content for every page-->
            <?php echo $output;
                  echo $msgBox;
            ?>


    </div>

<?php include("../includes/layouts/footer.php"); ?>
