<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="./styles.css">
    <title>Login System</title>
</head>
<body>
    <header>
        <nav id="navigation">
            <a id="logo__link"><img src="assets/checkmark.png" alt ="logo"/></a>
            <ul id = "navigation__links">
                <li><a href="index.php">Home</a></li>
                <li><a>About</a></li>
                <li><a>Portfolio</a></li>
                <li><a>Contact</a></li>
            </ul>
            <div id="navigation__login--container">
            <?php
                if(!isset($_SESSION['userUid'])) {
                    echo '<form action="includes/login.inc.php" method="POST">
                    <input type="text" name="username" placeholder = "Username">
                    <input type="password" name="password" placeholder = "Password">
                    <button id = "login-button" type="submit" name="login-submit">Login</button>
                    </form>
                    <a id="signup-link" href="signup.php">Signup</a>';
                } else { 
                    echo '<form action="includes/logout.inc.php" method="POST">
                    <button type="submit" name="logout-submit">Logout</button>
                    </form>';
                }
            ?>
            <span id="login__message--container">
                <?php
                    if(isset($_GET['error'])) { 
                        switch(isset($_GET['error'])) { 
                            case $_GET['error'] == "wrongPassword":
                                echo "<p>Wrong password</p>"; 
                                break; 
                            case $_GET['error'] == "noUserFound":
                                echo "<p>Username not found</p>"; 
                                break; 
                            case $_GET['error'] == "databaseError";
                                echo "<p>DatabaseError.. come back later</p>"; 
                                break; 
                        }
                    }
                ?>
            </span>
            </div>
        </nav>
    </header>

    
  