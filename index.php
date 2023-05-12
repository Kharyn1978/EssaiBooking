<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>Medie Booking - Login</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        
        <div class="container">
            <div class="section welcome">
                <p>WELCOME</p>
                <h1>Medie Bookings</h1>
            </div>
            
            <form action="login.php" method="post" class="userForms loginUser">
                <h2>Login</h2>
                <?php if (isset($_GET['error'])) { ?>

                    <p class="error"><?php echo $_GET['error']; ?></p>

                <?php } ?>

                <div class="section">
                    <label for="username">Username:</label>
                    <input name="username" type="text" placeholder="Username"/>
                </div>
                <div class="section">
                    <label for="password">Password:</label>
                    <input name="password" type="password" placeholder="Password"/>
                </div>

                <button type="submit">LOGIN</button>
                <p>Don't have an account? <a href="">Register here</a></p>
            </form>
            
            <form action="register.php" method="post" class="userForms registerUser">
                <h2>Register</h2>
                <?php if (isset($_GET['error'])) { ?>

                    <p class="error"><?php echo $_GET['error']; ?></p>

                <?php } ?>
                
                <div class="section">
                    <label for="fullname">Full Name:</label>
                    <input name="fullName" type="text" maxLength="50" placeholder="Full name"/>
                </div>
                <div class="section">
                    <label for="username">Username:</label>
                    <input name="username" type="text" maxLength="" placeholder="Username"/>
                </div>
                <div class="section">
                    <label for="email">Email address:</label>
                    <input name="email" type="email" maxLength="" placeholder="Email address"/>
                </div>
                <div class="section">
                    <label for="address">Physical address:</label>
                    <input name="address" type="text" maxLength="" placeholder="Physical address"/>
                </div>
                <div class="section">
                    <label for="password">Password:</label>
                    <input name="password" type="password" maxLength="" placeholder="Password"/>
                </div>

                <button type="submit" name="registerThisUser">REGISTER</button>
                <p>Already have an account? <a href="">Login here</a></p>
            </form>
        </div>
    </body>
    
    <script src="js/jquery.min.js"></script>
</html>