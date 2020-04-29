<?php
require 'db.php';
if (isset($_GET['rem'])) {
    $conn = connection();
    $res = selectBySession($_GET['rem'], $conn);
    header("Location: ../valid.php?login=" . "rem" . "&user=" . $res['user'] . "&passwd=" . $res['passwd'] . "");
}

if (isset($_GET["login"])) {

    $err = array();

    if (!isset($_GET["user"]) || empty($_GET["user"])) {
        $err[] = "user";
    }

    if (!isset($_GET["passwd"]) || empty($_GET["passwd"])) {
        $err[] = "passwd";
    }

    if (!$err) {

        $conn = connection();
        $Us = mysqli_escape_string($conn, $_GET["user"]);
        $Pass = mysqli_escape_string($conn, $_GET["passwd"]);
        $check = select($Us, $conn);

        if (password_verify($Pass, $check["passwd"])) {
            $SESS_ID = session_id();
            $_SESSION['UserId'] = $SESS_ID;
            if ($check["admin"]) {
                $_SESSION['Admin'] = $check["admin"];
            }
            if (isset($_GET["remember"])) {
                insertSession($SESS_ID, $Us, password_hash($Pass, PASSWORD_DEFAULT), $conn);
                setcookie("SESS_ID", $SESS_ID, time() + 86400, "/");
            }
            header("Location: ../home.php");

        } else if (isset($_GET["login"]) == "rem" && !empty($check)) {
            header("Location: ../home.php");
            
        } else {
            header("Location: ../signup.php");
        }
        close($conn);
        exit();
    } else {
        header("Location: ../login.php?msg=" . implode(",", $err) . "");
        unset($err);
        exit();
    }
}



if (isset($_POST["signup"]) || isset($_POST["create"])) {

    $err = array();
    if (!isset($_POST["user"]) || empty($_POST["user"])) {
        $err[] = "user";
    }

    if (!isset($_POST["passwd"]) || empty($_POST["passwd"]) || strlen($_POST["passwd"]) < 8) {
        $err[] = "passwd";
    }

    if (!isset($_POST["mail"]) || empty($_POST["mail"]) || filter_var($_POST["mail"], FILTER_FLAG_EMAIL)) {
        $err[] = "email";
    }

    if (!$err) {

        $conn = connection();
        $Nam = mysqli_escape_string($conn, $_POST["user"]);
        $Pss = mysqli_escape_string($conn, $_POST["passwd"]);
        $Mail = mysqli_escape_string($conn, $_POST["mail"]);

        $check = insert($Nam, password_hash($Pss, PASSWORD_DEFAULT), $Mail, $conn);
        close($conn);

        if ($check) {
            $_SESSION['UserId'] = session_id();
            if (isset($_POST["signup"])) header("Location: ../home.php");
            if (isset($_POST["create"])) header("Location: ../admin.php");
            exit();
        } else {
            if (isset($_POST["signup"])) header("Location: ../signup.php?msg=fill");
            if (isset($_POST["create"])) header("Location: ../admin.php?msg=fill");
            exit();
        }
    } else {
        if (isset($_POST["signup"])) header("Location: ../signup.php?msg=" . implode(",", $err) . "");
        if (isset($_POST["create"])) header("Location: ../admin.php?msg=" . implode(",", $err) . "");
        unset($err);
        exit();
    }
}


if (isset($_GET["logout"])) {
    $SESS_ID = $_COOKIE["SESS_ID"];
    $conn = connection();
    deleteSession($SESS_ID, $conn);
    session_unset();
    session_destroy();
    setcookie("SESS_ID", $SESS_ID, time() - 86400, "/");
    header("Location: ../login.php");
}
