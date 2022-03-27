<?php

if(isset($_POST['signup-submit'])) { 
    require "dbh.inc.php"; 

    $username = $_POST["uid"]; 
    $email = $_POST["mail"]; 
    $password = $_POST["password"]; 
    $passwordCheck = $_POST["password-repeat"]; 

    if (empty($username) || empty($email) || empty($password) || empty($passwordCheck)) { 
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email); 
        exit(); 
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) { 
        header("Location: ../signup.php?error=invalidmailanduid"); 
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        header("Location: ../signup.php?error=invalidmail&uid=".$username); 
        exit(); 
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { 
        header("Location: ../signup.php?error=invaliduid&mail=".$email); 
        exit(); 
    } else if ($password !== $passwordCheck) { 
        header("Location: ../signup.php?error=invalidpassword&uid=".$username."&mail=".$email); 
        exit(); 
    } else { 

        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $preparedStmt = mysqli_stmt_init($connection); 
        if(!mysqli_stmt_prepare($preparedStmt, $sql)) { 
            header("Location: ../signup.php?error=databaseError"); 
            exit(); 
        } else { 
            mysqli_stmt_bind_param($preparedStmt, "s", $username);
            mysqli_stmt_execute($preparedStmt); 
            mysqli_stmt_store_result($preparedStmt); 
            $resultCheck = mysqli_stmt_num_rows($preparedStmt);
            if($resultCheck > 0) { 
                header("Location: ../signup.php?error=usernameTaken&mail=".$email); 
                exit(); 
            } else { 
                $sql = "INSERT into users (uidUsers, emailUsers, pwdUsers) VALUES (?,?,?)";
                $preparedStmt = mysqli_stmt_init($connection); 
                if(!mysqli_stmt_prepare($preparedStmt, $sql)) { 
                    header("Location: ../signup.php?error=databaseError"); 
                    exit(); 
                } else { 
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    mysqli_stmt_bind_param($preparedStmt, "sss", $username, $email,  $hashedPassword); 
                    mysqli_stmt_execute($preparedStmt); 
                    header("Location: ../signup.php?signup=success");
                    exit(); 
                }
            }
        }
    }
    mysqli_stmt_close($preparedStmt);
    mysqli_close($connection); 
} else { 
    header("Location: ../singup.php"); 
    exit();
}

