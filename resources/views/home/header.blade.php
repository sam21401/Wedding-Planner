<header class="header_section">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-ring" style="color: #6b1c92; font-size: 2rem; margin-right: 10px;"></i>
            <span style="font-size: 1.5rem; font-weight: bold; color: #6b1c92;">Planer Wesela</span>
        </a>

        <!-- Nawigacja -->
        <nav class="navbar navbar-expand-lg custom_nav-container flex-grow-1">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">Start</a>
                    </li>
                    <li class="nav-item {{ request()->is('o-nas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/o-nas') }}">O nas</a>
                    </li>
                    <li class="nav-item dropdown {{ request()->is('o-aplikacji/*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            O aplikacji <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('o-aplikacji/lista-gosci') }}">Lista gości</a></li>
                            <li><a class="dropdown-item" href="{{ url('o-aplikacji/planer-stolow') }}">Planer stołów</a></li>
                            <li><a class="dropdown-item" href="{{ url('o-aplikacji/planer-noclegow') }}">Planer noclegów</a></li>
                            <li><a class="dropdown-item" href="{{ url('o-aplikacji/organizer-zadan') }}">Organizer zadań</a></li>
                            <li><a class="dropdown-item" href="{{ url('o-aplikacji/statystyki') }}">Statystyki</a></li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('faq') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item {{ request()->is('kontakt') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/kontakt') }}">Kontakt</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Zaloguj z rozwijanym menu -->
        <div class="dropdown custom-login-wrapper">
            <a href="#" class="custom-login-link dropdown-toggle" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i> Zaloguj
            </a>
            <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                <li><a class="dropdown-item" href="{{ url('/login') }}"><i class="fas fa-envelope me-2"></i>Zaloguj przez Email</a></li>
                <li><a class="dropdown-item" href="http://localhost/api/auth/google/"><i class="fab fa-google me-2"></i>Zaloguj przez Google</a></li>
                <li><a class="dropdown-item" href="http://localhost/api/auth/facebook/"><i class="fab fa-facebook-f me-2"></i>Zaloguj przez Facebook</a></li>
            </ul>
        </div>
    </div>
</header>

