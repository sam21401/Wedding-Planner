<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar_menu {
            margin: 0;
            font-family: Arial, sans-serif;
            position: fixed;
            top: 0;
            left: -200px; /* Ukryj menu */
            width: 200px;
            background-color: #292323; /* Ciemny kolor tła menu */
            transition: left 0.3s;
            z-index: 1000;
            color: #fff; /* Biały tekst */
            height: 100%; /* Rozciągnij menu na całą wysokość strony */
        }

        .menu_toggle_icon {
            position: absolute;
            top: 20px;
            left: 100%; /* Ustawienie po prawej stronie sidebar_menu */
            cursor: pointer;
            padding: 10px;
            background-color: #292323; /* Kolor ikony */
            color: #fff;
            border-radius: 0 5px 5px 0;
        }

        .sidebar_menu_content a {
            color: white; /* Biały kolor linków */
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            background-color: #292323; /* Ciemny kolor tła linków */
            transition: background-color 0.3s ease;
        }

        .sidebar_menu_content a:hover {
            background-color: #00aaaa; /* Jaśniejszy odcień turkusu przy najechaniu */
        }

        .sidebar_menu.open {
            left: 0; /* Pokazuje menu */
        }

        body {
            transition: font-size 0.3s ease, filter 0.3s ease; /* Płynna zmiana rozmiaru czcionki i filtrów */
            font-size: 16px; /* Początkowy rozmiar czcionki */
        }
    </style>
</head>
<body>

<div class="sidebar_menu" id="sidebarMenu">
    <div class="menu_toggle_icon"><i class="fas fa-wheelchair"></i></div>
    <div class="sidebar_menu_content">
        <a href="#" id="increase-size">Zwiększ rozmiar</a>
        <a href="#" id="decrease-size">Zmniejsz rozmiar</a>
        <a href="#" id="grayscale">Odcienie szarości</a>
        <a href="#" id="high-contrast">Wysoki kontrast</a>
        <a href="#" id="invert-colors">Odwrócone kolory</a>
        <a href="#" id="light-shades">Jasne odcienie</a>
        <a href="#" id="reset">Reset</a>
    </div>
</div>



<script>
    document.querySelector('.menu_toggle_icon').addEventListener('click', function() {
        var sidebar_menu = document.querySelector('.sidebar_menu');
        sidebar_menu.classList.toggle('open');
    });

    let currentFontSize = 16; // Bazowy rozmiar czcionki
    const maxFontSize = 22; // Maksymalny rozmiar czcionki
    const minFontSize = 12; // Minimalny rozmiar czcionki

    function adjustFontSize(increment) {
        currentFontSize += increment;
        if (currentFontSize > maxFontSize) {
            currentFontSize = maxFontSize;
        } else if (currentFontSize < minFontSize) {
            currentFontSize = minFontSize;
        }
        document.body.style.fontSize = `${currentFontSize}px`; // Zastosuj do całego dokumentu
    }

    document.getElementById('increase-size').addEventListener('click', function(event) {
        event.preventDefault();
        adjustFontSize(1); // Zwiększ rozmiar czcionki o 1px
    });

    document.getElementById('decrease-size').addEventListener('click', function(event) {
        event.preventDefault();
        adjustFontSize(-1); // Zmniejsz rozmiar czcionki o 1px
    });

    function applyFilter(filterValue) {
        document.body.style.filter = filterValue; // Zastosuj do całego dokumentu
    }

    document.getElementById('grayscale').addEventListener('click', function(event) {
        event.preventDefault();
        applyFilter('grayscale(100%)');
    });

    document.getElementById('high-contrast').addEventListener('click', function(event) {
        event.preventDefault();
        applyFilter('contrast(200%)');
    });

    document.getElementById('invert-colors').addEventListener('click', function(event) {
        event.preventDefault();
        applyFilter('invert(100%)');
    });

    document.getElementById('light-shades').addEventListener('click', function(event) {
        event.preventDefault();
        applyFilter('brightness(150%)');
    });

    document.getElementById('reset').addEventListener('click', function(event) {
        event.preventDefault();
        currentFontSize = 16; // Reset do początkowego rozmiaru czcionki
        document.body.style.fontSize = `${currentFontSize}px`;
        document.body.style.filter = ''; // Resetowanie filtrów
    });
</script>

</body>
</html>
