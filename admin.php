<?php
session_start();

if ($_SESSION['upr'] !== 'admin' && basename($_SERVER['PHP_SELF']) !== 'index.php') {
    header('Location: ./index.php');
    exit; // Add exit to prevent further execution
}
// Database connection
$conn = mysqli_connect("localhost", "root", "", "podroze");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve users from database
$result = mysqli_query($conn, "SELECT * FROM users");
// Initialize editing state
$editing = false;

// Set editing state based on form submissions
if (isset($_POST['edit'])) {
    $editing = true;
}

if (isset($_POST['cancel'])) {
    $editing = false;
}

if (isset($_POST['edit_user'])) {
    $editing = false;

    $login = $_POST['login'];
    $newLogin = $_POST['newLogin'];
  
    $newUpr = $_POST['upr'];


    $sql = "UPDATE users SET login = '$newLogin', upr = '$newUpr' WHERE login = '$login'";

    $resultt = mysqli_query($conn, $sql);


}


if (isset($_POST['delete_user'])) {

$login = $_POST['login'];

    $sql = "DELETE FROM users where login = '$login'";

    $resulttt = mysqli_query($conn, $sql);





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
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <?php include 'menu.php' ?>
    <div class="users">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='user'>";
               

                if ($editing) {
                    // Edit mode
                    echo "<form method='post' action='' class='form-container'>";
                        echo "<input type='hidden' name='login' value='" . $row['login'] . "'>";
                        echo "<input type='text' name='newLogin' value='" . $row['login'] . "'>";
                        echo "<select name='upr'>";
                            echo "<option value='user' " . ($row['upr'] == 'user' ? 'selected' : '') . ">Użytkownik</option>";
                            echo "<option value='admin' " . ($row['upr'] == 'admin' ? 'selected' : '') . ">Administrator</option>";
                            echo "<option value='pracownik' " . ($row['upr'] == 'pracownik' ? 'selected' : '') . ">Pracownik</option>";
                        echo "</select>";
                        echo "<input type='submit' name='edit_user' value='Save'>";
                        echo "<input type='submit' name='cancel' value='Cancel'>";
                    echo "</form>";
                } else {
                    // View mode
                    echo "<div class='info-container'>";
                        echo "<form method='post' action=''>";
                            echo "<input type='hidden' name='login' value='" . $row['login'] . "'>";
                            echo "<p><strong>Login:</strong> " . $row['login'] ."</p>";
                            echo "<p><strong>Uprawnienia:</strong> " . $row['upr'] ."</p>";
                                echo "<div class='user-btns'>";
                                echo "<input type='submit' name='edit' value='Edit'>";
                                echo "<input type='submit' name='delete_user' value='Delete'>";
                                echo "</div>";
                        echo "</form>";
                    echo "</div>";
                }
                

                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
