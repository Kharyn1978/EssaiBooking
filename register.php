<?php
session_start();

// initializing variables
$username = "";
$email = "";
$fullName = "";
$password = "";
$errors = array(); 

// connect to the database
include "database.php";

// REGISTER USER
if (isset($_POST['registerThisUser'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($fullName)) { array_push($errors, "Full name is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }
  if (empty($phoneNumber)) { array_push($errors, "Phone number is required"); }

// first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $query = "SELECT * FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }
// Finally, register user if there are no errors in the form
if (count($errors) == 0) {
    $password = md5($password);//encrypt the password before saving in the database
 
    $query = "INSERT INTO users (username, fullName, email, address, password, phoneNumber) VALUES('$username', '$fullName', '$email', '$address', '$password', '$phoneNumber')";
    mysqli_query($conn, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: hotels.php');
   }else{
    header("Location: index.php?error=Please fill in all the details");

    exit();

    }

 }else{

    header("Location: index.php");

    exit();

}

 ?>