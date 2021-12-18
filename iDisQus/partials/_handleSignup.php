<?php
    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Check whether this email exists
        $existSql = "SELECT * FROM `users` where email = '$email' OR username= '$username'";
        $result = mysqli_query($connect, $existSql);
        $numRows = mysqli_num_rows($result);
        if($numRows>0){
            $showError = "User Name / Email already exists!";
        }
        else{
            if($password == $confirmPassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ( '$username', '$email', '$hash')";
                $result = mysqli_query($connect, $sql);
                
                if($result){
                    $showAlert = true;
                    header("Location: /iDisQus/index.php?signupsuccess=true");
                    exit();
                }

            }
            else{
                $showError = "Passwords do not match!";
            }
        }
        header("Location: /iDisQus/index.php?signupsuccess=false&error=$showError");
    }
?>