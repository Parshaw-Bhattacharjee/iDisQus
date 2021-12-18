<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` where email = '$email'";
    $result = mysqli_query($connect, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            echo "logged in". $email;
            if($result){
                $showAlert = true;
                header("Location: /iDisQus/index.php?loginsuccess=true");
                exit();
            }
        } 
        else{
            $showError = "Incorrect Credentials!";
        }  
    }
    header("Location: /iDisQus/index.php?loginsuccess=false&error=$showError");
}

?>