<?php
include 'db.php';
session_start();

// Učitavanje podataka iz tabela
$projekti = $conn->query("SELECT * FROM projekti");
$zaposleni = $conn->query("SELECT * FROM zaposleni");
$tehnologije = $conn->query("SELECT * FROM tehnologije");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>IT Kompanija</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            transition: background-color 0.5s ease;
        }
        .container {
            margin-top: 50px;
            animation: fadeIn 1s;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-header {
            background: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            font-size: 1.25rem;
            transition: background-color 0.3s;
        }
        .card-header:hover {
            background: #0056b3;
        }
        .navbar {
            background-color: #007bff;
            transition: background-color 0.3s;
        }
        .navbar:hover {
            background-color: #0056b3;
        }
        .footer {
            background-color: #f8f9fa;
            color: #000; /* Promenjen tekst u crnu boju */
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            animation: slideIn 0.5s;
        }
        .footer p {
            color: #000;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .btn-login {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .section-title {
            margin: 50px 0 30px;
            font-size: 2rem;
            text-align: center;
            color: #007bff;
            animation: bounce 1s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">IT Kompanija</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#projekti">Projekti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#zaposleni">Zaposleni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tehnologije">Tehnologije</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['korisnicko_ime'])): ?>
                        <a class="nav-link" href="logout.php">Odjavi se</a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">Prijavi se</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="section-title" id="projekti">Projekti</h1>
        <div class="row">
            <?php while ($projekti_row = $projekti->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $projekti_row['naziv']; ?>
                        </div>
                        <div class="card-body">
                            <p><?php echo $projekti_row['opis']; ?></p>
                            <p><strong>Datum početka:</strong> <?php echo $projekti_row['datum_pocetka']; ?></p>
                            <p><strong>Datum završetka:</strong> <?php echo $projekti_row['datum_zavrsetka']; ?></p>
                            <button class="btn btn-primary btn-contact" data-toggle="modal" data-target="#contactModal" data-id="<?php echo $projekti_row['id']; ?>" data-title="<?php echo $projekti_row['naziv']; ?>">Kontakt</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <h1 class="section-title" id="zaposleni">Zaposleni</h1>
        <div class="row">
            <?php while ($zaposleni_row = $zaposleni->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $zaposleni_row['ime'] . ' ' . $zaposleni_row['prezime']; ?>
                        </div>
                        <div class="card-body">
                            <p><strong>Pozicija:</strong> <?php echo $zaposleni_row['pozicija']; ?></p>
                            <p><strong>Email:</strong> <?php echo $zaposleni_row['email']; ?></p>
                            <button class="btn btn-primary btn-contact" data-toggle="modal" data-target="#contactModal" data-id="<?php echo $zaposleni_row['id']; ?>" data-title="<?php echo $zaposleni_row['ime'] . ' ' . $zaposleni_row['prezime']; ?>">Kontakt</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <h1 class="section-title" id="tehnologije">Tehnologije</h1>
        <div class="row">
            <?php while ($tehnologije_row = $tehnologije->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $tehnologije_row['naziv']; ?>
                        </div>
                        <div class="card-body">
                            <p><?php echo $tehnologije_row['opis']; ?></p>
                            <button class="btn btn-primary btn-contact" data-toggle="modal" data-target="#contactModal" data-id="<?php echo $tehnologije_row['id']; ?>" data-title="<?php echo $tehnologije_row['naziv']; ?>">Kontakt</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="submit_message.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactModalLabel">Kontaktirajte nas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="kartica_id" id="kartica_id">
                        <div class="form-group">
                            <label for="poruka">Poruka</label>
                            <textarea class="form-control" id="poruka" name="poruka" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                        <button type="submit" class="btn btn-primary">Pošalji</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2023 IT Kompanija. Sva prava zadržana.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#contactModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var karticaId = button.data('id');
            var modal = $(this);
            modal.find('#kartica_id').val(karticaId);
        });
    </script>
</body>
</html>