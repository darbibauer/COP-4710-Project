CREATE TYPE CHARARRAY  AS CHAR(10) ARRAY[VARCHAR(10)];
DECLARE CHARA CHARARRAY;

CREATE DATABASE kookyCooks;

CREATE TABLE kookyCooks.User(
	tags VARCHAR(100),
    ingredients VARCHAR(1000),
    username VARCHAR(16),
    UserID INT,
    recipe_list VARCHAR(400),
    PRIMARY KEY(UserID)
    );
CREATE TABLE kookyCooks.User_Recipe(
	RecipeID INT,
    UserID INT,
    FOREIGN KEY(RecipeID) REFERENCES kookyCooks.Recipe(RecipeID),
    FOREIGN KEY(UserID) REFERENCES kookyCooks.User(UserID)
);
CREATE TABLE kookyCooks.Recipe(
	RecipeID INT,
    tags VARCHAR(100),
    recipe_name VARCHAR( 40),
    instructions VARCHAR(1000),
    PRIMARY KEY(RecipeID)
);
CREATE TABLE kookyCooks.Recipe_Ingredient(
	RecipeID INT,
    IngrID INT,
    amount INT,
    FOREIGN KEY(RecipeID) REFERENCES kookyCooks.Recipe(RecipeID),
    FOREIGN KEY(IngrID) REFERENCES kookyCooks.Ingredient(IngrID)
);
CREATE TABLE kookyCooks.Ingredient(
	IngrID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    PRIMARY KEY(IngrID)
);
CREATE TABLE kookyCooks.Grocery_List(
	ingredients VARCHAR(1000),
    UserID INT,
    GroceryID INT,
    Grocery_recipe_list VARCHAR(1000),
    PRIMARY KEY(GroceryID, UserID),
    FOREIGN KEY(UserID) REFERENCES kookyCooks.User(UserID)
);

