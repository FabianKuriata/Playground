<?php
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    include_once 'config/database.php';
    include_once 'objects/product.php';
    include_once 'objects/category.php';

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);
    $category = new Category($db);

    $product->id = $id;

    $product->readOne();


    // header
    $page_title = "Wyświetlenie jednego";
    include_once "layout_header.php";

    // przycisk powrotu
    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-primary pull-right'>";
            echo "<span class='glyphicon glyphicon-list'></span>Wyświetl produkty";
        echo "</a>";
    echo "</div>";


    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        echo "<tr>";
            echo "<td>Name</td>";
            echo "<td>{$product->name}</td>";
        echo "</tr>";
    
        echo "<tr>";
            echo "<td>Price</td>";
            echo "<td>&#36;{$product->price}</td>";
        echo "</tr>";
    
        echo "<tr>";
            echo "<td>Description</td>";
            echo "<td>{$product->description}</td>";
        echo "</tr>";
    
        echo "<tr>";
            echo "<td>Category</td>";
            echo "<td>";
                // wyswietl nazwe
                $category->id=$product->category_id;
                $category->readName();
                echo $category->name;
            echo "</td>";
        echo "</tr>";

        echo "<tr>";
            echo "<td>Zdjęcie</td>";
            echo "<td>";
                echo $product->image ? "<img src='uploads/{$product->image}' style='width:300px;' />" : "Brak zdjęcia";
            echo "</td>";
        echo "</tr>";
    echo "</table>";
    // footer
    include_once "layout_footer.php";
?>