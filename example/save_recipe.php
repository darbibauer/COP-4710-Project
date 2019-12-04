<?php
  session_start();
  $recipe_name = filter_input(INPUT_POST, 'recipe_name');
  $username = $_SESSION['$username'];
  $password = $_SESSION['$password'];

  if(!empty($recipe_name) && !empty($username) && !empty($password)){
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
      $result = $conn->query("SELECT RecipeID FROM Recipe WHERE Recipe.recipe_name = '".$recipe_name."'");
      $row = mysqli_fetch_assoc($result);

      $result = $conn->query("SELECT UserID FROM User WHERE User.email = '".$username."'");
      $row2 = mysqli_fetch_assoc($result);

      $sql = "INSERT INTO User_Recipe (RecipeID, UserID) values ('".$row["RecipeID"]."', '".$row2["UserID"]."')";


      if($conn->query($sql)){
        header('location: recipe_entered.html');
        die();
      }
      else{
        header('location: invalid_login2.html');
        die();
      }
    }
    else{
      header('location: invalid_login2.html');
      die();
    }
  }
  else{
    header('location: empty_field2.html');
    die();
  }
?>
