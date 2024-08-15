<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT * FROM korisnici WHERE korisnicko_ime='$korisnicko_ime'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($lozinka, $row['lozinka'])) {
            // Uspešna prijava, postavljanje sesije i preusmeravanje na index.php
            $_SESSION['korisnicko_ime'] = $korisnicko_ime;
            header("Location: index.php");
            exit();
        } else {
            echo "Pogrešna lozinka.";
        }
    } else {
        echo "Korisničko ime ne postoji.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prijava</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
        }
        .login-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-form h2 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form">
                    <h2 class="text-center">Prijava</h2>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="korisnicko_ime">Korisničko ime:</label>
                            <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" required>
                        </div>
                        <div class="form-group">
                            <label for="lozinka">Lozinka:</label>
                            <input type="password" class="form-control" id="lozinka" name="lozinka" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Prijavi se</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php" class="btn btn-link">Nemate nalog? Registrujte se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>