<!DOCTYPE html>

<html lang='en'>

    <head>
        <title>Neuneu</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>

        <link rel='stylesheet' href='css/styles.css'>
    </head>

    <body>
        <nav>
            <button id='nav-login' class='nav-btn'>Login</button>
            <button id='nav-register' class='nav-btn'>Register</button>
        </nav>

        <div class='r-wrapper'>
            <button class='close-r-form'>X</button>
            <form id='r-f' action='#' method='POST'>
                <h3>Register</h3>
                <div class='input-box'>
                    <input type='text' id='r-username' name='r-username' required/>
                    <label for='r-username'>Username</label>
                </div>
                <div class='input-box'>
                    <input type='password' id='r-pw' name='r-pw' required/>
                    <label for='r-pw'>Password</label>
                </div>
                <div class='input-box'>
                    <input type='password' id='r-pw-2' name='r-pw-2' required/>
                    <label for='r-pw-2'>Confirm password</label>
                </div>
                <input type='submit' class='form-btn' value='Register'>
            </form>
        </div>
        
        <div class='l-wrapper'>
            <button class='close-l-form'>X</button>
            <form action='php/login.php' method='POST'>
                <h3>Login</h3>
                <div class='input-box'>
                    <input type='text' id='l-username' name='l-username' required/>
                    <label for='l-username'>Username</label>
                </div>
                <div class='input-box'>
                    <input type='password' id='l-pw' name='l-pw' required/>
                    <label for='l-pw'>Password</label>
                </div>
                <input type='submit' class='form-btn' value='Login'>
            </form>
            <?php
            //if (isset($_GET['error'])) {?>
                <p><?php //echo $_GET['error']; ?></p>
            <?php//}?>
        </div>
        
        <script src='js/jquery-3.6.3.min.js'></script>
        <script src='js/main.js'></script>
    </body>
</html>
