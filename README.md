# Laboratorium 6: PHP i baza danych w prostym CMS (wersja v1.5)

## Odtworzenie środowiska

1. Włączam Apache i MySQL w XAMPP, a folder lab6 kopiuję do htdocs.
2. W phpMyAdmin importuję sql/schema.sql, a potem sql/seed.sql.
3. Tworzę użytkownika tylko do odczytu:
   CREATE USER 'cms_odczyt'@'localhost' IDENTIFIED BY 'MOJE_HASLO';
   GRANT SELECT ON moja_strona.page_list TO 'cms_odczyt'@'localhost';
4. Kopiuję cfg.example.php do cfg.php i wpisuję użytkownika oraz hasło.
5. Otwieram http://localhost/lab6/index.php.

Plik cfg.php jest w .gitignore i nie trafia do repozytorium.

## Pseudokod odczytu strony

odczytaj idp z $_GET (brak lub pusty -> glowna)
połącz się z bazą (PDO)
pobierz menu: rekordy ze status = 1, ORDER BY id
idp nie jest tekstem albo nie pasuje do formatu aliasu (1-20 znaków a-z, 0-9, -) -> 404
pobierz rekord przez prepare i execute z parametrem :alias (status = 1, LIMIT 1)
brak rekordu (nieznany alias lub szkic) -> 404
wyjątek bazy -> zapis do logu, 500 i ogólny komunikat
ustaw kod HTTP przed HTML i wypisz szablon: menu, main, stopka

## Wyjaśnienia

- id to trwały numer rekordu, a alias to tekst z adresu, np. filmy, który można zmienić.
- Alias trafia do zapytania jako parametr :alias, a SQL nie jest sklejany z $_GET, więc ' OR 1=1-- to zwykła wartość.
- 404 oznacza brak lub nieopublikowaną stronę. 500 oznacza awarię serwera, a szczegóły są tylko w logu.

## Wyniki prób

| Próba | Oczekiwany wynik | Rzeczywisty wynik |
|---|---|---|
| Odczyt i zmiana treści | Strona główna (200); zmiana w bazie widoczna po odświeżeniu | Zgodne |
| Nowa strona i menu | Link w menu, strona działa, aktywny link oznaczony | Zgodne |
| Szkic i publikacja | Status 0: brak w menu i 404; status 1: widoczna; duplikat aliasu odrzucony | Zgodne |
| Błędne dane w adresie | Nieznany alias, tablica, ../cfg.php i ' OR 1=1-- dają 404 bez ostrzeżeń | Zgodne |
| Awaria bazy | Błędny port: 500 bez szczegółów, przyczyna w logu; po poprawce działa | Zgodne |
| Funkcje po migracji | Style, obrazy, animacje, AJAX, filmy; katalog POST 303, GET 200 | Zgodne |
| Odtworzenie środowiska | Pusta baza, import i konfiguracja, polskie znaki poprawne | Zgodne |

## Punkt wyjścia do kolejnego laboratorium

Działa odczyt z page_list, konfiguracja PDO, showpage.php i szkielet admin/admin.php. Katalog produktów nadal korzysta z includes/produkty.php.