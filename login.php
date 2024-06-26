<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($username, $password);

        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("location: index.php");
        }
    }

    function getUserInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StreamFlix</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    </head>
    <body>
        <div class="signup-container">
            <div class="signup-page">
                <a href="#" class="logo"><img src="assets/images/stream_logo.png" alt="Welcome to StreamFlix" width="145" height="40"/></a>
                <h2>Sign In</h2>
                <form method="POST" class="register-form">
                    <div class="form-field">
                        <input class="form-input" type="text" name="username" placeholder="Username" value="<?php getUserInputValue("username")?>" autocomplete="off" required>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                    </div>    
                    <div class="form-field">
                        <input class="form-input" type="password" name="password" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="submit-btn-container">
                        <input type="submit" name="submitButton" value="Sign In" class="submit-btn">
                    </div>
                </form>
                <span>New To Streamflix? <a href="register.php" class="signin-text">Sign Up</a></span>
            </div>
        </div>
    </body>
</html>    