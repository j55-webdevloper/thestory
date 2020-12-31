<?php
    require 'dbh.inc.php';


    // Food -> Category 1 and Category 2
    $sqlFood = "SELECT COUNT('food') AS catCount FROM posts WHERE category_1 = 'Food';";
    $foodResult = $conn->query($sqlFood);

    $row = mysqli_fetch_assoc($foodResult);
    $foodCategory_1 = $row['catCount'];

    $sqlFood = "SELECT COUNT('food') AS catCount FROM posts WHERE category_2 = 'Food';";
    $foodResult = $conn->query($sqlFood);

    $row = mysqli_fetch_assoc($foodResult);
    $foodCategory_2 = $row['catCount'];

    // Travel -> Category 1 and Category 2
    $sqltravel = "SELECT COUNT('travel') AS catCount FROM posts WHERE category_1 = 'Travel';";
    $travelResult = $conn->query($sqltravel);

    $row = mysqli_fetch_assoc($travelResult);
    $travelCategory_1 = $row['catCount'];

    $sqltravel = "SELECT COUNT('travel') AS catCount FROM posts WHERE category_2 = 'Travel';";
    $travelResult = $conn->query($sqltravel);

    $row = mysqli_fetch_assoc($travelResult);
    $travelCategory_2 = $row['catCount'];

    // Dessert -> Category 1 and Category 2
    $sqldessert = "SELECT COUNT('dessert') AS catCount FROM posts WHERE category_1 = 'Dessert';";
    $dessertResult = $conn->query($sqldessert);

    $row = mysqli_fetch_assoc($dessertResult);
    $dessertCategory_1 = $row['catCount'];

    $sqldessert = "SELECT COUNT('dessert') AS catCount FROM posts WHERE category_2 = 'Dessert';";
    $dessertResult = $conn->query($sqldessert);

    $row = mysqli_fetch_assoc($dessertResult);
    $dessertCategory_2 = $row['catCount'];

    // Lifestyle -> Category 1 and Category 2
    $sqllifestyle = "SELECT COUNT('lifestyle') AS catCount FROM posts WHERE category_1 = 'Lifestyle';";
    $lifestyleResult = $conn->query($sqllifestyle);

    $row = mysqli_fetch_assoc($lifestyleResult);
    $lifestyleCategory_1 = $row['catCount'];

    $sqllifestyle = "SELECT COUNT('lifestyle') AS catCount FROM posts WHERE category_2 = 'Lifestyle';";
    $lifestyleResult = $conn->query($sqllifestyle);

    $row = mysqli_fetch_assoc($lifestyleResult);
    $lifestyleCategory_2 = $row['catCount'];

    // Recipes -> Category 1 and Category 2
    $sqlrecipes = "SELECT COUNT('recipes') AS catCount FROM posts WHERE category_1 = 'Recipes';";
    $recipesResult = $conn->query($sqlrecipes);

    $row = mysqli_fetch_assoc($recipesResult);
    $recipesCategory_1 = $row['catCount'];

    $sqlrecipes = "SELECT COUNT('recipes') AS catCount FROM posts WHERE category_2 = 'Recipes';";
    $recipesResult = $conn->query($sqlrecipes);

    $row = mysqli_fetch_assoc($recipesResult);
    $recipesCategory_2 = $row['catCount'];
