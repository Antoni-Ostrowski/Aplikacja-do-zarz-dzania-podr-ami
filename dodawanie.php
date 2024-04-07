<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj podróż</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <h1>Dodaj podróż</h1>
    <?php
    include 'menu.php';

    $conn=mysqli_connect("localhost","root","","podroze");

    if (isset($_POST['submit'])) {
        $organizator = $_POST['organizator'];
        $data_podrozy = date('d/m/Y', strtotime($_POST['data_podrozy'])); 
        $opis = $_POST['opis'];
        $destynacja = $_POST['destynacja'];
        $cena = $_POST['cena'];

        $result = mysqli_query($conn, "INSERT INTO lista_podrozy (organizator, data_podrozy, opis, destynacja, cena) VALUES ('$organizator', '$data_podrozy', '$opis', '$destynacja', $cena)");

        if ($result) {
            // echo "Data inserted successfully.";
            echo "<script>alert('Dodano podróż!');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
   
   <form class="dodaj-form" method="post" action="dodawanie.php">
        <div class="form-child">
            <label class="dodaj-label" for="organizator">Organizator:</label>
            <input class="dodaj-input" type="text" id="organizator" name="organizator">
        </div>
        
        <div class="form-child">
            <label class="dodaj-label" for="data_podrozy">Data podróży:</label>
            <input class="dodaj-input" type="date" id="data_podrozy" name="data_podrozy">
        </div>

        <div class="form-child">
            <label class="dodaj-label" for="destynacja">Destynacja:</label>
            <input class="dodaj-input" type="text" id="destynacja" name="destynacja">
        </div>
        
        <div class="form-child">
            <label class="dodaj-label" for="opis">Opis:</label>
            <textarea class="dodaj-input" type="text" id="opis" name="opis"></textarea>
        </div>
        
        <div class="form-child">
            <label class="dodaj-label" for="cena">Cena:</label>
            <input class="dodaj-input" type="number" id="cena" name="cena">
        </div>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
