<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/db.php"); ?>

<?php

    if(isset($_GET["id"])){
        global $Connection;
        $IdFromURL = $_GET["id"];
        $Query = "UPDATE comments SET status = 'OFF' WHERE id='$IdFromURL'";
        $Execute = mysqli_query($Connection, $Query);

        if($Execute){
            $_SESSION["SuccessMessage"]="Comment Dis-approved Successfully";
            Redirect_to("comments.php");
        }else{
            $_SESSION["ErrorMessage"]="Something went wrong Try again!";
            Redirect_to("comments.php");
        }

    }

?>