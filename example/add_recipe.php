<?php
  $recipe_name = filter_input(INPUT_POST, 'recipe_name');
  $tag1 = filter_input(INPUT_POST, 'tag1');
  $tag2 = filter_input(INPUT_POST, 'tag2');
  $tag3 = filter_input(INPUT_POST, 'tag3');
  $instructions = filter_input(INPUT_POST, 'instructions');

  $ingredient1 = filter_input(INPUT_POST, 'ingredient1');
  $ingredient2 = filter_input(INPUT_POST, 'ingredient2');
  $ingredient3 = filter_input(INPUT_POST, 'ingredient3');
  $ingredient4 = filter_input(INPUT_POST, 'ingredient4');
  $ingredient5 = filter_input(INPUT_POST, 'ingredient5');
  $ingredient6 = filter_input(INPUT_POST, 'ingredient6');
  $ingredient7 = filter_input(INPUT_POST, 'ingredient7');
  $ingredient8 = filter_input(INPUT_POST, 'ingredient8');
  $ingredient9 = filter_input(INPUT_POST, 'ingredient9');
  $ingredient10 = filter_input(INPUT_POST, 'ingredient10');
  $ingredient11 = filter_input(INPUT_POST, 'ingredient11');
  $ingredient12 = filter_input(INPUT_POST, 'ingredient12');
  $ingredient13 = filter_input(INPUT_POST, 'ingredient13');
  $ingredient14 = filter_input(INPUT_POST, 'ingredient14');
  $ingredient15 = filter_input(INPUT_POST, 'ingredient15');
  $ingredient16 = filter_input(INPUT_POST, 'ingredient16');
  $ingredient17 = filter_input(INPUT_POST, 'ingredient17');
  $ingredient18 = filter_input(INPUT_POST, 'ingredient18');
  $ingredient19 = filter_input(INPUT_POST, 'ingredient19');
  $ingredient20 = filter_input(INPUT_POST, 'ingredient20');

  $amount1 = filter_input(INPUT_POST, 'amount1');
  $amount2 = filter_input(INPUT_POST, 'amount2');
  $amount3 = filter_input(INPUT_POST, 'amount3');
  $amount4 = filter_input(INPUT_POST, 'amount4');
  $amount5 = filter_input(INPUT_POST, 'amount5');
  $amount6 = filter_input(INPUT_POST, 'amount6');
  $amount7 = filter_input(INPUT_POST, 'amount7');
  $amount8 = filter_input(INPUT_POST, 'amount8');
  $amount9 = filter_input(INPUT_POST, 'amount9');
  $amount10 = filter_input(INPUT_POST, 'amount10');
  $amount11 = filter_input(INPUT_POST, 'amount11');
  $amount12 = filter_input(INPUT_POST, 'amount12');
  $amount13 = filter_input(INPUT_POST, 'amount13');
  $amount14 = filter_input(INPUT_POST, 'amount14');
  $amount15 = filter_input(INPUT_POST, 'amount15');
  $amount16 = filter_input(INPUT_POST, 'amount16');
  $amount17 = filter_input(INPUT_POST, 'amount17');
  $amount18 = filter_input(INPUT_POST, 'amount18');
  $amount19 = filter_input(INPUT_POST, 'amount19');
  $amount20 = filter_input(INPUT_POST, 'amount20');

  if (!empty($recipe_name) && !empty($instructions) && !empty($ingredient1)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "kookyCooks";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    $sql = "SELECT * FROM Recipe WHERE Recipe.recipe_name = '".$recipe_name."'";
    $result = $conn->query($sql);

    while($row = mysqli_fetch_array( $result ) ){
      $check_name=$row['recipe_name'];
      $check_instructions=$row['instructions'];
    }

    if($recipe_name == $check_name){
      header('location: duplicate_recipe.html');
      die();
    }

    else {
      if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
      }

      else{
        $sql = "INSERT INTO Recipe (recipe_name, tag1, tag2, tag3, instructions)
          values ('$recipe_name', '$tag1', '$tag2', '$tag3', '$instructions')";

        if ($conn->query($sql)){
          $last_id = $conn->insert_id;

          for($i = 1; $i<=20; $i++) {
            $last_id = $conn->insert_id;

            if (empty(${"ingredient" . $i}) || empty(${"amount" . $i})){
              continue;
            }

            $sql = "SELECT * FROM Ingredient WHERE Ingredient.name = '".${"ingredient" . $i}."'";
            $result = $conn->query($sql);

            while($row = mysqli_fetch_array( $result ) ){
              $check_ingredient=$row['name'];
            }

            if($check_ingredient != ${"ingredient" . $i}){
              $sql="INSERT INTO Ingredient (name) values ('${"ingredient" . $i}')";
              $conn->query($sql);
            }

            $result = $conn->query("SELECT RecipeID FROM Recipe WHERE Recipe.recipe_name = '".$recipe_name."' && Recipe.instructions = '".$instructions."'");
            $row = mysqli_fetch_assoc($result);

            $result = $conn->query("SELECT IngrID FROM Ingredient WHERE Ingredient.name = '".${"ingredient" . $i}."'");
            $row2 = mysqli_fetch_assoc($result);

            $sql = "INSERT INTO Recipe_Ingredient (RecipeID, IngrID, amount) values ('".$row["RecipeID"]."', '".$row2["IngrID"]."', '".${"amount" . $i}."')";
            $conn->query($sql);
          }
          header('location: recipe_entered.html');
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
    header('location: empty_field2.html');
    die();
  }

  die();
?>
