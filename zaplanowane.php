<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaplanowane podróże</title>
    <link rel="stylesheet" href="styless.css">
    <script src="https://kit.fontawesome.com/f8537a5e86.js" crossorigin="anonymous"></script>    
</head>
<body>
    <?php
    include 'menu.php';

    $conn=mysqli_connect("localhost","root","","podroze");

   ?>
   <?php 
    $conn=mysqli_connect("localhost","root","","podroze");

    if(!$conn){
        die (mysqli_connect_error() . "error");
    }
    ?>
    <?php 
     if(isset($_GET['usun-z-ulubionych'])) {
        $id_podrozy = $_GET['id_podrozy'];
        
         $result = mysqli_query($conn, "DELETE FROM ulubione_podroze WHERE id_podrozy = $id_podrozy");
    }
    if(isset($_GET['dodaj-do-ulubionych'])) {
       $id_podrozy = $_GET['id_podrozy'];
       $user_login = $_SESSION['user'];
       $data_polubienia = date('d/m/Y');

        $result = mysqli_query($conn, "INSERT INTO ulubione_podroze VALUES (NULL, '$id_podrozy', '$user_login', '$')");
    }

    if(isset($_GET['usun-z-zaplanowanych'])) {
        $id_podrozy = $_GET['id_podrozy'];
        
         $result = mysqli_query($conn, "DELETE FROM zaplanowane_podroze WHERE id_podrozy = $id_podrozy");
    }
    if(isset($_GET['dodaj-do-zaplanowanych'])) {
       $id_podrozy = $_GET['id_podrozy'];
       $user_login = $_SESSION['user'];
       $data_zaplanowania = date('d/m/Y');

        $result = mysqli_query($conn, "INSERT INTO zaplanowane_podroze VALUES (NULL, '$data_zaplanowania', '$id_podrozy', '$user_login')");
    }

    if(isset($_GET['ocena'])) {
        $id_podrozy = $_GET['id_podrozy'];
        $user_login = $_SESSION['user'];
        $data_recenzji = date('d/m/Y');
        $ocena = $_GET['ocena'];
            // echo $id_podrozy;
            // echo $ocena;

        $check_query = "SELECT * FROM recenzje WHERE id_podrozy = '$id_podrozy' AND user_login = '$user_login'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $update_query = "UPDATE recenzje SET ocena = '$ocena', data_recenzji = '$data_recenzji' WHERE id_podrozy = '$id_podrozy' AND user_login = '$user_login'";
            if (mysqli_query($conn, $update_query)) {
            } else {
            }
        } else {
            // If the row doesn't exist, do nothing or handle it as needed
            $result = mysqli_query($conn, "INSERT INTO recenzje VALUES (NULL, $id_podrozy, '$user_login','$ocena', $data_recenzji)");

            if (mysqli_query($conn, $updaresultte_query)) {
            } else {
            }
        }
     }
    
    ?>

    <div class="podroze-container">
    <?php 
    $login = $_SESSION['user'];

    $result = mysqli_query($conn, "SELECT * FROM lista_podrozy JOIN zaplanowane_podroze ON lista_podrozy.id_podrozy = zaplanowane_podroze.id_podrozy WHERE zaplanowane_podroze.user_login = '$login'");

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id_podrozy = $row['id_podrozy'];
            $login = $_SESSION['user'];


            echo '<div class="podroz">';

                echo "<div class='info-container'>";
                echo "<p><strong>Organizator:</strong> " . $row['organizator'] ."</p>";
                echo "<p><strong>Destynacja:</strong> " . $row['destynacja'] ."</p>";
                echo "<p><strong>Data podroży:</strong> " . $row['data_podrozy'] ."</p>";
                echo "<p><strong>Cena:</strong> " . $row['cena'] ."</p>";
                echo "<p class='opis'><strong>Opis:</strong> " . $row['opis'] ."</p>";
                
     echo '</div>';

     echo "<div class='icons'>";

                
               // FORM OD DODAWANIA I USUWANIA PODROZY Z LISTY ULUBIONYCH
               echo "<form method='GET' action=''>";
               echo "<input type='hidden' name='id_podrozy' value='$id_podrozy'>";

               $ulubioneResult = mysqli_query($conn, "SELECT * FROM ulubione_podroze WHERE id_podrozy = $id_podrozy AND user_login = '$login'");
               if(mysqli_num_rows($ulubioneResult) > 0) {

                echo "<input type='hidden' name='usun-z-ulubionych' value='usun z ulubionych' />";
                echo "<button type='submit' name='usun-z-zaplanowanych' class='save-btns' title='Usuń podroż z ulubionych podróży.'><i class='fas fa-bookmark'></i></button>";


            }   else {
                echo "<input type='hidden' name='dodaj-do-ulubionych' value='dodaj do ulubionych'/>";
                echo "<button type='submit' name='dodaj-do-ulubionych' class='save-btns' title='Dodaj podroż do ulubionych podróży.'><i class='fa-regular fa-bookmark'></i></button>";

                
            }

           echo "</form>";

                // FORM OD DODAWANIA I USUWANIA PODROZY Z LISTY ZAPLANOWANYCH
               echo "<form method='GET' action=''>";
               echo "<input type='hidden' name='id_podrozy' value='$id_podrozy'>";

               $zaplanowaneResult = mysqli_query($conn, "SELECT * FROM zaplanowane_podroze WHERE id_podrozy = $id_podrozy AND user_login = '$login'");

               if (mysqli_num_rows($zaplanowaneResult) > 0) {
                // Zaplanowany
                echo "<button type='submit' class='plane-btns' name='usun-z-zaplanowanych' title='Usuń podroż z zaplanowanych podróży.'>";
                echo "<i class='" . ($zaplanowaneResult ? 'fa-solid' : 'fa-regular') . " fa-plane-slash'></i>";
                echo "</button>";
            } else {
                // Niezaplanowany
                
                echo "<button type='submit' class='plane-btns' name='dodaj-do-zaplanowanych' title='Dodaj podroż do zaplanowanych podróży.'>";
                echo "<i class='" . ($zaplanowaneResult ? 'fa-solid' : 'fa-regular') . " fa-plane'></i>";
                echo "</button>";
            }

               echo "</form>";



            // FORM OD WYSTAWIANIA OCEN 
            echo "<form method='GET' action=''>";
            echo "<input type='hidden' name='id_podrozy' value='$id_podrozy'>";

            $zaplanowaneResult = mysqli_query($conn, "SELECT * FROM recenzje WHERE id_podrozy = $id_podrozy AND user_login = '$login'");
        
            if (mysqli_num_rows($zaplanowaneResult) > 0) {
                while ($row = mysqli_fetch_assoc($zaplanowaneResult)) {
                    $ocena = $row['ocena'];
                    

                    echo "<div class='ratings-div'>";

                        // Good
                        echo "<button type='submit' class='good-btn' name='ocena' value='good' title='Oceń podróż: pozytywnie'>";
                        echo "<i class='" . ($ocena == 'good' ? 'fa-solid' : 'fa-regular') . " fa-thumbs-up'></i>";
                        echo "</button>";
                
                        // Bad
                        echo "<button type='submit' class='bad-btn' name='ocena' value='bad' title='Oceń podróż: negatywnie'>";
                        echo "<i class='" . ($ocena == 'bad' ? 'fa-solid' : 'fa-regular') . " fa-thumbs-down'></i>";
                        echo "</button>";
                
                        // Not Sure (Combo)
                        echo "<button type='submit' class='not-sure-btn' name='ocena' value='not_sure' title='Ocen podróż: niezdecydowany'>";
                        echo "<i class='" . ($ocena == 'not_sure' ? 'fa-solid' : 'fa-regular') . " fa-thumbs-up'></i>";
                        echo "<i class='" . ($ocena == 'not_sure' ? 'fa-solid' : 'fa-regular') . " fa-thumbs-down'></i>";
                        echo "</button>";
                    
                    echo "</div>";
                
                
                }
            } else {
                echo "<div class='ratings-div'>";

                    // Default buttons if no records found
                    echo "<button type='submit' class='good-btn' name='ocena' value='good' title='Oceń podróż: pozytywnie'>";
                    echo "<i class='fa-regular fa-thumbs-up'></i>";
                    echo "</button>";

                    echo "<button type='submit' class='bad-btn' name='ocena' value='bad' title='Oceń podróż: negatywnie'>";
                    echo "<i class='fa-regular fa-thumbs-down'></i>";
                    echo "</button>";

                    echo "<button type='submit' class='not-sure-btn' name='ocena' value='not_sure' title='Ocen podróż: niezdecydowany'>";
                    echo "<i class='fa-regular fa-thumbs-up'></i>";
                    echo "<i class='fa-regular fa-thumbs-down'></i>";
                    echo "</button>";
                echo "</div>";
            
            }

        echo "</form>";

        echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<p>Nie znaleziono.</p>";
    }
    ?>
    </div>
 
</body>
</html>
