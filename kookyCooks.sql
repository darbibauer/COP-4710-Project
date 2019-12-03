CREATE DATABASE kookyCooks;

CREATE TABLE kookyCooks.User(
	tags VARCHAR(100),
    ingredients VARCHAR(1000),
    username VARCHAR(16),
    UserID INT,
    recipe_list VARCHAR(400),
    PRIMARY KEY(UserID)
    );

CREATE TABLE kookyCooks.Recipe(
	RecipeID INT,
    tags VARCHAR(100),
    ingredients VARCHAR(1000),
    recipe_name VARCHAR( 40),
    instructions VARCHAR(1000),
    PRIMARY KEY(RecipeID)
);

CREATE TABLE kookyCooks.Grocery_List(
	ingredients VARCHAR(1000),
    UserID INT,
    GroceryID INT,
    Grocery_recipe_list VARCHAR(1000),
    PRIMARY KEY(GroceryID, UserID),
    FOREIGN KEY(UserID) REFERENCES kookyCooks.User(UserID)
);

