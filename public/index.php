<?php require_once("../includes/db-connect.php")?>
<?php include("../includes/layouts/header.php"); ?>
<?php
$header = '<div class = "formContainer clearfix">
            <form name="formLogin" method="post" action="index.php">
                <input class ="btn" type="submit" name="btnLogIn" id="btnLogIn" value="Log in" />
            </form>
             <p> Or </p>
             <form name="formSignUp" method="post" action="signUp.php">
                <input class ="btn" type="submit" name="btnSignUp" id="btnSignUp" value="Sign up" />
            </form>
            </div>
        </header>';
?>
<!-- 2- request data: Pass the query to the PDO's prepare() method-->
     <?php $sqlQuery = " SELECT m.messages_text, m.time_stamp, u.user_name
                         FROM messages AS m INNER JOIN users AS u
                         ON m.user_id = u.user_id
                         ORDER BY m.time_stamp DESC";

            $result = $con->query($sqlQuery);
// 3- Loop through the results of the PDO query with while loop
     if( $result ){
          $output = "<ul>";
         while( $row = $result->fetch(PDO::FETCH_ASSOC) )
         {
             $output .= "<li><p>" . $row['messages_text'] . "</p>\n\t\t" .
                       "<p class = 'timeStamp'>" . "Posted by " . $row['user_name'].
                       " at " . $row['time_stamp'] . "</p></li></br>";
         }
         $output .= "</ul>";
     }
     else
     {
//         if $result was not set display error messages from our link
         $output = "<p>" . mysqli_error( $$con ) . "</p>\n\t\t";
     }
        ?>
<!--Landing page html code ********************************************************-->
<?php echo $header; ?>
<div class = "pageBodyContainer">
    <h1>Blog Messages</h1>
    <div class = "messages">
        <?php echo $output; ?>

    </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>
