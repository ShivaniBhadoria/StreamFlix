<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {
        
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

        $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
                <h2>Sign Up</h2>
                <form method="POST" class="register-form">
                    <div class="form-field">
                        <input class="form-input" type="text" name="firstName" placeholder="First Name" value="<?php getUserInputValue("firstName")?>" autocomplete="off" required>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    </div>
                    <div class="form-field">
                        <input class="form-input" type="text" name="lastName" placeholder="Last Name" value="<?php getUserInputValue("lastName")?>" autocomplete="off" required>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    </div>
                    <div class="form-field">
                        <input class="form-input" type="text" name="username" placeholder="Username" value="<?php getUserInputValue("username")?>" autocomplete="off" required>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                    </div>    
                    <div class="form-field">
                        <input class="form-input" type="email" name="email" placeholder="Email" value="<?php getUserInputValue("email")?>" autocomplete="off" required>
                        <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                    </div>
                    <div class="form-field">
                        <input class="form-input" type="email" name="email2" placeholder="Re-enter Email" value="<?php getUserInputValue("email2")?>" autocomplete="off" required>
                    </div>
                    <div class="form-field">
                        <input class="form-input" type="password" name="password" placeholder="Password" autocomplete="off" required>
                        <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                        <?php echo $account->getError(Constants::$passwordLength); ?>
                    </div>
                    <div class="form-field">
                        <input class="form-input" type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required>
                    </div>
                    <div class="submit-btn-container">
                        <input type="submit" name="submitButton" value="Sign Up" class="submit-btn">
                    </div>
                </form>
                <span>Already have an account? <a href="login.php" class="signin-text">Sign In</a></span>
            </div>
        </div>
    </body>
</html>    