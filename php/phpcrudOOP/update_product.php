<?php
// wczytanie
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';

// polaczenie z baza
$database = new Database();
$db = $database->getConnection();

// obiekty
$product = new Product($db);
$category = new Category($db);

// ustawienie id
$product->id = $id;

// wczytaj jeden
$product->readOne();

// header
$page_title = "Aktualizacja produktu";
include_once "layout_header.php";

// content

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Wczytaj produkty</a>";
echo "</div>";


// aktualizacja
?>
<?php
if($_POST) {
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];

    if($product->update()) {
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Produkt zaaktualizowany";
        echo "</div>";
    }
    // jesli sie nie powiodlo
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Aktualizacja się nie powiodła";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Nazwa</td>
            <td>
                <input type="text" name='name' class='form-control' value = '<?php echo $product->name; ?>'/>
            </td>
        </tr>
        <tr>
            <td>Cena</td>
            <td><input type="text" name='price' value='<?php echo $product->price; ?>' class='form-control'/></td>
        </tr>
        <tr>
            <td>Opis</td>
            <td>
                <textarea name='description' class='form-control'><?php echo $product->description; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Kategoria</td>
            <td>
                <?php
                    $stmt = $category->read();

                    echo "<select class='form-control' name='category_id'>";
                        echo "<option>Wybierz kategorię</option>";
                        while($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $category_id = $row_category['id'];
                            $category_name = $row_category['name'];

                            if($product->category_id == $category_id) {
                                echo "<option value='$category_id' selected>";
                            } else {
                                echo "<option value='$category_id'>";
                            }

                            echo "$category_name</option>";
                        }
                    echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Zaktualizuj</button>
            </td>
        </tr>
    </table>
</form>

<?php

// footer
include_once "layout_footer.php";
?>