<?php
/**
 * @var db $db
 */
require "settings/init.php";

// Hent barber ID fra URL (hvis angivet)
$barberId = isset($_GET['BarberId']) ? (int)$_GET['BarberId'] : 0;

// Hvis der er et barber ID, så hent de barbere, der hører til denne kategori
if ($barberId > 0) {
    $sqlBarbers = "SELECT * FROM movies WHERE BarberId = $barberId";
    $barbers = $db->sql($sqlBarbers);
} else {
    // Hvis ingen barber er valgt, vis alle barbere
    $sqlBarbers = "SELECT * FROM movies";
    $barbers = $db->sql($sqlBarbers);
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Barberoversigt</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aN0nLEd1Y50Xc7Y10J7PtYhdJtVtfdh6lH1zz9fFjc6n9VZVX+Y04xwVYe1WcJ9" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Agdasima&display=swap'); /* Korrigeret font */

        /* Tilføj fonten Stay Chill */
        @font-face {
            font-family: 'StayChill';  /* Navnet på fonten */
            src: url('fonts/StayChill-PVVD7.ttf') format('truetype');  /* Sti til fontfilen */
            font-weight: normal;
            font-style: normal;
        }

        /* Brug fonten Stay Chill på specifik tekst */
        h1, .chill-text {
            font-family: 'StayChill', sans-serif;
        }

        /* Brug Agdasima som læsefont */
        body {
            font-family: 'Agdasima', serif; /* Opdateret font til Agdasima */
            font-size: 1rem; /* Standard fontstørrelse */
            line-height: 1.6; /* God linjeafstand for læsbarhed */
            color: #333; /* Kontrastfarve for tekst */
        }
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            margin-bottom: 1.5rem;
        }

        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 500px; /* Passende højde for billeder */
        }

        .card-body {
            flex-grow: 1; /* Sørger for, at indholdet fylder kortet ud */
        }

        .card-footer {
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05); /* Skaber en hover-effekt */
            transition: transform 0.2s ease-in-out;
        }


        .navbar {
            padding-left: 10px;  /* Reducer padding venstre */
            padding-right: 10px;  /* Reducer padding højre */
        }
        .navbar-nav .nav-link {
            margin-right: 10px;  /* Skab lidt luft mellem linkene */
            font-size: 1.1rem;  /* Gør skrifttypen lidt mindre */
        }
        .navbar .btn {
            padding: 8px 15px;  /* Reducer padding for knappen */
        }
        .rounded-navbar {
            background: #4B4B4B; /* Ændret til #4B4B4B i stedet for gennemsigtig sort */
            border-radius: 20px; /* Runde hjørner */
            overflow: hidden;
            padding: 5px 15px; /* Reduceret padding for at gøre navbaren kortere */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000; /* Sørger for at navbaren ligger over baggrundsbilledet */
        }

        /* Styling for navbar links og brand */
        .navbar-dark .navbar-nav .nav-link,
        .navbar-brand {
            color: white !important; /* Hvid tekst */}
        .navbar-brand i {
            background-color: #d9d9d9; /* Grå baggrund for cirklen */
            color: black; /* Sort ikon */
            border-radius: 50%; /* Cirkelform */
            padding: 15px; /* Lidt luft omkring ikonet */
            font-size: 24px; /* Størrelsen på ikonet */
        }

        .navbar {
            padding-left: 10px;  /* Reducer padding venstre */
            padding-right: 10px;  /* Reducer padding højre */
        }

        /* Justering af navbar-link */
        .navbar-nav .nav-link {
            margin-right: 10px;  /* Skab lidt luft mellem linkene */
            font-size: 1.1rem;  /* Gør skrifttypen lidt mindre */
        }

        /* Ændre knap størrelse og padding */
        .navbar .btn {
            padding: 8px 15px;  /* Reducer padding for knappen */
        }
        .bgbillede {
            background: url('../img/chris-knight--ucnC7PMDqE-unsplash.jpg') no-repeat center center fixed;
            background-size: cover; /* Sørger for at billedet dækker hele baggrunden */

        }

    </style>
</head>
<div class="container-fluid bgbillede">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark rounded-navbar fixed-top" style="background: rgba(75, 75, 75, 0.53); padding: 10px 20px; margin-top: 25px;">
        <div class="container"> <!-- Brug container i stedet for container-fluid -->
            <!-- Navbar brand med ikonet -->


            <!-- Mobile menu toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="index.php">Hjem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="Frisører.php">Frisører</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#">Om os</a>
                    </li>
                </ul>
            </div>

            <!-- Sort "Kontakt os" knap til højre -->
            <a href="#kontakt" class="btn text-white bg-black ms-auto fw-semibold">Kontakt Os</a>
        </div>
    </nav>

</div>

<body class="bgbillede">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Søg" aria-label="Search">
                <button class="btn btn-outline-danger" type="submit">Søg</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row g-4">
        <?php
        // Vis barbere baseret på valgt kategori
        foreach ($barbers as $barber):
            // Tildel billede baseret på BarberId
            switch ($barber->BarberId) {
                case 1:
                    $image = "img/hannah-skelly-g5A9gO59ERU-unsplash.jpg"; // Rolf's billede
                    break;
                case 2:
                    $image = "img/element5-digital-QJtyomGCYGw-unsplash.jpg"; // Hannah's billede
                    break;
                case 3:
                    $image = "img/haircut-hairstyle-hispanic-professional-beauty-sal-2025-01-09-06-04-50-utc.jpg"; // Anders' billede
                    break;
                default:
                    $image = "img/placeholder-4.webp"; // Standard billede hvis ingen match
            }
            ?>
            <div class="col-md-4 col-sm-6">
                <a href="barber.php?barberId=<?php echo $barber->BarberId; ?>" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <img src="<?php echo $image; ?>" class="card-img-top" alt="Barber image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($barber->BarberName); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($barber->BarberDescription); ?></p>
                        </div>
                        <div class="card-footer text-muted">
                            <strong>Type: </strong><?php echo htmlspecialchars($barber->BarberType); ?>
                        </div>

                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
    <footer class="text-black text-center py-4 mt-5">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="text-center">
                <p class="mb-0">FlexCut. Alle rettigheder forbeholdes.</p>
                <p class="mb-0">
                    <a href="#" class="text-black text-decoration-none mx-2">Privatlivspolitik</a> |
                    <a href="#" class="text-black text-decoration-none mx-2">Vilkår og Betingelser</a>
                </p>
            </div>
            <div class="social-icons">
                <a href="https://www.instagram.com/" target="_blank" class="text-black text-decoration-none mx-2">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com" target="_blank" class="text-black text-decoration-none mx-2">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>
    </footer>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4z9dIOp/3EwFJCjE+JTTB9vtrgJkF1jfoVrsTn" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqDAp9IvfEXK62fLl72+W5Vpz24eyhYQtS7Gb4I8kQPB8" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqDAp9IvfEXK62fLl72+W5Vpz24eyhYQtS7Gb4I8kQPB8" crossorigin="anonymous"></script>

</body>
</html>
