<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe']; 
   

   
}
$stmt = $conn->prepare("SELECT * FROM dentistes WHERE email = ? AND mot_de_passe = MD5(?)");
$stmt->bind_param("ss", $email, $mot_de_passe);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['admin'] = $email;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Email ou mot de passe incorrect.";
}
$stmt->close();

$conn->close();
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Dentiste</title>
    <style>
        body {
      color: beige;
    font-family: Arial, sans-serif;
    background-image: url(home.jpg);
    padding: 20px;
    }
    
    .container {
        max-width: 400px;
    margin: auto;
    background: #1d1d1d;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px black;
    }
    
    h2 {
        color:#007bff ;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    
    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
    
    button {
        width: 100%;
        padding: 10px;
        background-color: #14476B;
        color: white;
        border: none;
        cursor: pointer;
    }
    
    button:hover {
        background-color: #14476B;
    }
    .but{
        color: #007bff;
    }
    </style>
</head>
<body>    <div class="container"></body>
    <h2>Connexion Dentiste</h2>
    <form method="POST" action="connexion_dentiste.php">

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required placeholder="entrer votre email">
               
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="mot_de_passe" id="password" required placeholder="..........">
            </div>
            <button type="submit">Se connecter</button>
        </form>
   </div>
    </form>
</body>
</html>
