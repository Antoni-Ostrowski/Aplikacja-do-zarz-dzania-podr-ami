<?php
    if (isset($_POST['user'])) {
        echo "logged user: ";
        echo $_SESSION['user'];
    }



?>
<ul>
<li> <a href='/podroze'>MAIN PAGE</a> </li>
<li> <a href='./strona.php'>PAGE</a> </li>

<?php
if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='admin'){
    echo "<li> <a href='./admin.php'>ADMIN</a> </li>";
}
?>




<?php
if(isset($_SESSION['zalogowano']) && !$_SESSION['zalogowano']){
    echo "<li> <a href='./login.php'>LOGIN</a> </li>";
    echo "<li> <a href='./rejestracja.php'>REGISTER</a> </li>";

} else {
    echo "<li> <a href='./logout.php'>LOG OUT</a> </li>";
}
?>


</ul>
