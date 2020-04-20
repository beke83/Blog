<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/db.php"); ?>

<?php

    if(isset($_GET["id"])){
        global $Connection;
        $IdFromURL = $_GET["id"];
        $Admin = $_SESSION["Username"]; 
        $Query = "UPDATE comments SET status = 'ON', approvedby='$Admin' WHERE id='$IdFromURL'";
        $Execute = mysqli_query($Connection, $Query);

        if($Execute){
            $_SESSION["SuccessMessage"]="Comment Approved Successfully";
            Redirect_to("comments.php");
        }else{
            $_SESSION["ErrorMessage"]="Something went wrong Try again!";
            Redirect_to("comments.php");
        }

    }

?>