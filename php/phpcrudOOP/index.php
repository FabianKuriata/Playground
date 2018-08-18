<?php
    // przechowuje zmienne do stronicowania (pagination)  
    include_once 'config/core.php';

    // baza danych i obiekty
    include_once 'config/database.php';
    include_once 'objects/product.php';
    include_once 'objects/category.php';

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);
    $category = new Category($db);

    // header
    $page_title = "Produkty";
    include_once "layout_header.php";

    // zapytanie do produktow
    $stmt = $product->readAll($from_record_num, $records_per_page);
    
    $page_url = "index.php?";

    $total_rows = $product->countAll();

    // kotroluje jak ma byc lista wyswietlana
    include_once "read_template.php";

    // footer
    include_once "layout_footer.php";
?>