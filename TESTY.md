# Testy – Laboratorium 6

Przeglądarka: Brave. Serwer: XAMPP, http://localhost/lab6/index.php. Kody sprawdzałem w panelu Network.

1. **Odczyt i zmiana treści:** index.php i ?idp= dały 200. Zmiana treści w phpMyAdmin była widoczna po odświeżeniu. Wynik: zgodny.
2. **Nowa strona i menu:** nowy rekord pojawił się w menu i działał, aktywny link był oznaczony. Wynik: zgodny.
3. **Szkic i publikacja:** status 0 dał 404 i brak w menu, status 1 pokazał stronę. Duplikat aliasu baza odrzuciła. Wynik: zgodny.
4. **Błędne dane w adresie:** ?idp=nieznana, ?idp[]=filmy, ?idp=../cfg.php i ?idp=' OR 1=1-- dały 404 bez ostrzeżeń PHP. Wynik: zgodny.
5. **Awaria bazy:** port 3307 dał 500 z ogólnym komunikatem, a przyczyna była w logu Apache. Po powrocie do 3306 strona działała. Wynik: zgodny.
6. **Funkcje po migracji:** style, obrazy, animacje, AJAX i filmy działały. Katalog: POST 303, potem GET 200. Wynik: zgodny.
7. **Odtworzenie środowiska:** pusta baza, import schematu i danych, cfg.php z cfg.example.php. Strona działała z polskimi znakami. Wynik: zgodny.