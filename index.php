<?php   
    require "header.php";
?>

<main id="logged-container">
    <?php
        if(isset($_SESSION['userUid'])) { 
            echo '<p>You are logged in</p>';
        } else { 
            echo '<p>You are logged out</p>'; 
        }
    ?>  
</main>

<?php
 
?>

<?php   
    require "footer.php"; 
?>