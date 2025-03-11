    <?php
    require "settings/init.php";

    if (!empty($_POST['data'])) {
        $data = $_POST['data'];


        $sql = 'INSERT INTO `Bookings`(`BarberId`, `CustomerName`, `BookingDate`, `BookingTimeStart`, `BookingTimeEnd`)
      VALUES(:BarberId, :CustomerName, :BookingDate,  :BookingTimeStart, :BookingTimeEnd)';

        $bind = [':CustomerName' => $data['CustomerName'], ':BookingDate' => $data['BookingDate'],  ':BookingTimeStart' => $data['BookingTimeStart'], ':BookingTimeEnd' => $data['BookingTimeEnd'],':BarberId' => $data['BarberId']];

        $db->sql($sql, $bind, false);
    }

    ?>

<!DOCTYPE html>
<html lang="da">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FlexCut</title>
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
/* Import af Agdasima font */
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

		/* Øg fontstørrelsen på h1 */
		h1 {
    font-size: 4rem;  /* Størrelse på fonten */
			color: #ffffff; /* Farve på fonten */
			padding-top: 150px;
		}

		/* Eksempel på styling af ordet "FlexCut" i en klasse */
		.flexcut-text {
    font-family: 'StayChill', sans-serif;
			color: #ffffff;  /* Farve på fonten */
			margin-top: 5px;  /* Plads mellem de to linjer */
		}

		/* Justering af navbaren */
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
    min-height: 100vh;
}

/* Styling til navbar */
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
    color: white !important; /* Hvid tekst */
}

/* Styling for resten af indholdet */


/* Responsivitet for mindre skærme */
@media (max-width: 768px) {
    .navbar-nav {
        text-align: center; /* Centrer navbar links på små skærme */
    }
    .rounded-navbar {
        border-radius: 10px; /* Mindre runde hjørner på små skærme */
        padding: 5px 10px; /* Mindre padding for at gøre navbaren kortere */
        background-color: #4B4B4B !important; /* Sørger for at baggrundsfarven er #4B4B4B på små skærme */
    }
}

/* Styling for the circular icon */
.navbar-brand i {
    background-color: #d9d9d9; /* Grå baggrund for cirklen */
    color: black; /* Hvidt ikon */
    border-radius: 50%; /* Cirkelform */
    padding: 15px; /* Lidt luft omkring ikonet */
    font-size: 24px; /* Størrelsen på ikonet */
}

footer {
    background-color: #8BF39E; /* Mørk baggrundsfarve */
    margin-top: 50px; /* Luft over footeren */
}

footer .container {
    padding: 20px 0; /* Padding til indholdet */
}

footer a {
    color: #8BF39E; /* Grøn farve til links */
}

footer a:hover {
    color: #000000; /* Hvid farve ved hover */
}

footer {
    background-color: #333; /* Mørk baggrundsfarve */
    color: #8BF39E; /* Din ønskede grøn farve til teksten */
    margin-top: 50px; /* Luft over footeren */
    display: flex; /* Brug flexbox */
    justify-content: space-between; /* For at placere indhold på hver side */
    align-items: center; /* Juster elementerne vertikalt */
    padding: 20px 30px; /* Plads omkring indholdet */
}



footer {
    background-color: #8BF39E; /* Mørk baggrundsfarve */
    padding: 20px 0;
}

footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

footer .social-icons a {
    font-size: 24px;
    margin-left: 10px; /* Afstand mellem ikoner */
    color: #8BF39E; /* Grøn farve til ikoner */
}

footer .text-center {
    text-align: left; /* Teksten vil blive justeret til venstre */
    flex: 1;
}

footer .social-icons {
    display: flex;
    justify-content: flex-end; /* Placerer ikonerne til højre */
}

/* Styling for the circular icon */
.navbar-brand i {
    background-color: #d9d9d9; /* Grå baggrund for cirklen */
    color: black; /* Hvidt ikon */
    border-radius: 50%; /* Cirkelform */
    padding: 15px; /* Lidt luft omkring ikonet */
    font-size: 24px; /* Størrelsen på ikonet */
}

.contact-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(76, 175, 80, 0.1); /* Primær farve baggrund */
    border-radius: 50%;
    font-size: 1.5rem;
    color: #4CAF50;
}

.contact-card {
    transition: 0.3s;
}

.contact-card:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.hero-text p {
    max-width: 800px; /* Begrænser bredden, så teksten brydes på passende steder */
    white-space: normal; /* Tillader tekst at brydes på flere linjer */
    word-wrap: break-word; /* Sørger for, at lange ord brydes korrekt */
    line-height: 1.6; /* Justerer linjeafstand for bedre læsbarhed */
}

/* Justering af navbaren */
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

/* CSS for at sikre, at kortene er lige store */
.contact-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Placerer indholdet ensartet i kortet */
    min-height: 250px; /* Minimum højde for kortene */
}
/* Sikre at alle kort er ens i højden */
.row .col-md-6 {
    display: flex;
}
.row .col-md-6 .contact-card {
    flex-grow: 1;
}
	</style>
</head>
<body>
<!-- Hero sektion med baggrundsbillede -->
<div class="container-fluid bgbillede">
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark rounded-navbar fixed-top" style="background: rgba(75, 75, 75, 0.53); padding: 10px 20px; margin-top: 25px;">
		<div class="container"> <!-- Brug container i stedet for container-fluid -->
			<!-- Navbar brand med ikonet -->
			<a class="navbar-brand" href="#">
				<i class="fa-solid fa-scissors"></i> <!-- Saks ikon inde i en grå cirkel -->
			</a>

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

	<!-- Hero sektion tekst -->
	<div class="hero-text text-start text-white" style="padding-top: 180px; margin-left: 0px;"> <!-- Justeret padding-top for at reducere luft -->
		<h1 class="display-1 ms-4">Velkommen til</h1>
		<!-- Tilføjet tekst FlexCut under overskriften -->
		<div class="flexcut-text display-1 ms-4">FlexCut</div>
		<br>
		<!-- Grøn booking knap med farven #4CAF50, lige over <p> -->
<a href="#booking" class="btn ms-4" data-bs-toggle="modal" data-bs-target="#bookingModal"  style="background-color: #4CAF50; color: white; font-size: 1.2rem; padding: 10px 20px; text-decoration: none; display: inline-flex; align-items: center; margin-top: 20px;">
    Booking <i class="fa-solid fa-arrow-right ms-2 "></i> <!-- Pil til højre inde i knappen -->
		</a>
		<br><br>
		<p class="lead p-4">FlexCut er en moderne frisørservice,
			hvor du nemt kan booke en professionel frisør til hjemmebesøg
			og vælge mellem klipning, styling og barbering.</p>

    </div>
</div>





                    <!-- Modal -->
                    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bookingModalLabel">Book en tid!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php" method="post" onsubmit="return validateForm()">
                                        <div class="row">
                                            <!-- Customer Name -->
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="CustomerName" class="form-label">Navn</label>
                                                <input type="text" class="form-control" name="data[CustomerName]" id="CustomerName" placeholder="Navn" required>
                                            </div>

                                            <!-- Booking Date -->
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="BookingDate" class="form-label">Dato</label>
                                                <input type="date" class="form-control" name="data[BookingDate]" id="BookingDate" required>
                                            </div>

                                            <!-- Barber ID -->
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="BarberId" class="form-label">Barber ID</label>
                                                <input type="number" class="form-control" name="data[BarberId]" id="BarberId" placeholder="ID" required>
                                            </div>

                                            <!-- Start Time -->
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="BookingTimeStart" class="form-label">Starttidspunkt</label>
                                                <input type="time" class="form-control" name="data[BookingTimeStart]" id="BookingTimeStart" required>
                                            </div>

                                            <!-- End Time -->
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="BookingTimeEnd" class="form-label">Sluttidspunkt</label>
                                                <input type="time" class="form-control" name="data[BookingTimeEnd]" id="BookingTimeEnd" required>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 col-md-4 offset-md-8 mb-3">
                                                <button type="submit" class="btn btn-primary w-100">Book</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bootstrap JS and Popper (for Modal functionality) -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<div class="row g-4">
		<div class="col-md-4">
			<div class="p-4 bg-white rounded shadow-sm contact-card">
				<div class="d-flex align-items-start">
					<div class="contact-icon me-3">
						<i class="fa-regular fa-clock" style="color: #4CAF50;"></i> <!-- Farve ændret til grøn -->
					</div>
					<div>
						<h5 class="fw-semibold">Åbningstider</h5>
						<p class="text-muted mb-2">Mandag-fredag, 8:00 til 17:00</p>
						<a href="#" class="text-success text-decoration-none">Se mere her! →</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="p-4 bg-white rounded shadow-sm contact-card h-100">
				<div class="d-flex align-items-start">
					<div class="contact-icon me-3">
						<i class="fa-solid fa-location-dot" style="color: #4CAF50;"></i> <!-- Farve ændret til grøn -->
					</div>
					<div>
						<h5 class="fw-semibold">Vores adresse</h5>
						<p class="text-muted mb-2">FlexCut A/S, 1234 København</p>
						<a href="#" class="text-success text-decoration-none">Find os her →</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="p-4 bg-white rounded shadow-sm contact-card h-100">
				<div class="d-flex align-items-start">
					<div class="contact-icon me-3">
						<i class="fa-solid fa-phone" style="color: #4CAF50;"></i> <!-- Farve ændret til grøn -->
					</div>
					<div>
						<h5 class="fw-semibold">Kontakt os</h5>
						<p class="text-muted mb-2">+45 12 34 56 78 eller info@flexcut.dk</p>

						<a href="#" class="text-success text-decoration-none">Kontakt os nu →</a>
					</div>
				</div>
			</div>
		</div>
	</div>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function validateForm() {
        var customerName = document.getElementById('CustomerName').value;
        var bookingDate = document.getElementById('BookingDate').value;
        var barberId = document.getElementById('BarberId').value;
        var bookingTimeStart = document.getElementById('BookingTimeStart').value;
        var bookingTimeEnd = document.getElementById('BookingTimeEnd').value;
    
        if (!customerName || !bookingDate || !barberId || !bookingTimeStart || !bookingTimeEnd) {
            alert("Alle felter skal udfyldes korrekt.");
            return false; // Prevent form submission
        }
    
        if (isNaN(barberId)) {
            alert("Barber ID skal være et tal.");
            return false;
        }
    
        if (new Date(bookingDate) < new Date()) {
            alert("Bookingdatoen kan ikke være i fortiden.");
            return false;
        }
            alert("Booking accepteret! Tak for din reservation.");
            return true;
        return true;
    }


</script>
</body>
</html>
