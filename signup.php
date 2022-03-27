<?php   
    require "header.php";
?>

<main id="signup-page">
    <h1>Signup</h1>
    <form action ="includes/signup.inc.php" method="POST">
        <input type="text" name = "uid" placeholder="Username">
        <input type="text" name = "mail" placeholder="E-mail">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password-repeat" placeholder="Repeat password">
        <button type="submit" name="signup-submit">Signup</button>
    </form>
    <?php
       if(isset($_GET['error'])) { 
           switch($_GET['error']) { 
                case $_GET['error'] == "emptyfields":
                    echo "<p class='error__message'>Please fill in all the fields</p>";
                    break;  
                case $_GET['error'] == "invalidmailanduid":
                    echo "<p class='error__message'>Sorry, wrong email and username</p>";
                    break; 
                case $_GET['error'] == "invalidmail":
                    echo "<p class='error__message'>Sorry, email is wrong</p>";
                    break;
                case $_GET['error'] == "invaliduid":
                    echo "<p class='error__message'>Sorry, username already exists</p>";
                    break;
                case $_GET['error'] == "invalidpassword":
                    echo "<p class='error__message'>Please make sure the passwords match</p>";
                    break; 
                case $_GET['error'] == "usernameTaken":
                    echo "<p class='error__message'>Sorry that username is already taken</p>";
                    break;
                default: echo ""; 
                } 
           } else if (isset($_GET['signup']) == "success") { 
                echo "<p class='success__message'>Signup Successfull</p>";
       } 
    ?>
</main>

<?php   
    require "footer.php"; 
?>