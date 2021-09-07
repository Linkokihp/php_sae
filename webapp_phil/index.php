<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ninjatt</title>
</head>
<body>
    <div id=LoginDiv></div>
        <form id="form1" method="post" action="user_login.php">
            <h2>Login for Ninjatt</h2>
            <table>
                <tr>
                    <td><input type="Email" name="UserMailLogin" placeholder="Enter your Email" required></td>
                </tr>
                <tr>
                    <td><input type="password" name="UserPasswordLogin" placeholder="Enter your Userpassword" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Login"></td>
                </tr>
                <?php
                    if(isset($_GET['error'])) {
                ?>
                <tr>
                    <td><span style="color: red;">Wong credentials!</span></td>
                </tr>
                <?php   
                    }
                ?>
        </form>
</body>
</html>