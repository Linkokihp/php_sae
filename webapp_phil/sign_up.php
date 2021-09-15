<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp to Ninjatt</title>
</head>
<body>
    <div id="signup">
        <form id="form2" method="post" action="insert_user.php">
            <h2>SignUp Form</h2>
            <table>
                <tr>
                    <td><input type="text" name="UserName" placeholder="Enter your Ninja-Name" required></td>
                </tr>
                <tr>
                    <td><input type="email" name="UserMail" placeholder="Enter your Email" required></td>
                </tr>
                <tr>
                    <td><input type="password" name="UserPassword" placeholder="Enter your Password" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="SignUp"></td>
                </tr>
                <?php
                    if(isset($_GET['success'])) {
                ?>
                <tr>
                    <td><span style="color: green;">User inserted</span></td>
                </tr>
                <?php   
                    }
                ?>
            </table>
            <h4><a href="index.php">I'm already a Ninjatter!</a></h4>
        </form>
    </div>
</body>
</html>