<?php
require "settings/init.php"; // Databaseforbindelse

// Hent moviId fra URL
$moviId = isset($_GET['moviId']) ? (int)$_GET['moviId'] : 0;

// Hvis moviId ikke er sat korrekt, kan du returnere en fejl.
if ($moviId == 0) {
    echo "Ugyldigt film ID.";
    exit;
}

// Hent filmoplysningerne fra databasen
$sql = "SELECT movies.*, Categories.cateName FROM movies INNER JOIN Categories ON movies.moviCategoriesId = Categories.cateId WHERE movies.moviId = $moviId";
$movies = $db->sql($sql);

// Hvis filmen ikke findes, returner en fejl
if (empty($movies)) {
    echo "Filmen blev ikke fundet.";
    exit;
}

$movie = $movies[0]; // Vi henter den første film i resultatet

// Dynamisk valg af billede baseret på moviId
switch ($moviId) {
    case 1:
        $image = "img/81yAfVk+7UL._AC_UF894,1000_QL80_.jpg"; // Gysere billede
        break;
    case 2:
        $image = "img/81wSQQHyNrL.jpg"; // Komedie billede
        break;
    case 3:
        $image = "img/se7en.jpg"; // Krimi billede
        break;
    case 4:
        $image = "img/MV5BZDRkODJhOTgtOTc1OC00NTgzLTk4NjItNDgxZDY4YjlmNDY2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"; // Action billede
        break;
    case 5:
        $image = "img/81EBp0vOZZL._AC_UF894,1000_QL80_.jpg"; // Eventyr billede
        break;
    case 6:
        $image = "img/ads.jpg"; // Eventyr billede
        break;
    default:
        $image = "img/default.jpg"; // Standard billede, hvis ingen match findes
        break;
}

// Kontrollér om billedet eksisterer
if (!file_exists($image)) {
    $image = "img/default.jpg"; // Hvis billedet ikke findes, brug et standard billede
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Filmdetaljer - <?php echo htmlspecialchars($movie->moviTitle); ?></title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aN0nLEd1Y50Xc7Y10J7PtYhdJtVtfdh6lH1zz9fFjc6n9VZVX+Y04xwVYe1WcJ9" crossorigin="anonymous">
</head>
<style>
    /* Grundlæggende styling for at skabe en post-lignende layout */
    body {
        background-color: #f4f4f9;
        font-family: 'Arial', sans-serif;
    }

    .container1 {
        max-width: 900px;
        margin: 50px auto;
        padding: 40px;
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    /* Billede styling for at gøre det flot og responsivt */
    .card-img-top {
        object-fit: cover;
        width: 100%;
        height: 100%; /* Større billede for en mere visuel effekt */
        border-radius: 12px;
        margin-bottom: 20px;
    }

    /* Titler og tekst */
    h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 1rem;
    }

    h5 {
        font-size: 1.2rem;
        color: #555;
        line-height: 1.6;
    }

    /* Post detaljer */
    .post-details {
        margin-top: 30px;
        font-size: 1.1rem;
        color: #777;
    }

    strong {
        font-weight: bold;
    }

    /* Footer Styling */
    footer {
        background-color: #f1f1f1;
        padding: 1.5rem;
        text-align: center;
        border-top: 1px solid #e0e0e0;
    }

    footer p, footer a {
        color: #555;
        font-size: 0.9rem;
    }
</style>

<body>
<nav class="navbar navbar-expand-lg bg-danger-subtle">
    <div class="container-fluid">
        <a class="navbar-brand" href="products.php">Film</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="products.php?cateId=3">Krimi</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php?cateId=4">Action</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php?cateId=5">Eventyr</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php?cateId=2">Komedie</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php?cateId=1">Gyser</a></li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Søg" aria-label="Search">
                <button class="btn btn-outline-danger" type="submit">Søg</button>
            </form>
        </div>
    </div>
</nav>

<div class="container1">
    <div class="post">
        <div class="card-body">
            <h1><?php echo htmlspecialchars($movie->moviTitle); ?></h1>
            <p class="h5"><?php echo nl2br(htmlspecialchars($movie->movieDescription)); ?></p>
        </div>

        <div class="post-details">
            <p><strong>Kategori: </strong><?php echo htmlspecialchars($movie->cateName); ?></p>
            <p><strong>Udgivelsesdato: </strong><?php echo htmlspecialchars($movie->releaseDate); ?></p>
            <p><strong>Sprog: </strong><?php echo htmlspecialchars($movie->movieLanguage); ?></p>
            <p><strong>IMDB Rating: </strong><?php echo htmlspecialchars($movie->movieRating); ?></p>
            <p><strong>Instruktør: </strong><?php echo htmlspecialchars($movie->movieDirector); ?></p>
            <img src="<?php echo htmlspecialchars($image); ?>" class="card-img-top" alt="Filmbillede">

        </div>
    </div>
</div>
<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 Company, Inc</p>
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Hjem</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Muligheder</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pris</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Om os</a></li>
        </ul>
    </footer>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4z9dIOp/3EwFJCjE+JTTB9vtrgJkF1jfoVrsTn" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqDAp9IvfEXK62fLl72+W5Vpz24eyhYQtS7Gb4I8kQPB8" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqDAp9IvfEXK62fLl72+W5
