<?php
/**
 * @var db $db
 */
require "settings/init.php";

// Hent kategori ID fra URL (hvis angivet)
$cateId = isset($_GET['cateId']) ? (int)$_GET['cateId'] : 0;

// Hvis der er et kategori ID, så hent de film, der hører til denne kategori
if ($cateId > 0) {
    $sqlMovies = "SELECT movies.*, Categories.cateName 
                  FROM movies 
                  INNER JOIN Categories ON movies.moviCategoriesId = Categories.cateId 
                  WHERE Categories.cateId = $cateId";
    $movies = $db->sql($sqlMovies);
} else {
    // Hvis ingen kategori er valgt, vis alle film
    $sqlMovies = "SELECT movies.*, Categories.cateName FROM movies 
                  INNER JOIN Categories ON movies.moviCategoriesId = Categories.cateId";
    $movies = $db->sql($sqlMovies);
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Filmoversigt</title>
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aN0nLEd1Y50Xc7Y10J7PtYhdJtVtfdh6lH1zz9fFjc6n9VZVX+Y04xwVYe1WcJ9" crossorigin="anonymous">
    <style>
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

        .container {
            background-color: #f8f9fa; /* Lys baggrund for at gøre det mere moderne */
        }
    </style>
</head>

<body class="bg-body-tertiary">
<nav class="navbar navbar-expand-lg bg-danger-subtle">
    <div class="container-fluid">
        <a class="navbar-brand" href="products.php">Film</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                // Hent kategorier fra databasen
                $categories = $db->sql("SELECT * FROM Categories");
                foreach ($categories as $category): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php?cateId=<?php echo $category->cateId; ?>"><?php echo htmlspecialchars($category->cateName); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
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
        // Vis film baseret på valgt kategori
        foreach ($movies as $movie):
            switch($movie->moviId) {
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
                    $image = "img/placeholder-4.webp.jpg"; // Eventyr billede
                    break;
            }
            ?>
            <div class="col-md-4"> <!-- 3 film per række på større skærme -->
                <a href="movie.php?moviId=<?php echo $movie->moviId; ?>" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <img src="<?php echo $image; ?>" class="card-img-top" alt="Filmbillede">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($movie->moviTitle); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($movie->movieDescription); ?></p>
                        </div>
                        <div class="card-footer text-muted">
                            <strong>Kategori: </strong><?php echo htmlspecialchars($movie->cateName); ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
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

<!-- Bootstrap JS (inkl. Popper.js og jQuery) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4z9dIOp/3EwFJCjE+JTTB9vtrgJkF1jfoVrsTn" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqDAp9IvfEXK62fLl72+W5Vpz24eyhYQtS7Gb4I8kQPB8" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqDAp9IvfEXK62fLl72+W5Vpz24eyhYQtS7Gb4I8kQPB8" crossorigin="anonymous"></script>

</body>
</html>
