<?php
// Sjekk om vi kjører lokalt eller på Dokploy
if (php_sapi_name() == "cli-server" || $_SERVER['SERVER_NAME'] == "localhost") {
    // Lokal utvikling (XAMPP/MAMP)
   $host = "mysql123.dokploy.no";      // Dokploy host
$user = "app123_user";               // Dokploy databasebruker
$pass = "abc123";                    // Dokploy passord
$db   = "skole";                     // databasenavn på Dokploy
// Enkel databasekobling for både lokal utvikling og Dokploy.
// Lokalt kan du sette dine egne verdier i miljøvariablene DB_HOST, DB_USER, DB_PASS og DB_NAME,
// eller bruke standardverdiene under.

} else {
    // Dokploy – bytt ut med info fra Dokploy databasen din
    $host = "DOKPLOY_HOST";      // f.eks. usn-db.example.com
    $user = "DOKPLOY_USER";      // brukernavn Dokploy gir deg
    $pass = "DOKPLOY_PASSWORD";  // passord Dokploy gir deg
    $db   = "skole";             // databasen du opprettet på Dokploy
}
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'farah6535';
$pass = getenv('DB_PASS') ?: 'a999farah6535';
$db   = getenv('DB_NAME') ?: 'farah6535';

// Opprett MySQL-tilkobling
$conn = new mysqli($host, $user, $pass, $db);

// Sjekk tilkobling
if ($conn->connect_error) {
    die("Feil ved tilkobling: " . $conn->connect_error);
    die('Feil ved tilkobling: ' . $conn->connect_error);
}

// Sett tegnsett
$conn->set_charset("utf8mb4");
$conn->set_charset('utf8mb4');
?>
