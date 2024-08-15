<?php
session_start();
include 'db.php';

// Provera da li je korisnik admin
if (!isset($_SESSION['korisnicko_ime']) || $_SESSION['korisnicko_ime'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dodaj_projekat'])) {
        $naziv = $_POST['naziv'];
        $opis = $_POST['opis'];
        $datum_pocetka = $_POST['datum_pocetka'];
        $datum_zavrsetka = $_POST['datum_zavrsetka'];

        $sql = "INSERT INTO projekti (naziv, opis, datum_pocetka, datum_zavrsetka) VALUES ('$naziv', '$opis', '$datum_pocetka', '$datum_zavrsetka')";
        $conn->query($sql);
    } elseif (isset($_POST['dodaj_zaposlenog'])) {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $pozicija = $_POST['pozicija'];
        $email = $_POST['email'];

        $sql = "INSERT INTO zaposleni (ime, prezime, pozicija, email) VALUES ('$ime', '$prezime', '$pozicija', '$email')";
        $conn->query($sql);
    } elseif (isset($_POST['dodaj_tehnologiju'])) {
        $naziv = $_POST['naziv'];
        $opis = $_POST['opis'];

        $sql = "INSERT INTO tehnologije (naziv, opis) VALUES ('$naziv', '$opis')";
        $conn->query($sql);
    }
}

// Učitavanje poruka iz baze
$poruke = $conn->query("SELECT * FROM poruke");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: #fff;
        }
        .admin-container {
            margin-top: 50px;
        }
        .admin-form {
            background: #495057;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .admin-form h2 {
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
    </style>
</head>
<body>
    <div class="container admin-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-form">
                    <h2 class="text-center">Dodaj Projekat</h2>
                    <form method="post" action="admin.php">
                        <div class="form-group">
                            <label for="naziv">Naziv:</label>
                            <input type="text" class="form-control" id="naziv" name="naziv" required>
                        </div>
                        <div class="form-group">
                            <label for="opis">Opis:</label>
                            <textarea class="form-control" id="opis" name="opis" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="datum_pocetka">Datum početka:</label>
                            <input type="date" class="form-control" id="datum_pocetka" name="datum_pocetka">
                        </div>
                        <div class="form-group">
                            <label for="datum_zavrsetka">Datum završetka:</label>
                            <input type="date" class="form-control" id="datum_zavrsetka" name="datum_zavrsetka">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="dodaj_projekat">Dodaj Projekat</button>
                    </form>
                </div>

                <div class="admin-form">
                    <h2 class="text-center">Dodaj Zaposlenog</h2>
                    <form method="post" action="admin.php">
                        <div class="form-group">
                            <label for="ime">Ime:</label>
                            <input type="text" class="form-control" id="ime" name="ime" required>
                        </div>
                        <div class="form-group">
                            <label for="prezime">Prezime:</label>
                            <input type="text" class="form-control" id="prezime" name="prezime" required>
                        </div>
                        <div class="form-group">
                            <label for="pozicija">Pozicija:</label>
                            <input type="text" class="form-control" id="pozicija" name="pozicija" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="dodaj_zaposlenog">Dodaj Zaposlenog</button>
                    </form>
                </div>

                <div class="admin-form">
                    <h2 class="text-center">Dodaj Tehnologiju</h2>
                    <form method="post" action="admin.php">
                        <div class="form-group">
                            <label for="naziv">Naziv:</label>
                            <input type="text" class="form-control" id="naziv" name="naziv" required>
                        </div>
                        <div class="form-group">
                            <label for="opis">Opis:</label>
                            <textarea class="form-control" id="opis" name="opis" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="dodaj_tehnologiju">Dodaj Tehnologiju</button>
                    </form>
                </div>

                <div class="admin-form">
                    <h2 class="text-center">Poruke</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Korisnik</th>
                                <th>Kartica ID</th>
                                <th>Poruka</th>
                                <th>Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($poruke as $poruka) { ?>
                                <tr>
                                    <td><?php echo $poruka['korisnik']; ?></td>
                                    <td><?php echo $poruka['kartica_id']; ?></td>
                                    <td><?php echo $poruka['poruka']; ?></td>
                                    <td><?php echo $poruka['datum']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>