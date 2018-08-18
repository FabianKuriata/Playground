<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
$category = new Category($db);

$search_term = isset($_GET['s']) ? $_GET['s'] : '';

$page_title = "Szukasz \"{$search_term}\"";
include_once "layout_header.php";


$stmt = $product->search($search_term, $from_record_num, $records_per_page);

$page_url = "search.php?s={$search_term}&";

$total_rows = $product->countAll_BySearch($search_term);

include_once "read_template.php";

include_once "layout_footer.php";

?>