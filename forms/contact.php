<?php

// Assurez-vous d'avoir une connexion à votre base de données MySQL.
$servername = "localhost"; // Remplacez par le nom du serveur MySQL
$username = "u274793444_webcvdefay"; // Remplacez par votre nom d'utilisateur MySQL
$password = "Razane2018*"; // Remplacez par votre mot de passe MySQL
$dbname = "u274793444_webcvdefay"; // Remplacez par le nom de votre base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extraction et échappement des données du formulaire
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);
    $subject = mysqli_real_escape_string($conn, $_POST["subject"]);

    // Envoi des données par e-mail
    $to = "j.defay@chamalhat.com";
    $subject = "Demande de contact";
    $message_email = "Nom: $name\nEmail: $email\nMessage: $message\nSubject: $subject";

    // Utilisation de la fonction mail() pour envoyer l'e-mail
    $headers = "From: $email";

    if (mail($to, $subject, $message_email, $headers)) {
        echo "Votre message a été pris en charge avec succès. Un e-mail a été envoyé à $to.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }

    // Traitement du formulaire dans la base de données
    $sql = "INSERT INTO contact (name, numero, email, message) VALUES ('$name', '$email', '$message', '$subject')";

    if ($conn->query($sql) === TRUE) {
        echo "Nous vous recontacterons dés que possible.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Fermez la connexion à la base de données à la fin du script
$conn->close();

?>
