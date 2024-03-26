<?php
    if ($_SESSION['user'] !== "") {
        echo "logged user: ";
        echo $_SESSION['user'];
        echo $_SESSION['upr'];
    }
      

?>
<ul>
<li> <a href='/podroze'>Podroże</a> </li>
<li> <a href='./ulubione.php'>Ulubione</a> </li>

<?php
if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='admin'){
    echo "<li> <a href='./admin.php'>Panel administratora</a> </li>";
}
?>




<?php
if(isset($_SESSION['zalogowano']) && !$_SESSION['zalogowano']){
    echo "<li> <a href='./login.php'>Zaloguj się</a> </li>";
    echo "<li> <a href='./rejestracja.php'>Zarejestruj się</a> </li>";

} else {
    echo "<li> <a href='./logout.php'>Wyloguj się</a> </li>";
}
?>


</ul>
