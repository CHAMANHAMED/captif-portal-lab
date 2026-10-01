<?php
$uri = $_SERVER['REQUEST_URI'];

// === WINDOWS : RÉPONSE 200 OK AVEC REDIRECTION HTML (pour forcer l'ouverture) ===
if (strpos($uri, 'connecttest.txt') !== false) {
    header("HTTP/1.1 200 OK");
    echo '<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="0; url=http://10.0.0.1/index.html">
        <script>window.location.href="http://10.0.0.1/index.html";</script>
    </head>
    <body></body>
    </html>';
    exit;
}

// === ANDROID : RÉPONSE 200 OK AVEC REDIRECTION HTML ===
if (strpos($uri, 'generate_204') !== false) {
    header("HTTP/1.1 200 OK");
    echo '<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="0; url=http://10.0.0.1/index.html">
        <script>window.location.href="http://10.0.0.1/index.html";</script>
    </head>
    <body></body>
    </html>';
    exit;
}

// === APPLE : Servir directement la page ===
if (strpos($uri, 'hotspot-detect.html') !== false) {
    header("HTTP/1.1 200 OK");
    readfile('/var/www/html/index.html');
    exit;
}

// === TOUT LE RESTE : Servir directement la page ==
header("HTTP/1.1 302 Found");
header("Location: http://10.0.0.1/index.html");
exit;
?>
