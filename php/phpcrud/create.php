<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dodawanie | CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>
<body>
    
    <div class="container">
        <div class="page-header">
            <h1>Dodaj nowy produkt</h1>
        </div>
    </div>
<!-- PHP insert code will be here -->
<?php
    if($_POST) {
    
        // include database connection
        include 'config/database.php';

        try {
        
            // insert query
            $query = "INSERT INTO products 
                        SET name=:name, description=:description,
                            price=:price, image=:image, created=:created";
    
            // przygotowanie zapytania do wykonania
            $stmt = $connect->prepare($query);
    
            // przeslane wartosci
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $price = htmlspecialchars(strip_tags($_POST['price']));
            
            // przeslane zdjecie zdjecie
            $image = !empty($_FILES["image"]["name"])
                        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"])
                        : "";
            $image = htmlspecialchars(strip_tags($image));

            // bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);

            // specify when this record was inserted to the database
            $created=date('Y-m-d H:i:s');
            $stmt->bindParam(':created', $created);
            
            // Execute the query
            if($stmt->execute()){
                echo "<div class='alert alert-success'>Record was saved.</div>";

                if($image) {
                    // sh1_file() funkcja uzywana to tworzenie unikalnych nazw plikow
                    $target_directory = "uploads/";
                    $target_file = $target_directory . $image;
                    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

                    // 
                    $file_upload_error_messages = "";

                    // upewnienie sie czy plik jest prawdziwy
                    $check = getimagesize($_FILES["image"]["tmp_name"]);

                    if($check !== false) {
                        // przeslany plik jest zdjeciem
                    } else {
                        $file_upload_error_messages .="<div> Przeslany plik nie jest zdjeciem. </div>";
                    }

                    $allowed_file_types = array("jpg", "jpeg", "png", "gif");
                    if(!in_array($file_type, $allowed_file_types)) {
                        $file_upload_error_messages .= "<div>Dozwolane są jedynie pliki JPG, JPEG, PNG, GIF";
                    }

                    // Upewnienie sie czy plik nie istenieje
                    if(file_exists($target_file)) {
                        $file_upload_error_messages .= "<div>Zdjedzie juz istenieje. Sprobuj zmienic nazwe pliku</div>";
                    }

                    // upewnienie sie czy plik nie jest za duzy
                    if($_FILES['image']['size'] > (1024000)) {
                        $file_upload_error_messages .="<div>Zdjecie musi być ważyć mniej niż 1MB.</div>";
                    }

                    // upewnienie sie czy istnieje folder 'uploads'
                    if(!is_dir($target_directory)) {
                        mkdir($target_directory, 0777, true);
                    }

                    if(empty($file_upload_error_messages)) {
                        // nie ma błedów, zatem przesylamy
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            // zdjecie przeslano
                        } 
                        else {
                            echo "<div class='alert alert-danger'>";
                                echo "<div>Nie udało się przesłać zdjęcia.</div>";
                                echo "<div>Zmień rekord aby przeslac zdjecie lub sprobuj ponownie</div>";
                            echo "</div>";
                        }
                    } 
                    else {
                        // pojawily sie bledy
                        echo "<div class='alert alert-danger'>";
                            echo "<div>{$file_upload_error_messages}</div>";
                            echo "<div>Zmień rekord aby przeslac zdjecie lub sprobuj ponownie.</div>";
                        echo "</div>";
                    }
                }
            } else{
                echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }
            
        }
        
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Nazwa</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>
            <tr>
                <td>Opis</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Cena</td>
                <td><input type='text' name='price' class='form-control' /></td>
            </tr>
            <tr>
                <td>Zdjęcie</td>
                <td><input type="file" name="image" id="" /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Powrót do wyświetlania produktów</a>
                </td>
            </tr>
        </table>
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>