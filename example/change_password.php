<?php
  session_start();
  $username = filter_input(INPUT_POST, 'username');
  $password = filter_input(INPUT_POST, 'password');
  $newpassword = filter_input(INPUT_POST, 'newpassword');
  if (!empty($username)){
    if (!empty($password)){
      $host = "localhost";
      $dbusername = "root";
      $dbpassword = "";
      $dbname = "kookyCooks";

      $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

      $sql = "SELECT * FROM User WHERE User.email = '".$username."' && User.pass = '".$password."'";
      $result = $conn->query($sql);

      while($row = mysqli_fetch_array( $result ) ){
        $check_username=$row['email'];
        $check_password=$row['pass'];
      }

      if($username == $check_username && $password == $check_password ){
        $sql = "UPDATE User SET User.pass='".$newpassword."'  WHERE User.email = '".$username."' && User.pass = '".$password."'";
        if($conn->query($sql)){
          header('location: password_changed.html');
          die();
        }
        else {
          header('location: invalid_login2.html');
          die();
        }
      }

      else {
        header('location: invalid_login2.html');
        die();
      }
    }

    else{
      header('location: empty_field2.html');
      die();
    }
  }

  else{
    header('location: empty_field2.html');
    die();
  }
?>
