<!DOCTYPE html> 
<html lang="pl">
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="">
    <title>@yield('title', 'ZWiK')</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
    @yield('head')
    <style>
        /* Padający śnieg */
        .snowflake {
            position: fixed;
            top: -10%;
            z-index: 9999;
            pointer-events: none;
            color: #fff;
            animation-name: snowflakes-fall, snowflakes-shake;
            animation-duration: 10s, 3s;
            animation-timing-function: linear, ease-in-out;
            animation-iteration-count: infinite, infinite;
        }

        @keyframes snowflakes-fall {
            0% { top: -10%; }
            100% { top: 100%; }
        }

        @keyframes snowflakes-shake {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(80px); }
        }

        /* Nakładka z życzeniami */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right:0;
            bottom:0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 1s ease;
        }

        .overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .overlay .card {
            background: #fff;
            padding: 30px;
            max-width: 600px;
            width: 90%;
            border-radius: 10px;
            position: relative;
            text-align: center;
            font-family: "Georgia", serif;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            animation: fadeInUp 1s forwards;
        }

        @keyframes fadeInUp {
            0% { transform: translateY(20px); opacity:0; }
            100% { transform: translateY(0); opacity:1; }
        }

        .overlay .card h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        .overlay .card p {
            color: #34495e;
            font-size: 1.1em;
            line-height: 1.5em;
        }

        .overlay .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 20px;
            color: #888;
            cursor: pointer;
        }

        .overlay .close-btn:hover {
            color: #333;
        }
    </style>
</head>
<body>
<!---
<div class="alert alert-info">
    <marquee>W dniu 24 grudnia 2024 r. (wtorek) z powodu konserwacji systemu teleinformatycznego Zakład Wodociągów i Kanalizacji w Jaworze będzie nieczynny. Za utrudnienia przepraszamy.</marquee>
</div>
-->
<div class="hero_area">
    @include('home.header')
    @yield('slider')
    @include('home.options')
</div>

@yield('content')

@include('home.footer')

<div class="cpy_">
   <p class="mx-auto">© {{ date('Y') }} Paweł Żebrowski</p>
</div>

<!-- jQuery -->
<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('home/js/bootstrap.js') }}"></script>
<!-- custom js -->
<script src="{{ asset('home/js/custom.js') }}"></script>
@yield('scripts')

<!-- Kod padającego śniegu -->
<div class="snow-container"></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const snowContainer = document.querySelector('.snow-container');
    const snowflakeCount = 50; // liczba płatków śniegu

    for (let i = 0; i < snowflakeCount; i++) {
        const snowflake = document.createElement('div');
        snowflake.innerHTML = '❄';
        snowflake.classList.add('snowflake');
        // Losowa pozycja i opóźnienia
        snowflake.style.left = Math.random() * 100 + '%';
        snowflake.style.fontSize = (Math.random() * 1 + 0.8) + 'em';
        snowflake.style.animationDelay = Math.random() + 's';
        snowflake.style.opacity = Math.random();
        snowContainer.appendChild(snowflake);
    }

    // Wyświetlanie życzeń po 3 sekundach
    setTimeout(() => {
        document.querySelector('.overlay').classList.add('show');
    }, 3000);

});
</script>

<!-- Overlay z życzeniami 
<div class="overlay">
    <div class="card">
        <span class="close-btn">&times;</span>
        <h2>Wesołych Świąt!</h2>
        <p>Szanowni Państwo,<br />
            Z okazji Świąt Bożego Narodzenia składamy najserdeczniejsze życzenia spokoju i radości, które płyną niczym czysta woda przez nasze sieci. Niech ten wyjątkowy czas napełni Państwa domy ciepłem rodzinnym, a nadchodzący Nowy Rok przyniesie obfitość szczęścia i pomyślności.
        <p>
       Niech każdy strumień miłości i dobroci otacza Państwa z każdej strony, a wszelkie przeciwności rozpuszczą się jak lód pod promieniami świątecznego słońca.
        <p>
        Dziękujemy za zaufanie i współpracę w mijającym roku – razem dbamy o krystalicznie czyste źródła naszego wspólnego dobrobytu.
        </p>
        <p style="font-weight:bold;">
            Wesołych Świąt oraz Szczęśliwego Nowego Roku!
        </p>
        <p>
            Z serdecznymi pozdrowieniami,<br>
            Zespół Zakładu Wodociągów i Kanalizacji
        </p>
    </div>
</div>
-->
<script>
    document.querySelector('.close-btn').addEventListener('click', function(){
        document.querySelector('.overlay').classList.remove('show');
    });
</script>

</body>
</html>
