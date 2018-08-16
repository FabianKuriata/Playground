<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wyświetlanie | CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        .m-b-1em {
            margin-bottom: 1em;
        }
        .m-l-1em {
            margin-left: 1em;
        }
        .mt0 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    
    <div class="container">
        
        <div class="page-header">
            <h1>Lista produktów zawartych w bazie</h1>
        </div>

        <?php
            $action = isset($_GET['action']) ? $_GET['action'] : "";

            if($action == 'deleted' ) {
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
        ?>

        <?php
            include 'config/database.php';
            // Biezaca strona
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // wierszy na strone
            $records_per_page = 5;
            
            // wyliczenie potrzebne do ustawienia limitu w zapytaniu
            $from_record_num = ($records_per_page * $page) - $records_per_page;

            
            
            $query = "SELECT id, name, description, price FROM products ORDER BY id DESC
                    LIMIT :from_record_num, :records_per_page";
            $stmt = $connect->prepare($query);
            $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
            $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
            $stmt->execute();

            $num = $stmt->rowCount();

            echo "<a href='create.php' class='btn btn-primary m-b-1em'>Utwórz nowy produkt</a>";
            
            if($num > 0) {
    
                echo "<table class='table table-hover table-responsive table-bordered'>";

                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Description</th>";
                    echo "<th>Price</th>";
                    echo "<th>Action</th>";
                echo "</tr>";
                
                
                    
                // Wczytanie danych
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Extract sprawia, ze mozemy sie odwolac bezposrednio do
                    // konretnego wiersza, a nie wyciagac go z tablicy
                    // $row['firstname'] - $firstname
                    extract($row);

                    echo "<tr>";
                        echo "<td>{$id}</td>";
                        echo "<td>{$name}</td>";
                        echo "<td>{$description}</td>";
                        echo "<td>&#36;{$price}</td>";
                        echo "<td>";

                            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Sprawdź</a>";

                            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edytuj</a>";

                            echo "<a href='#' onclick='delete_user({$id});' class='btn btn-danger'>Usuń</a>";
                        echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                // PAGINATION
                // policzenie liczby wierszy
                $query = "SELECT COUNT(*) as total_rows FROM products";
                $stmt = $connect->prepare($query);

                $stmt->execute();   

                // pobierz liczbe wierszy
                $row = $stmt->fetch(PDO::FETCH_ASSOC); // zwraca wyniki zapytania jako tablica asocjacyjna
                $total_rows = $row['total_rows'];

                //
                $page_url = "index.php?";
                include_once "paging.php";
            }
            else {
                echo "<div class='alert alert-danger'>Nie znaleziono rekordów</div>";
            }

           
        ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
   <!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script type='text/javascript'>
    function delete_user(id) {
        var answer = confirm('Are you sure?');
        if(answer) {
            window.location = 'delete.php?id=' + id;
        }
    }
</script>

</body>
</html>