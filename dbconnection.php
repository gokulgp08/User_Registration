<?php
    $con = mysqli_connect("localhost","root","" ,"registered_users");
    if ($con == false) {

        die("Connection Error". mysqli_connect_error());

    }

$sql = "CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    user_name VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query( $con, $sql)) {
    echo "Table users Created successfully";
} else {
    echo "Error creating table". mysqli_error($con);
}

mysqli_close( $con );
?>