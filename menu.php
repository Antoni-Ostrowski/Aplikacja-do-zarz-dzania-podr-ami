<?php
$currentPage = basename($_SERVER['PHP_SELF']); // Get the current page filename

// Function to check if the link is active
function isActive($page, $currentPage) {
    if ($page === $currentPage) {
        return 'active'; // Return 'active' if the page is current
    } else {
        return ''; // Return empty string if the page is not current
    }
}
?>

<link rel="stylesheet" href="styless.css">

<div class="menu">
    <ul class="menu-list">
        <li class="list-child <?php echo isActive('index.php', $currentPage); ?>"> <a href='/podroze'>Podroże</a> </li>

        <?php
        if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='admin'){
            echo "<li class='list-child " . isActive('admin.php', $currentPage) . "'> <a href='./admin.php'>Panel administratora</a> </li>";
        }

        if(isset($_SESSION['upr']) &&  ($_SESSION['upr']=='pracownik' || $_SESSION['upr']=='admin')){
            echo "<li class='list-child " . isActive('dodawanie.php', $currentPage) . "'> <a href='./dodawanie.php'>Dodaj podróż</a> </li>";
        }


        if(isset($_SESSION['upr']) &&  $_SESSION['upr']=='user' ){
            echo "<li class='list-child " . isActive('mojeRecenzje.php', $currentPage) . "'> <a href='./mojeRecenzje.php'>Moje recenzje</a> </li>";
            echo "<li class='list-child " . isActive('ulubione.php', $currentPage) . "'> <a href='./ulubione.php'>Ulubione podróże</a> </li>";
            echo "<li class='list-child " . isActive('zaplanowane.php', $currentPage) . "'> <a href='./zaplanowane.php'>Zaplanowane podróże</a> </li>";
        }
        ?>

        <?php
        if(isset($_SESSION['zalogowano']) && !$_SESSION['zalogowano']){
            echo "<li class='list-child " . isActive('login.php', $currentPage) . "' style='background-color: rgb(121, 161, 121);'> <a href='./login.php'>Zaloguj się</a> </li>";
            echo "<li class='list-child " . isActive('rejestracja.php', $currentPage) . "' style='background-color: rgb(121, 161, 121);'> <a href='./rejestracja.php'>Zarejestruj się</a> </li>";

        } else {
            echo "<li class='list-child " . isActive('logout.php', $currentPage) . "' style='background-color: tomato;'> <a href='./logout.php'>Wyloguj się</a> </li>";
        }
        ?>
    </ul>
</div>
