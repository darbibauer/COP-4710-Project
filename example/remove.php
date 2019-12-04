<?php
  session_start();
  $username = $_SESSION['$username'];
  $recipe_name = filter_input(INPUT_POST, 'removal');

  if(!empty($recipe_name)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "kookyCooks";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    $result = $conn->query("SELECT RecipeID FROM Recipe WHERE Recipe.recipe_name = '".$recipe_name."'");
    $row = mysqli_fetch_assoc($result);

    $result = $conn->query("SELECT UserID FROM User WHERE User.email = '".$username."'");
    $row2 = mysqli_fetch_assoc($result);

    $sql = "DELETE FROM User_Recipe WHERE User_Recipe.RecipeID = '".$row["RecipeID"]."' && User_Recipe.UserID = '".$row2["UserID"]."'";

    if($conn->query($sql)){
      header('location: entry_deleted.html');
      die();
    }
  }
  else{
    header('location: home_page.php');
    die();
  }
?>
