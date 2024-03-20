<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<body>
<h1>REGISTER</h1>
    <?php
    include 'menu.php'
    ?>
    <form action="rejestracja.php" method="POST">
        <input type="text" name="login" id="login" placeholder="login">
        <input type="text" name="pass" id="pass" placeholder="password">
        <input type="submit" value="ADD USER">
    </form>
    <?php
    if(isset($_POST["login"]) && isset($_POST["pass"])){
        $log=$_POST["login"];
        $pas=$_POST["pass"];


        $zaszyfrowane=md5($pas);
        

        $conn=mysqli_connect("localhost","root","","podroze");

        if(!$conn){
            die (mysqli_connect_error() . "error");
        }

        

        $sql="INSERT INTO users(login,pass,upr) VALUES ('$log','$zaszyfrowane','user')";
        if(mysqli_query($conn,$sql)){
            // echo "user added";
            $sql="SELECT * FROM users WHERE login='$log' AND pass='$zaszyfrowane'";
            
            $result=mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)>0){
                $_SESSION['zalogowano']=true;
    
                $row = mysqli_fetch_assoc($result);
                
                $_SESSION['user'] = $row['login'];
                
                $_SESSION['upr'] = $row['upr'];
                
                header('Location: ./index.php');
            } else {
                $_SESSION['zalogowano']=false;
                $_SESSION['user'] = "";
                
                $_SESSION['upr'] = "";
                echo "error";
        }


        } else echo "error";
    }
    ?>
</body>
</html>