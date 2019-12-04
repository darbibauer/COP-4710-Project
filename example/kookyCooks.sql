CREATE DATABASE kookyCooks;

CREATE TABLE kookyCooks.User(
	email VARCHAR(100),
    pass VARCHAR(1000),
    UserID INT NOT NULL AUTO_INCREMENT,
    recipe_list VARCHAR(400),
    fName VARCHAR(100),
    lName VARCHAR(100),
    PRIMARY KEY(UserID)
    );

CREATE TABLE kookyCooks.Recipe(
	RecipeID INT NOT NULL AUTO_INCREMENT,
    tags VARCHAR(100),
    ingredients VARCHAR(1000),
    recipe_name VARCHAR( 40),
    instructions VARCHAR(1000),
    PRIMARY KEY(RecipeID)
);

CREATE TABLE kookyCooks.Grocery_List(
	ingredients VARCHAR(1000),
    UserID INT,
    GroceryID INT NOT NULL AUTO_INCREMENT,
    Grocery_recipe_list VARCHAR(1000),
    PRIMARY KEY(GroceryID, UserID),
    FOREIGN KEY(UserID) REFERENCES kookyCooks.User(UserID)
);

