<?php
session_start();

if($_SESSION['upr'] !== 'admin') {
    header('Location: ./index.php');
    exit; // Add exit to prevent further execution
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "podroze");

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to handle form submission for editing user
if(isset($_POST['edit_user'])) {
    $login = $_POST['login'];
    $newLogin = $_POST['newLogin'];
    $upr = $_POST['upr'];
    
    $sql = "UPDATE users SET upr='$upr', login='$newLogin' WHERE login='$login'";
    if(mysqli_query($conn, $sql)) {
        // echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Function to handle deletion of user
if(isset($_POST['delete_user'])) {
    $login = $_POST['login'];
    
    $sql = "DELETE FROM users WHERE login='$login'";
    if(mysqli_query($conn, $sql)) {
        // echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Retrieve users from database
$result = mysqli_query($conn, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleEdit(login) {
            var editUpr = document.getElementById('edit_input_upr_' + login);
            var editLogin = document.getElementById('edit_input_login_' + login);
            var saveButton = document.getElementById('save_button_' + login);
            var cancelButton = document.getElementById('cancel_button_' + login);
            var editBtn = document.getElementById('editBtn_' + login); 

            editUpr.style.display = (editUpr.style.display == 'none') ? 'inline' : 'none';
            editLogin.style.display = (editLogin.style.display == 'none') ? 'inline' : 'none';
            
            saveButton.style.display = (saveButton.style.display == 'none') ? 'inline' : 'none';
            cancelButton.style.display = (cancelButton.style.display == 'none') ? 'inline' : 'none';
            editBtn.style.display = (cancelButton.style.display == 'none') ? 'inline' : 'none';
        }
    </script>
</head>
<body>
    <h1>Panel administratora</h1>
    <?php include 'menu.php' ?>
        <div class="users">
    <?php 
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='user'>";
                    echo "<p>".$row['login'].",".$row['upr']."</p>";
                    // Edit form
                    echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='login' value='".$row['login']."'>";

                        echo "<div class='user-btns'>";

                            echo "<input type='button' id='editBtn_".$row['login']."'  onclick='toggleEdit(\"".$row['login']."\")' value='Edit'>";


                            echo "<input type='hidden' name='login' value='".$row['login']."'>";
                            echo "<input type='submit' name='delete_user' value='Delete'>";


                            echo "<input type='submit' name='edit_user' id='save_button_".$row['login']."' value='Save' style='display:none;'>";

                            echo "<input type='button' onclick='toggleEdit(\"".$row['login']."\")' id='cancel_button_".$row['login']."' value='Cancel' style='display:none;'>";

                        echo "</div>";


                        echo "<input type='text' id='edit_input_login_".$row['login']."' name='newLogin' value='".$row['login']."' style='display:none;'>";

                        echo "<br/>";

                        echo "<select id='edit_input_upr_".$row['login']."' name='upr' style='display:none;'>";
                            echo "<option value='user' " . ($row['upr'] == 'user' ? 'selected' : '') . ">Użytkownik</option>";
                            echo "<option value='admin' " . ($row['upr'] == 'admin' ? 'selected' : '') . ">Administrator</option>";
                            echo "<option value='pracownik' " . ($row['upr'] == 'pracownik' ? 'selected' : '') . ">Pracownik</option>";
                        echo "</select>";
                        

                        echo "<br/>";

                   

                    echo "</form>";
                    
                echo "</div>";
            }
        }
    ?>
    </div>

</body>
</html>

<?php mysqli_close($conn); ?>
