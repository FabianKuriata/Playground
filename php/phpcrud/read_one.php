<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Wyświetl dany rekord</title>
</head>
<body>
    
    <div class="container">
        <div class="page-header">
            <h1>Wyświetl produkt</h1>
        </div>

        <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found');

            // polaczenie z baza
            include 'config/database.php';

            try {
                $query = "SELECT id, name, description, price, image FROM products 
                        WHERE id = ? LIMIT 0,1";
                $stmt = $connect->prepare($query);

                $stmt->bindParam(1, $id);

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                $image = htmlspecialchars($row['image'], ENT_QUOTES);
            }

            catch(PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        ?>

        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Nazwa</td>
                <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Opis</td>
                <td><?php echo htmlspecialchars($description, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Cena</td>
                <td><?php echo htmlspecialchars($price, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td>Zdjęcie</td>
                <td><?php echo $image ? "<img src='uploads/{$image}' style='width:300px;'/>" : "Nie znaleziono zdjęcia" ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='index.php' class='btn btn-danger'>Powrót do wyświetlania produktów</a>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <!-- Latest compiled and minified Bootstrap JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>