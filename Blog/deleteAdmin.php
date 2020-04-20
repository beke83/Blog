<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/db.php"); ?>

<?php

    if(isset($_GET["id"])){
        global $Connection;
        $IdFromURL = $_GET["id"];
        $Query = "DELETE FROM admins_tbl WHERE id='$IdFromURL'";
        $Execute = mysqli_query($Connection, $Query);

        if($Execute){
            $_SESSION["SuccessMessage"]="Admin Deleted Successfully";
            Redirect_to("admins.php");
        }else{
            $_SESSION["ErrorMessage"]="Something went wrong Try again!";
            Redirect_to("admins.php");
        }

    }

?>