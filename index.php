<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podroże</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <h1>Podroże</h1>
    <?php
    include 'menu.php';

    $conn=mysqli_connect("localhost","root","","podroze");

    if(!$conn){
        die (mysqli_connect_error() . "error");
    }

    $editing = false; // Initial state of editing

    if(isset($_POST['edit'])) {
        $editing = true;
    }

    if(isset($_POST['cancel'])) {
        $editing = false;
    }

    if(isset($_POST['delete'])) {
        $id_podrozy = $_POST['id_podrozy'];
        $sql = "DELETE FROM lista_podrozy WHERE id_podrozy = $id_podrozy";
        $result = mysqli_query($conn, $sql);
        
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['update'])) {
        $id_podrozy = $_POST['id_podrozy'];
        $destynacja = $_POST['destynacja'];
        $data_podrozy = $_POST['data_podrozy'];
        $cena = $_POST['cena'];
        $opis = $_POST['opis'];
        $organizator = $_POST['organizator'];

        $data_podrozy = $_POST['data_podrozy'];
        $formatted_date = date("d/m/Y", strtotime($data_podrozy));

        echo "ID: $id_podrozy<br>";
        echo "Destynacja: $destynacja<br>";
        echo "Data podroży: $formatted_date<br>";
        echo "Cena: $cena<br>";
        echo "Opis: $opis<br>";
        echo "Organizator: $organizator<br>";

        // Update the record in the database
        $sql = "UPDATE lista_podrozy SET destynacja='$destynacja', data_podrozy='$formatted_date', cena=$cena, opis='$opis', organizator='$organizator' WHERE id_podrozy = $id_podrozy";
        $result = mysqli_query($conn, $sql);

        // Redirect to refresh the page after update
        header("Location: index.php");
        exit;
    }

    $sql="SELECT * FROM lista_podrozy";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="podroz">';
            echo "<form action='index.php' method='POST'>";
            echo "<input type='hidden' name='id_podrozy' value='".$row['id_podrozy']."'>";
            echo "<p>ID: " . $row['id_podrozy'] ."</p>";
            
            if ($editing) {
                // Show inputs for editing
                echo "<p>Destynacja: <input type='text' name='destynacja' value='".$row['destynacja']."'></p>";
                echo "<p>Data podroży: <input type='date' name='data_podrozy' value='".$row['data_podrozy']."'></p>";
                echo "<p>Cena: <input type='number' name='cena' value='".$row['cena']."'></p>";
                echo "<p>Opis: <textarea name='opis'>".$row['opis']."</textarea></p>";
                echo "<p>Organizator: <input type='text' name='organizator' value='".$row['organizator']."'></p>";
                echo "<input type='submit' name='update' value='Save'>";
                echo "<input type='submit' name='cancel' value='Cancel'>";
            } else {
                // Show text if not editing
                echo "<p>Destynacja: " . $row['destynacja'] ."</p>";
                echo "<p>Data podroży: " . $row['data_podrozy'] ."</p>";
                echo "<p>Cena: " . $row['cena'] ."</p>";
                echo "<p>Opis: " . $row['opis'] ."</p>";
                echo "<p>Organizator: " . $row['organizator'] ."</p>";
                
                if($_SESSION['upr'] === 'admin' || $_SESSION['upr'] === 'pracownik') {
                    echo "<input type='submit' name='edit' value='Edit'>";
                    echo "<input type='submit' name='delete' value='Delete'>";
                }
                
            }
            echo "</form>";           
            echo "</div>";
        }
    }
    ?>

</body>
</html>
