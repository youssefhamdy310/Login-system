<?php
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
parse_str(parse_url($url, PHP_URL_QUERY), $urlQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup and Login Forms</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Signup Form</h2>
            <form method="post" action="data.php" id="signup-form">
                <label for="signup-email">Email</label><div class="phonne">+20</div>
                <input type="email" id="signup-email" name="signup-email" required>
                
                <label for="signup-username">Username</label>
                <input type="text" id="signup-username" name="signup-username" required>
                
                <label for="signup-password">Password</label>
                <input type="password" id="signup-password" name="signup-password" required> 

                <label for="signup-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required> 

                <label for="signup-password" class="label" >Phone Number</label>
                
                <input type="text" class="signup-phone" style="    position: relative;
                width: 225px;
                z-index: 1;
                left: 33px;" id="confirm-password" name="signup-phone" required>                
                <button name="signup-submit" type="submit">Signup</button>
                
                <?php
                if (@$urlQuery['input'] == "empty") {
                    echo '<div class="error">Please fill all inputs</div>';
                } elseif (@$urlQuery['passval'] == "none") {
                    echo '<div class="error">Cannot use this password</div>';
                } elseif (@$urlQuery['user'] == "found") {
                    echo '<div class="error">Username is taken</div>';
                } elseif (@$urlQuery['pass'] == "notmatch") {
                    echo '<div class="error">Password does not match</div>';
                }
                ?>
            </form>
        </div>
        <div class="form-container">
            <h2>Login Form</h2>
            <form method="post" action="data.php" id="login-form">
                <label for="login-username">Username/Email</label>
                <input type="text" id="login-username" name="login-username" required>
                
                <label for="login-password" >Password</label>
                <input type="password" id="login-password" name="login-password" required>
                
                <button class="submit" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
