<?php
session_start();
if (isset($_SESSION["Admin"])) {
?>

    <html>

    <head>
        <link rel="stylesheet" href="style/bootstrap.min.css">

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <title>Admin</title>
    </head>

    <body>
        <?php
        echo "<div class='m-2'>";
        echo "<a href='home.php'><h1 class='d-block p-2 bg-dark text-primary float-right'> Home </h1></a>";

        require 'db.php';

        $conn = connection();
        $res = selectAll($conn);
        close($conn);
        if ($res) {
            echo "<h1 class='p-2 bg-dark text-white'>Users Form</h1>";
            echo "<table class='table table-striped rounded shadow table-dark'>";
            echo "<thead><tr>";
            echo "<th>Id</th><th>Name</th><th>Email</th><th>Admin</th><th>created_on</th><th>Action</th>";
            echo "</thead></tr>";
            foreach ($res as $val) {
                echo "<tr>";
                echo "<td>" . $val["id"] . "</td>";
                echo "<td>" . $val["name"] . "</td>";
                echo "<td>" . $val["email"] . "</td>";
                echo "<td>" . $val["admin"] . "</td>";
                echo "<td>" . $val["created_on"] . "</td>";
                echo "<td><a href='admin.php?del=" . $val["id"] . "'> Delete </a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        echo "<div class='col-4 p-2 border shadow rounded'>";
        echo "<form method='POST' action='valid.php'>";
        echo '
            <label class="h4 text-warning mb-3"><b>Create New User: </b></label>
            <input type="submit" name="create" value="Create" class="btn btn-success h5 float-right">
            <input type="text" class="form-control mt-3 mb-1 text-center" name="user" placeholder="username">
            <input type="password" class="form-control mb-1 text-center" name="passwd" placeholder="password">
            <input type="email" class="form-control text-center" name="mail" placeholder="email">
            ';
        echo "</form></div>";

        if (isset($_GET['msg'])) {
            $err = explode(",", $_GET['msg']);
            echo "<div class='card-body red'>";
            if (in_array("user", $err)) {
                echo "please fill the user name" . "<br>";
            };
            if (in_array("passwd", $err)) {
                echo "please fill the password *(8 chars)" . "<br>";
            };
            if (in_array("email", $err)) {
                echo "please fill the email";
            };
            echo "</div>";
        }

        if (($_GET["msg"]) == "fill") {
            echo "<div class='card-body red'>";
            echo "please enter another values";
            echo "</div>";
        }


        if (isset($_GET["del"])) {
            $conn = connection();
            $res = delete($conn, $_GET["del"]);
            header("Location: ../admin.php");
            close($conn);
        } 
        
        echo "</div>"
        ?>

    </body>

    </html>
<?php
} else {
    header("Location: ../404.html");
}

?>