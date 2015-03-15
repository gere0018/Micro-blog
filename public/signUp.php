<?php require_once("../includes/variables.php");
 require_once("../includes/db-connect.php");


if(isset($_POST["signUp"])){
    if(!empty($userName) && !empty($password)){
        //run sql query to check if username exists in database
        $sqlQuery_checkUserName = 'SELECT * FROM users
                     WHERE  user_name = "' . $userName . '"';
        $result2 = $con->query($sqlQuery_checkUserName);
                if($result2){
                    //if username doesn't exist add user info to database
                    if( $result2->rowCount() == 0){
                    $sqlQuery_addUserInfo = 'INSERT INTO `users`
                                            (`user_name`, `user_hash`)
                                  VALUES ("'. $userName .'", "' . $password. '")';
                    $result3 = $con->query($sqlQuery_addUserInfo);
                    //get user_id to add it to session
                    $sqlQuery_getUserId = 'SELECT user_id FROM users
                                            WHERE user_name = "'. $userName .'"';
                    $result4 = $con->query($sqlQuery_getUserId);
                    $row = $result4->fetch(PDO::FETCH_ASSOC);
                    //create session variables
                     $_SESSION['user_id'] = $row['user_id'];
                     $_SESSION['user_name'] = $userName;
                    //if loggedIn is true user will be redirected to index.php
                     header("Location: index.php");
                    }else{
                        $alertMsg1 = 'User name is taken. Please select another
                                        user name.</p>';
                        }
                }else{
                   $queryMsg = "query failed";
                }
    }
}
if(isset($_POST["cancel"])){
     header("Location: index.php");
}
$output = '</header>';
$output .= '<div class = "pageBodyContainer">
                <div class = "signUpFormContainer">
                    <h1>Sign Up to post messages to the blog</h1>
                    <p>Please enter a name and password</p>
                    <form name="signUp" method="post" action="signUp.php"><p>' .
                        $alertMsg1 . '</p>
                        Username: <input type="text" name="userName" id="userName"
                        value = "' . $user_name. '"
                        /><br/><p>'. $alertMsg2 . '</p>
                        Password: <input type="password" name="password"
                        id="password"/></br></br>
                        <input class ="btn" type="submit" name="signUp" id="signUp"
                            value="Sign Up" />
                        <input class ="btn" type="submit" name="cancel" id="cancel"
                            value= "Cancel" />
                     </form>
                </div>
            </div>';

?>
<!--pages output *********************************************************-->
<?php include("../includes/layouts/header.php"); ?>
<?php echo $output;
?>
<?php include("../includes/layouts/footer.php"); ?>
