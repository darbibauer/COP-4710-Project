<?php
  $username = filter_input(INPUT_POST, 'username');
  $password = filter_input(INPUT_POST, 'password');
  if (!empty($username)){
    if (!empty($password)){
      $host = "localhost";
      $dbusername = "root";
      $dbpassword = "";
      $dbname = "kookyCooks";

      $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

      $sql = "SELECT * FROM User WHERE User.email = '".$username."'";
      $result = $conn->query($sql);

      while($row = mysqli_fetch_array( $result ) ){
        $check_username=$row['email'];
      }

      if($username == $check_username){
        header('location: create_error.html');
        die();
      }

      else {
        if (mysqli_connect_error()){
          die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
        }

        else{
          $sql = "INSERT INTO User (email, pass) values ('$username', '$password')";

          if ($conn->query($sql)){
            header('location: good_entry.html');
            die();
          }

          else{
            echo "Error: ". $sql ."
            ". $conn->error;
          }
          $conn->close();
        }
      }
    }

    else{
      header('location: empty_field.html');
      die();
    }
  }

  else{
    header('location: empty_field.html');
    die();
  }
?>
