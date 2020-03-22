<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>Admin</title>
</head>
<body>
<?php

    session_start();
    echo "<a href='signin.php'><h1 class='d-block p-2 bg-dark text-primary float-right'> LogOut </h1></a>";
    echo "<a href='home.php'><h1 class='d-block p-2 bg-dark text-primary float-right'> Home </h1></a>";

    if (isset($_SESSION["Admin"])){

    require 'db.php';

    $conn = connection();
    $res = selectAll($conn);
    close($conn);
    if($res){
    echo "<h1 class='p-2 bg-dark text-white'>Users Form</h1>";
    echo "<table class='table table-striped table-dark'>";
    echo "<thead><tr>";
    echo "<th>Id</th><th>Name</th><th>Email</th><th>Admin</th><th>created_on</th><th>Action</th>";
    echo "</thead></tr>";
    foreach ($res as $val){
        echo "<tr>";
        echo "<td>".$val["id"]."</td>";
        echo "<td>".$val["name"]."</td>";
        echo "<td>".$val["email"]."</td>";
        echo "<td>".$val["admin"]."</td>";
        echo "<td>".$val["created_on"]."</td>";
        echo "<td><a href='admin.php?del=".$val["id"]."'> Delete </a></td>";
        echo "</tr>";
    }
    echo "</table>";}
    echo "<div class='cardcreate'>";
    echo "<form method='POST' action='valid.php'>";
    echo '
    <input type="text" class="form-control" name="user" placeholder="username">
    <input type="password" class="form-control" name="passwd" placeholder="password">
    <input type="email" class="form-control" name="mail" placeholder="email">
    <label class="h4 text-light"><b>Create New User: </b></label>
    <input type="submit" name="create" value="Create" class="btn-primary h5 float-right">
    ';
    echo "</form></div>";

    if(isset($_GET['msg'])){
        $err = explode(",",$_GET['msg']);
        echo "<div class='card-body red'>";
        if (in_array("user", $err)){
            echo "please fill the user name"."<br>";};
        if(in_array("passwd", $err)){
            echo "please fill the password *(8 chars)"."<br>";};
        if(in_array("email", $err)){
            echo "please fill the email";};
        echo "</div>";}

        if(($_GET["msg"]) == "fill"){
                echo "<div class='card-body red'>";
                echo "please enter another values";
                echo "</div>";}           
        

    if (isset($_GET["del"])){
        $conn = connection();
        $res = delete($conn, $_GET["del"]);
        header("Location: ../admin.php");
        close($conn);
    }}else{
        header("Location: ../404.html");
    }

?>
</body>
</html>
