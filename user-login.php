<?php

$con = mysqli_connect("localhost","root","" ,"registered_users");

if ($con == false) {

        die("Connection Error". mysqli_connect_error());

}


$user_name = "";

$password = "";

$user_name_error = "";

$password_error = "";

$error = false;


if($_SERVER ["REQUEST_METHOD"] == "POST"){

    $user_name = trim($_POST['user_name']);

    $password = trim($_POST['password']);


    if(empty($user_name) && empty($password)){

            $user_name_error = "User name is required";

            $error = true;

    }



    $user_check = mysqli_query($con, "SELECT password FROM users WHERE user_name = '$user_name'");

    if(mysqli_num_rows($user_check) == 0){

        $user_name_error = "User name does not exist";

        $error = true;

    } else {

        $user = mysqli_fetch_assoc($user_check);

        if($user['password'] != $password){

            $password_error = "Password is incorrect";

            $error = true;

        } else {

            header("Location: user-dashboard.php");

        }

    }



}    
              


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="registration-styles.css">
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">User name:</label>
                <input type="text" value="<?=$user_name?>" name="user_name">
                <span class="error"><?=$user_name_error?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" value="<?=$password?>" name="password">
                <span class="error"><?=$password_error?></span>
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <p>Don't have an account? <a href="user-register.php">Register</a></p>
    </div>

</body>
</html>