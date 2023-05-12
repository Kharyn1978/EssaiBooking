<?php 

session_start(); 

include "database.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    $uname = $_POST['username'];

    $pass = $_POST['password'];

    /*if (empty($username)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{*/
        $sql = "SELECT * FROM customers WHERE username='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['username'] = $row['username'];

                $_SESSION['fullName'] = $row['fullName'];

                $_SESSION['customerId'] = $row['customerId'];

                header("Location: hotels.php");

                exit();

            }else{
                header("Location: index.php?error=Incorrect Username or password");

                exit();

            }

        }else{

            header("Location: index.php?error=Incorrect Username or password");

            exit();

        }

}else{

    header("Location: index.php");

    exit();

}
?>