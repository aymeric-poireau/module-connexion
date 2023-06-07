<!DOCTYPE html>
<html>
<head>
<title>Inscription</title>
<link rel="stylesheet" type="text/css" href="contact.css">
</head>
<body>

<?php
ini_set("log_errors", 1);
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();
$serveur = 'localhost';
$login = 'aymeric-poireau';
$pass = 'azertyqwerty345';

$connexion = new PDO("mysql:host=$serveur;dbname=aymeric-poireau_mysql", $login, $pass);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['enregistrer'])) {
    $login = $_POST['login'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($login) && !empty($nom) && !empty($prenom) && !empty($password)) {
        $requete = $connexion->prepare('INSERT INTO utilisateurs(login, nom, prenom, password) VALUES (:login, :nom, :prenom, :password)');

        $requete->bindValue(':login', $login);
        $requete->bindValue(':nom', $nom);
        $requete->bindValue(':prenom', $prenom);
        $requete->bindValue(':password', $hash);

        $result = $requete->execute();

        if (!$result) {
            echo '<script type="text/javascript">';
            echo 'alert("Erreur, les informations n\'ont pas été enregistrées")';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Vous êtes bien enregistré")';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Tous les champs sont requis!")';
        echo '</script>';
    }
}
?>


<div class="container">
  <div style="text-align:center">
    <h2>Inscription</h2>
    <h4><a href="connexion.php">Se connecter</a></h4>
    <p></p>
  </div>
  <div class="row">
    <div class="column">
      <img src="" style="width:100%">
    </div>
    <div class="column">
      <form action="" method="post">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="">
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" placeholder="">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" placeholder="">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="">
        <input type="submit" value="Submit" name="enregistrer">
      </form>
    </div>
</body>
</html>
