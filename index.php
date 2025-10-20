<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";
$msg = "";

// Legg inn eksempeldatabaser hvis de ikke finnes
$conn->query("INSERT INTO klasse (klassekode, klassenavn, studiumkode)
    VALUES ('IT1', 'IT og ledelse 1. år', 'ITLED'),
           ('IT2', 'IT og ledelse 2. år', 'ITLED'),
           ('IT3', 'IT og ledelse 3. år', 'ITLED')
    ON DUPLICATE KEY UPDATE klassenavn=klassenavn");

// Lagre ny klasse
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lagre'])) {
    $kode = $conn->real_escape_string(trim($_POST['kode']));
    $navn = $conn->real_escape_string(trim($_POST['navn']));
    $studium = $conn->real_escape_string(trim($_POST['studium']));

    if ($kode && $navn && $studium) {
        if ($conn->query("INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES ('$kode','$navn','$studium')")) {
            $msg = "Klasse lagret.";
        } else {
            $msg = "Feil: " . $conn->error;
        }
    } else {
        $msg = "Fyll inn alle feltene.";
    }
}

// Slett klasse
if (isset($_GET['slett'])) {
    $kode = $conn->real_escape_string($_GET['slett']);
    if ($conn->query("DELETE FROM klasse WHERE klassekode='$kode'")) $msg = "Klasse slettet.";
    else $msg = "Feil: " . $conn->error;
}

$klasser = $conn->query("SELECT * FROM klasse ORDER BY klassekode");
