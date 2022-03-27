<?php
if(isset($_POST['login-submit'])) { 
    
    require "dbh.inc.php"; 

    $mailuid = $_POST["username"]; 
    $password = $_POST["password"];
    
    if(empty($mailuid) || empty($password)) { 
        header("Location: ../index.php?error=emptyfields&".$mailuid); 
        exit(); 
    } else { 
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers =?;";
        $sqlStatement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($sqlStatement, $sql)) { 
            header("Location: ../index.php?error=databaseError"); 
            exit();
        } else { 
            mysqli_stmt_bind_param($sqlStatement, "ss", $mailuid, $mailuid); 
            mysqli_stmt_execute($sqlStatement);
            $result = mysqli_stmt_get_result($sqlStatement);
            if($row = mysqli_fetch_assoc($result)) { 
               $passwordCheck = password_verify($password, $row['pwdUsers']); 
               if(!$passwordCheck) { 
                    header("Location: ../index.php?error=wrongPassword"); 
                    exit();    
               } else if($passwordCheck) { 
                    session_start(); 
                    $_SESSION['userid'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];  
                    $_SESSION['email'] = $row['emailUsers']; 

                    header("Location: ../index.php?login=success"); 
                    exit();
               } else { 
                    header("Location: ../index.php?error=wrongPassword"); 
                    exit(); 
               }
            } else { 
                header("Location: ../index.php?error=noUserFound"); 
                exit(); 
            }
        }
    }

} else { 
    header("Location: ../index.php");
    exit();
}
