<!DOCTYPE HTML>
<html>
<head>
    <title>Aktualizacja</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Aktualizacja produktu</h1>
        </div>
     
        <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not fount');

            include 'config/database.php';

            try {
                $query = "SELECT id, name, description, price FROM products
                        WHERE id = ? LIMIT 0, 1";
                $stmt = $connect->prepare($query);

                $stmt->bindParam(1, $id);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
            }

            catch(PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        ?>
 
        <?php

            if($_POST) {
                
                try {

                    $query = "UPDATE products SET name=:name, description=:description, price=:price
                            WHERE id = :id";

                    $stmt = $connect->prepare($query);

                    // Przeslane dane
                    $name = htmlspecialchars(strip_tags($_POST['name']));
                    $description = htmlspecialchars(strip_tags($_POST['description']));
                    $price = htmlspecialchars(strip_tags($_POST['price']));

                    // Bindowanie
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':id', $id);

                    if($stmt->execute()){
                        echo "<div class='alert alert-success'>Rekord zaaktualizowany</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Wystąpił problem z wykoaniem zmiany</div>";
                    }
                }

                catch(PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table>
                <tr>
                    <td>Nazwa</td>
                    <td><input type="text" name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);?>" class='form-control'></td>
                </tr>
                <tr>
                    <td>Opis</td>
                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);?></textarea></td>
                </tr>
                <tr>
                    <td>Cena</td>
                    <td><input type="text" name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES); ?>" class='form-control'></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value='Zapisz zmiany' class='btn btn-primary' />
                        <a href="index.php" class='btn btn-danger'>Powrót do wyświetlania produktów</a>
                    </td>
                </tr>
            </table>
        </form>

         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>