<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planer Wesela</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <style>
      
    </style>
</head>
<body>
    <!-- Sekcja hero -->
    <section class="hero-section">
        <div class="container">
            <!-- ZOSTAWIAMY align-items-center, by obrazek POZOSTAŁ WYŚRODKOWANY W PIONIE -->
            <div class="row align-items-center">
                
                <!-- Pierwsza kolumna: TYLKO TEKST WYWALAMY DO GÓRY -->
                <div class="col-md-6 align-self-start" style="margin: 20% 0;">
                    <div class="hero-text">
                        <h1>Twój niezawodny pomocnik w planowaniu idealnego wesela</h1>
                        <p>Zaplanuj własne wesele od A do Z!</p>
                        <a href="/register" class="btn btn-primary">Załóż konto</a>
                    </div>
                </div>

                <!-- Druga kolumna: OBRAZEK BEZ ZMIAN -->
                <div class="col-md-6 text-center">
                    <img 
                        src="images/wedding-dress-1486260_1280.png" 
                        class="img-fluid" 
                        alt="Suknia ślubna, ilustracja panny młodej" 
                    />
                </div>

            </div>
        </div>
    </section>

    <!-- Sekcja kafelków -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 cards-container">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514 1.522 2.514 4.07c0 1.562.802 3.511 3.05 5.377L8 13.252l2.436-3.805c2.248-1.866 3.05-3.815 3.05-5.377 0-2.548-3.086-3.79-4.769-2.058L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c4.544-4.183 15.157 3.725 0 13.857z"/>
                            </svg>
                        </div>
                        <h3>Organizer dla Młodej Pary</h3>
                        <p>Zarządzaj listą gości i ich statusami RSVP.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm11.854 3.646a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L8 11.293l3.646-3.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                        <h3>Łatwe planowanie</h3>
                        <p>Twórz listy zadań i planuj wesele z łatwością.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M13 14s1 0 1-1-1-4-6-4-6 4-6 4 1 0 1 1 4-1 6-1 6 1 6 1zM4.216 12A2.238 2.238 0 0 1 3 13H1s4-1.5 7-1.5S15 13 15 13h-2c-.396-.654-1.106-1-1.834-1H4.216zM5 8a3 3 0 1 0-6 0 3 3 0 0 0 6 0zM12.16 11.49A3.5 3.5 0 1 0 13 8.5a3.482 3.482 0 0 0-1.74-.01C10.621 8.01 10.106 8 9.61 8c-1.1 0-2 .9-2 2 0 .7.5 1.5 1 1.97.237-.06.48-.12.74-.19-.12-.362-.22-.74-.31-1.13z"/>
                            </svg>
                        </div>
                        <h3>Prosty dostęp</h3>
                        <p>Współpracuj z partnerem i zapraszaj znajomych do planowania.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
