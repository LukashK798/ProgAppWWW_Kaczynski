USE moja_strona;
SET NAMES utf8mb4;

INSERT INTO page_list (alias, page_title, page_content, status) VALUES
('glowna', 'Katalog', '<h1>Katalog produktów</h1>

    <section aria-label="Data i godzina">
      <p id="data"></p>
      <p id="czas"></p>
      <button type="button" id="start-zegara">Start zegara</button>
      <button type="button" id="stop-zegara">Stop zegara</button>
    </section>

    <label for="szukaj">Szukaj produktu</label>
    <input type="search" id="szukaj">
    <p id="status-wyszukiwania" aria-live="polite"></p>

    <section class="katalog">
      <article class="karta">
        <h2><a href="index.php?idp=produkt">Iphone 17 pro</a></h2>
        <img src="img/produkt1.jpg" alt="Iphone 17 pro widziany z tyłu" width="600" height="600">
        <p>Telefon z trzema aparatami i dużym ekranem.</p>
        <p>Cena: 5099,00 zł</p>
      </article>

      <article class="karta">
        <h2>Samsung Galaxy Z Flip</h2>
        <img src="img/produkt2.jpg" alt="Samsung Galaxy Z Flip" width="600" height="600">
        <p>Rozkładany telefon</p>
        <p>Cena: 10000,00 zł</p>
      </article>

      <article class="karta">
        <h2>Iphone Fold</h2>
        <img src="img/produkt3.jpg" alt="Iphone Fold" width="600" height="600">
        <p>Rozkładany telefon</p>
        <p>Cena: 12000,00 zł</p>
      </article>
    </section>

    <section id="lab3-demo" aria-labelledby="lab3-tytul">
      <h2 id="lab3-tytul">Animacje jQuery</h2>

      <div class="lab3-obiekty">
        <button type="button" class="lab3-obiekt" id="obiekt-a" aria-pressed="false">A: kliknij</button>
        <button type="button" class="lab3-obiekt" id="obiekt-b">B: najedź lub fokus</button>
        <button type="button" class="lab3-obiekt" id="obiekt-c">C: rośnij</button>
      </div>

      <p id="lab3-status-c" role="status"></p>
      <button type="button" id="lab3-reset">Resetuj A i C</button>

      <h3>Serwer PHP</h3>
      <button type="button" id="sprawdz-serwer">Sprawdź serwer</button>
      <p id="wynik-serwera" role="status"></p>
    </section>', 1),

('produkt', 'Produkt', '<h1>Iphone 17 pro</h1>

    <img src="img/produkt1.jpg" alt="Iphone 17 pro widziany z tyłu" width="600" height="600">

    <p>Cena: <strong>5099,00 zł</strong></p>
    <p>Telefon z <em>trzema aparatami</em> i dużym ekranem.</p>

    <h2>Cechy produktu</h2>
    <ul>
      <li>Potrójny aparat</li>
      <li>Duży ekran</li>
      <li>Wydajny procesor</li>
    </ul>

    <h2>Parametry</h2>
    <table>
      <caption>Parametry techniczne</caption>
      <thead>
        <tr>
          <th scope="col">Parametr</th>
          <th scope="col">Wartość</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ekran</td>
          <td>6,3 cala</td>
        </tr>
        <tr>
          <td>Pamięć</td>
          <td>256 GB</td>
        </tr>
        <tr>
          <td>Aparat główny</td>
          <td>48 Mpix</td>
        </tr>
      </tbody>
    </table>

    <p><a href="index.php?idp=kontakt">Zapytaj o produkt</a></p>', 1),

('kontakt', 'Kontakt', '<h1>Zapytanie o produkt</h1>

    <p>Podgląd lokalny. Formularz nie wysyła wiadomości. Pola oznaczone * są obowiązkowe.</p>

    <form method="get" action="index.php">
      <input type="hidden" name="idp" value="kontakt">

      <p>
        <label for="email">E-mail *</label>
        <input type="email" id="email" name="email" required>
      </p>

      <p>
        <label for="produkt">Produkt *</label>
        <select id="produkt" name="produkt" required>
          <option value="">Wybierz produkt</option>
          <option value="iphone-17-pro">Iphone 17 pro</option>
          <option value="samsung-galaxy-z-flip">Samsung Galaxy Z Flip</option>
          <option value="iphone-fold">Iphone Fold</option>
        </select>
      </p>

      <p>
        <label for="ilosc">Liczba sztuk * (od 1 do 5)</label>
        <input type="number" id="ilosc" name="ilosc" required min="1" max="5" step="1">
      </p>
      <p id="blad-ilosc"></p>

      <p>
        <label for="wiadomosc">Wiadomość * (od 10 do 500 znaków)</label>
        <textarea id="wiadomosc" name="wiadomosc" required minlength="10" maxlength="500" rows="5"></textarea>
      </p>
      <p id="blad-wiadomosc"></p>

      <p id="wycena" aria-live="polite"></p>

      <button type="submit">Sprawdź zapytanie</button>
    </form>

    <div id="podsumowanie" aria-live="polite"></div>', 1),

('filmy', 'Filmy', '<h1>Filmy</h1>

    <h2>Iphone 17 pro</h2>
    <div class="film">
      <iframe src="https://www.youtube.com/embed/ZpOO4-E9w44" title="Film o telefonie Iphone 17 pro" loading="lazy" allowfullscreen></iframe>
    </div>

    <h2>Samsung Galaxy Z Flip</h2>
    <div class="film">
      <iframe src="https://www.youtube.com/embed/frRId_8d81w" title="Film o telefonie Samsung Galaxy Z Flip" loading="lazy" allowfullscreen></iframe>
    </div>

    <h2>Iphone Fold</h2>
    <div class="film">
      <iframe src="https://www.youtube.com/embed/GTW0rwGJ8GM" title="Film o telefonie Iphone Fold" loading="lazy" allowfullscreen></iframe>
    </div>', 1),

('szkic', 'Szkic', '<h1>Szkic</h1>
    <p>Ta strona jest jeszcze nieopublikowana.</p>', 0);