# Testy – Laboratorium 5

Przeglądarka: Brave
Serwer: XAMPP (Apache i PHP), http://localhost/lab5/index.php
Kody odpowiedzi sprawdzałem w panelu Network.

## Test 1: strona główna i menu

Otwarłem index.php oraz index.php?idp= i oba razy zobaczyłem stronę główną (200). Kliknąłem w menu Katalog, Produkt, Kontakt, Filmy i Katalog PHP i wszystkie otworzyły właściwe treści. Poprawki nie były potrzebne.

## Test 2: nieznany klucz

Dla ?idp=nieznana zobaczyłem "Nie znaleziono strony", link do strony głównej i kod 404. Link powrotny działał. Poprawki nie były potrzebne.

## Test 3: klucz tablicowy

Dla ?idp[]=filmy zobaczyłem 404 i nie pojawiło się żadne ostrzeżenie PHP. Poprawki nie były potrzebne.

## Test 4: próba podania ścieżki

Dla ?idp=..%2Fstatus.php dostałem 404. Napis "PHP działa" się nie pojawił, więc status.php nie został dołączony. Poprawki nie były potrzebne.

## Test 5: brak pliku widoku

W htdocs zmieniłem nazwę html/filmy.html na filmy2.html i otwarłem ?idp=filmy. Zobaczyłem "Błąd serwera" bez ścieżki systemowej i kod 500. Po przywróceniu nazwy filmy znów działały (200). Poprawki nie były potrzebne.

## Test 6: strona główna i AJAX

Strona główna miała style, zdjęcia i działający zegar. Animacje A, B i C oraz reset działały. Po kliknięciu "Sprawdź serwer" pojawił się napis "PHP działa", a w Network wiersz status.php z kodem 200. Poprawki nie były potrzebne.

## Test 7: katalog i sesja

W lab4.php zapisałem "Kurs PHP dla początkujących" z ilością 2. W Network zobaczyłem POST 303, a potem GET 200. Po przejściu na stronę główną i do Filmów, a potem z powrotem do katalogu, wybór nadal był widoczny. Poprawki nie były potrzebne.

## Test 8: filmy i widok mobilny

Wszystkie trzy filmy uruchomiły się po kliknięciu Play i nie startowały same. Przy szerokości 360 px strona nie miała poziomego przewijania, a filmy mieściły się w ekranie. Klawiszem Tab przeszedłem po linkach menu i każdy miał widoczny fokus. Poprawki nie były potrzebne.