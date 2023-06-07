<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>
<body>

<?php
session_start();
$serveur = 'localhost';
$login = 'aymeric-poireau';
$pass = 'azertyqwerty345';

$objetpdo = new PDO("mysql:host=$serveur;dbname=aymeric-poireau_mysql", $login, $pass);

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $pdostat = $objetpdo->prepare('SELECT * FROM utilisateurs WHERE login = :login');
    $pdostat->bindParam(':login', $login);
    $pdostat->execute();
    $donnee = $pdostat->fetch();



    if ($donnee && password_verify($password, $donnee['password'])) {
        echo '<script type="text/javascript">';
        echo 'alert("Connexion réussie!")';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Erreur, les informations sont incorrectes")';
        echo '</script>';
    }
} ?>

<div class="column">
    <form action="" method="post">
        <label for="login">login</label>
        <input type="text" id="login" name="login" placeholder="">
        <label for="password">password</label>
        <input type="password" id="password" name="password" placeholder="">
        <input type="submit" value="Soumettre" name="submit">
    </form>
</div>
</body>
</html>
