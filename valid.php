<?php
    require 'db.php';

        if(isset($_GET["login"])){

            $err = array();

            if( !isset($_GET["user"]) || empty($_GET["user"]) ){
                $err[] = "user";}

            if( !isset($_GET["passwd"]) || empty($_GET["passwd"]) ){
                $err[] = "passwd";}

            if(!$err){
                // header("Location: ../valid.php?user=".$_GET['user']."&pass=".$_GET['passwd']."");

                $conn = connection();
                $Us = mysqli_escape_string($conn, $_GET["user"]);
                $Pass = mysqli_escape_string($conn, $_GET["passwd"]);
                $check = select($Us, $conn);
                close($conn);
                // var_dump (password_verify($Pass, $check["passwd"]));

                if(password_verify($Pass, $check["passwd"])){
                    $_SESSION['UserId'] = session_id();
                    if($check["admin"]){
                        $_SESSION['Admin'] = $check["admin"];
                    }
                    header("Location: ../home.php");
                    exit();
                }else{
                    header("Location: ../signup.php");
                    exit();
                }

            }else{
                header("Location: ../signin.php?msg=".implode(",",$err)."");
                unset($err);
                exit();
            }
        }



        if(isset($_POST["signup"]) || isset($_POST["create"])){

            $err = array();
            if( !isset($_POST["user"]) || empty($_POST["user"]) ){
                $err[] = "user";}

            if( !isset($_POST["passwd"]) || empty($_POST["passwd"]) || strlen($_POST["passwd"]) < 8 ){
                $err[] = "passwd";}

            if( !isset($_POST["mail"]) || empty($_POST["mail"]) || filter_var($_POST["mail"], FILTER_FLAG_EMAIL) ){
                $err[] = "email";}

            if(!$err){

                $conn = connection();
                $Nam = mysqli_escape_string($conn, $_POST["user"]);
                $Pss = mysqli_escape_string($conn, $_POST["passwd"]);
                $Mail = mysqli_escape_string($conn,$_POST["mail"]);
                $PaSS = password_hash($Pss, PASSWORD_DEFAULT);
        
                $check = insert($Nam, $PaSS, $Mail, $conn);
                close($conn);
                        
                if($check){
                    $_SESSION['UserId'] = session_id();
                    if (isset($_POST["signup"]))header("Location: ../home.php");
                    if (isset($_POST["create"])) header("Location: ../admin.php");
                    exit();
                }else{
                    if (isset($_POST["signup"]))header("Location: ../signup.php?msg=fill");
                    if (isset($_POST["create"])) header("Location: ../admin.php?msg=fill");
                    exit();
                }            
            }else{
                if (isset($_POST["signup"])) header("Location: ../signup.php?msg=".implode(",",$err)."");
                if (isset($_POST["create"])) header("Location: ../admin.php?msg=".implode(",",$err)."");
                unset($err);
                exit();
            }
        }


?>