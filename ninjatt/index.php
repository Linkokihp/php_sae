<?php require_once('config.php') ?>
<?php require __DIR__ . '/vendor/autoload.php'; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php') ?>
    <title>Welcome to Ninjatt</title>
</head>
<?php 
    if (isset($_SESSION['logoutmessage'])) {
        echo '<script type="text/javascript">alert("' . $_SESSION['logoutmessage'] . '");</script>';
        unset($_SESSION['logoutmessage']);
        session_destroy();
    }
?>
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
                    <td><span style="color: red;">Wong credentials! Try again!</span></td>
                </tr>
                <?php   
                    }
                ?>
            </table>
            <h4><a href="sign_up.php">Not a Ninjatter yet? Sign up!</a></h4>
        </form>
</body>
</html>