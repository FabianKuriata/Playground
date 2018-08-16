<?php

    
    include 'config/database.php';

    try {
        // pobierz rekord
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found');

        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(1, $id);

        if($stmt->execute()) {
            // Przekierowanie i zwrocenie informacji o usunieciu
            header('Location: index.php?action=deleted');
        }
        else {
            die('Unable to delete record.');
        }
    }

    catch(PDOException $exception) {
        die('ERROR ' . $exception->getMessage());
    }
?>