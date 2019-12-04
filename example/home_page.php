<title> Kooky Cooks </title>
<style>
body {
  background-image: url('images/background4.png');
  background-repeat:no-repeat;
  background-size:1450px 230px;
  background-color:#E6B0AA;
}
</style>
</head>

<body>

<br> <br> <br> <br> <br> <br> <br> <br>
<br> <br> <br> <br> <br> <br> <br>

<CENTER>
<button type="submit" onclick="window.location.href='add_recipe.html'">Add Recipe</button>

&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

<button type="submit" onclick="window.location.href='search_page.html'">&emsp;Search&emsp;</button>

&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

<button type="submit" onclick="window.location.href='change_password.html'">Change Password</button>

&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

<button type="submit" onclick="window.location.href='index.html'">Sign Out</button><br><br>

<h2><u>Saved Recipes</h2></u>

<?php
  session_start();
  $username = $_SESSION['$username'];
  $password = $_SESSION['$password'];

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "kookyCooks";

  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  $sql = "SELECT DISTINCT * FROM Recipe
          LEFT JOIN User_Recipe
          ON Recipe.RecipeID = User_Recipe.RecipeID
          LEFT JOIN User
          ON User.UserID = User_Recipe.UserID
          WHERE User.email = '".$username."'";

  $result = $conn->query($sql);
  $number =  mysqli_num_rows($result);

  foreach($result as $key => $data){?>
    <td><?= $data['recipe_name'] ?></td> <br><br>
      <?php } ?>

    <td>
      <i class="fa fa-edit"></i>
      <i class="fa fa-trash"></i>
    </td>

    <br><i>Want to remove a recipe? Enter the name below: </i><br><br>
    <form method="post" action="remove.php">
      <input type="text" name="removal"><br><br>
      <input type="submit" value="Remove Recipe">
    </form>

  <br><br><h2><u>Grocery List</h2></u>

<?php
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$sql = "SELECT DISTINCT * FROM Recipe
        LEFT JOIN User_Recipe
        ON Recipe.RecipeID = User_Recipe.RecipeID
        LEFT JOIN User
        ON User.UserID = User_Recipe.UserID
        WHERE User.email = '".$username."'";

$result = $conn->query($sql);
$number =  mysqli_num_rows($result);

foreach($result as $key => $data){
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
  <?php } }?>

</CENTER>
