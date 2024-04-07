<?php
    if ($_SESSION['user'] !== "") {
        echo "logged user: ";
        echo $_SESSION['user'];
        echo $_SESSION['upr'];
    }
      

?>
<link rel="stylesheet" href="styles.css">
<ul>
<li> <a href='/podroze'>Podroże</a> </li>

<?php
if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='admin'){
    echo "<li> <a href='./admin.php'>Panel administratora</a> </li>";
}

if(isset($_SESSION['upr']) &&  ($_SESSION['upr']=='pracownik' || $_SESSION['upr']=='admin')){
    echo "<li> <a href='./dodawanie.php'>Dodaj podróż</a> </li>";
}


if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='user' ){
    echo "<li> <a href='./mojeRecenzje.php'>Moje recenzje</a> </li>";
}

if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='user' ){
    echo "<li> <a href='./ulubione.php'>Ulubione podróże</a> </li>";
}

if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='user' ){
    echo "<li> <a href='./zaplanowane.php'>Zaplanowane podróże</a> </li>";
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
