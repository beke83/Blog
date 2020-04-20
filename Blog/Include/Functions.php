<?php require_once("Include/db.php"); ?>
<?php require_once("Include/session.php"); ?> 
<?php

    function Redirect_to($New_Location){
        header("Location:". $New_Location);
        exit;
    }

    function Login_Attempt($Username,$Password){
        global $Connection;
        $Query = "SELECT * FROM admins_tbl 
        WHERE username='$Username' AND password = '$Password'";
        $Execute =  mysqli_query($Connection, $Query);
        if($admin = mysqli_fetch_assoc($Execute)){
            return $admin;
        }
        else{
            return null;
        }

    }

    function Login(){
        if(isset($_SESSION["User_id"])){
            return true;
        }
    }

    function confirm_login(){
        if(!Login()){
            $_SESSION["ErrorMessage"] = "Login Required!";
            Redirect_to("login.php");
        }
    }


?>