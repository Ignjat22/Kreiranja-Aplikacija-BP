<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['korisnicko_ime'])) {
        $korisnik = $conn->real_escape_string($_SESSION['korisnicko_ime']);
        $kartica_id = $conn->real_escape_string($_POST['kartica_id']);
        $poruka = $conn->real_escape_string($_POST['poruka']);

        $sql = "INSERT INTO poruke (korisnik, kartica_id, poruka) VALUES ('$korisnik', '$kartica_id', '$poruka')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Poruka je uspešno poslata!";
        } else {
            $_SESSION['message'] = "Greška: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "Morate biti prijavljeni da biste poslali poruku.";
    }

    $conn->close();
    header("Location: index.php");
    exit();
}
?>