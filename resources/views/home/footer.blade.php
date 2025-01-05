<footer>
    <div class="container">
        <div class="row">
            <!-- Logo i informacje kontaktowe -->
            <div class="col-md-3">
                <div class="full">
                    <div class="logo_footer mb-4">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fas fa-ring" style="color: #6b1c92; font-size: 2rem; margin-right: 10px;"></i>
                            <span style="font-size: 1.5rem; font-weight: bold; color: #6b1c92;">Planer Wesela</span>
                        </a>
                    </div>
                    <div class="information_f">
                        <p><strong>Biuro Obsługi Klienta</strong></p>
                        <p>ul. Wesoła 123<br />00-001 Warszawa</p>
                        <p><strong>Telefon:</strong> +48 123 456 789</p>
                        <p><strong>Email:</strong> kontakt@planerwesela.pl</p>
                        <p><strong>Godziny otwarcia:</strong><br />Pn - Pt: 8:00 - 18:00<br />Sb: 10:00 - 14:00</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <div class="col-md-3">
                <div class="widget_menu">
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="{{ url('/') }}">Strona główna</a></li>
                        <li><a href="{{ url('/o-nas') }}">O nas</a></li>
                        <li><a href="{{ url('/o-aplikacji') }}">O aplikacji</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('/kontakt') }}">Kontakt</a></li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-md-3">
                <div class="widget_menu">
                    <h3>Newsletter</h3>
                    <div class="information_f">
                        <p>Zapisz się na nasz newsletter, aby otrzymywać najnowsze informacje o aplikacji, porady i promocje!</p>
                    </div>
                    <div class="form_sub">
                        <form>
                            <fieldset>
                                <div class="field">
                                    <input type="email" placeholder="Wpisz swój email" name="email" required />
                                    <button type="submit" class="btn-newsletter">Zapisz się</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Kontakt online -->
            <div class="col-md-3">
                <div class="widget_menu">
                    <h3>Kontakt online</h3>
                    <div class="information_f">
                        <p>Masz pytania? Skontaktuj się z nami natychmiast!</p>
                    </div>
                    <div class="contact_online">
                        <a href="{{ url('/kontakt-online') }}" class="btn-online"><i class="fas fa-envelope me-2"></i> Formularz kontaktowy</a>
                        <a href="#" class="btn-chat"><i class="fas fa-comments me-2"></i> Rozpocznij czat</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dolny pasek -->
        <div class="row mt-4">
            <div class="col text-center">
                <p class="copyright">© 2025 Planer Wesela - Wszystkie prawa zastrzeżone.</p>
            </div>
        </div>
    </div>
</footer>

<style>

</style>
