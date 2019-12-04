<?php
$search_term = filter_input(INPUT_POST, 'search_term');

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "kookyCooks";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$sql = "SELECT * FROM Recipe WHERE Recipe.recipe_name = '".$search_term."'";
$result = $conn->query($sql);
$number =  mysqli_num_rows($result);
?>
  <style>
  body {
    background-image: url('images/background4.png');
    background-repeat:no-repeat;
    background-size:1450px 230px;
    background-color:#E6B0AA;
  }
  </style>

  <br> <br> <br> <br> <br> <br> <br> <br>
  <br> <br> <br> <br> <br>

  <CENTER>
  Like one you see? Save it! <br> <br>
  <form method="post" action="save_recipe.php">
      &nbsp;&nbsp;&nbsp;&nbsp;Name of Recipe : <input type="text" name="recipe_name"> <br><br>
    <input type="submit" value="Save Recipe"><br><br>
  </form>

  <h2>Recipe Name Matches:</h2></CENTER>
  <?php
    if($number > 0){

    foreach($result as $key => $data){
  ?>
    <tr>
      <CENTER>
      <td><u><h3><?= "Recipe " . ++$key ?></u></h3></td>
      <td>Name: <?= $data['recipe_name'] ?></td> <br><br>
      <td>Instructions: <?= $data['instructions'] ?></td> <br><br>

      <?php
      $sql = "SELECT * FROM Ingredient
              LEFT JOIN Recipe_Ingredient
              ON Ingredient.IngrID = Recipe_Ingredient.IngrID
              LEFT JOIN Recipe
              ON Recipe_Ingredient.RecipeID = Recipe.RecipeID
              WHERE Recipe.RecipeID = '".$data["RecipeID"]."'";

      $result = $conn->query($sql);
      $number =  mysqli_num_rows($result);

      foreach($result as $key => $data){?>
        <td><?= $data['amount'] ." ". $data['name'] ?></td> <br><br>
      <?php } ?>

      <td>
        <i class="fa fa-edit"></i>
        <i class="fa fa-trash"></i>
      </CENTER>
      </td>
    </tr>
  <?php } }else{ ?>
    <style>
    body {
      background-image: url('images/background4.png');
      background-repeat:no-repeat;
      background-size:1450px 230px;
      background-color:#E6B0AA;
    }
    </style>

    <tr>
      <CENTER>
      <td colspan="7">No Recipes Found with Matching Name!</td> <br> <br>
      </CENTER>
    </tr>
<?php }
$sql = "SELECT * FROM Recipe
        WHERE Recipe.tag1 = '".$search_term."' OR
        Recipe.tag2 = '".$search_term."' OR
        Recipe.tag3 = '".$search_term."'";


$result = $conn->query($sql);
$number =  mysqli_num_rows($result);?>

<CENTER><h2>Recipe Tag Matches:</h2></CENTER>

    <?php if($number > 0){

      foreach($result as $key => $data){
      ?>
    <tr>
      <CENTER>
      <td><u><h3><?= "Recipe " . ++$key ?></u></h3></td>
      <td><u>Name</u><br> <?= $data['recipe_name'] ?></td> <br><br>
      <td><u>Instructions</u><br> <?= $data['instructions'] ?></td> <br><br>
      <td><u>Ingredients</u><br></td> <br>

      <?php
      $sql = "SELECT * FROM Ingredient
              LEFT JOIN Recipe_Ingredient
              ON Ingredient.IngrID = Recipe_Ingredient.IngrID
              LEFT JOIN Recipe
              ON Recipe_Ingredient.RecipeID = Recipe.RecipeID
              WHERE Recipe.RecipeID = '".$data["RecipeID"]."'";

      $result = $conn->query($sql);
      $number =  mysqli_num_rows($result);

      foreach($result as $key => $data){ ?>
        <td><?= $data['amount'] ." ". $data['name'] ?></td> <br><br>
      <?php } ?>

      <td>
        <i class="fa fa-edit"></i>
        <i class="fa fa-trash"></i>
        <br><br>
      </CENTER>
      </td>
    </tr>
  <?php } } else {?>
    <CENTER>
    <td colspan="7">No Recipes Found with Matching Tags!</td> <br> <br>
    </CENTER>
  </tr>
<?php } ?>
<CENTER>
<button type="submit" onclick="window.location.href='home_page.php'">Go Back</button>
</CENTER>
