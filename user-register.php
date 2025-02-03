<?php
    $con = mysqli_connect("localhost","root","" ,"registered_users");

    if ($con == false) {

            die("Connection Error". mysqli_connect_error());

    }

        


    if($_SERVER ["REQUEST_METHOD"] == "POST"){

        $first_name = trim($_POST['first_name']);

        $last_name = trim($_POST['last_name']);

        $email = trim($_POST['email']);

        $phone = trim($_POST['phone']);

        $user_name = trim($_POST['user_name']);

        $password = trim($_POST['password']);

        $confirm_password = trim($_POST['confirm_password']);




        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, user_name, password) 
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$user_name', '$password')";

        if (mysqli_query( $con, $sql)) {

            echo "User registered successfully";

        } else {

            echo "Error registering user". mysqli_error($con);
        }

        mysqli_close( $con );
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="registration-styles.css">
    <script defer src="./index.js"></script>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action="" method="POST" id="form">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" value="<?=$first_name?>" name="first_name">
                <div class="error"><</div>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" value="<?=$last_name?>" name="last_name">
                <div class="error"><</div>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="<?=$email?>" name="email">
                <div class="error"><</div>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" value="<?=$phone?>" name="phone" pattern="[0-9]{10}">
                <div class="error"><</div>
            </div>

            <div class="form-group">
                <label for="username">User name:</label>
                <input type="text" value="<?=$user_name?>" name="user_name">
                <div class="error"><</div>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" value="<?=$password?>" name="password">
                <div class="error"><</div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" value="<?=$confirm_password?>" name="confirm_password">
                <div class="error"><</div>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</body>
</html>