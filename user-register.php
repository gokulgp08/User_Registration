<?php
    $con = mysqli_connect("localhost","root","" ,"registered_users");

    if ($con == false) {

            die("Connection Error". mysqli_connect_error());

    }

        
    $first_name = "";

    $last_name = "";
    
    $email = "";

    $phone = "";

    $user_name = "";

    $password = "";

    $confirm_password = "";


    $first_name_error = "";

    $last_name_error = "";

    $email_error = "";

    $phone_error = "";

    $user_name_error = "";

    $password_error = "";
    
    $confirm_password_error = "";

    $error = false;

    if($_SERVER ["REQUEST_METHOD"] == "POST"){
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $user_name = trim($_POST['user_name']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);


        if(strlen($first_name) < 3) {  
            $first_name_error = "First name must be at least 3 characters";
            $error = true;
        }

        if(strlen($last_name) < 2) {  
            $last_name_error = "Last name must be at least 2 characters";
            $error = true;
        }

        $phone_check = mysqli_query($con, "SELECT * FROM users WHERE phone_number = '$phone'");
        if(mysqli_num_rows($phone_check) > 0) {
            $phone_error = "This number is already registered";
            $error = true;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please enter a valid email address";
            $error = true;
        }

        $email_check = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($email_check) > 0) {
            $email_error = "This email is already registered";
            $error = true;
        }

        if(strlen($user_name)<3) {
            $user_name_error = "User name must be at least 3 characters";
            $error = true;
        }

        $user_check = mysqli_query($con, "SELECT * FROM users WHERE user_name = '$user_name'");
        if(mysqli_num_rows($user_check) > 0) {
            $user_name_error = "This user name is already registered";
            $error = true;
        }

        if(strlen($password)!=6) {
            $password_error = "Password must be 6 characters long";
            $error = true;
        }   
        
        if (!preg_match('/\d/', $password)) {
            $password_error = "Password must contain at least one number";
            $error = true;
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $password_error = "Password must contain at least one uppercase letter";
            $error = true;
        }

        if($password != $confirm_password) {
            $confirm_password_error = "Passwords do not match";
            $error = true;
        }


        if(!$error) {


        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, user_name, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$user_name', '$password')";

        if (mysqli_query( $con, $sql)) {
            echo "User registered successfully";
        } else {
            echo "Error registering user". mysqli_error($con);
        }

        mysqli_close( $con );
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="registration-styles.css">
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" value="<?=$first_name?>" name="first_name">
                <span class="error"><?=$first_name_error?></span>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" value="<?=$last_name?>" name="last_name">
                <span class="error"><?=$last_name_error?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="<?=$email?>" name="email">
                <span class="error"><?=$email_error?></span>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" value="<?=$phone?>" name="phone" pattern="[0-9]{10}">
                <span class="error"><?=$phone_error?></span>
            </div>

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
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" value="<?=$confirm_password?>" name="confirm_password">
                <span class="error"><?=$confirm_password_error?></span>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</body>
</html>