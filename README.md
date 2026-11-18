# Laboratorium 5: szablon i podstrony w PHP

## Jak uruchomić

1. Włączam Apache w XAMPP.
2. Kopiuję folder lab5 do htdocs.
3. Otwieram http://localhost/lab5/index.php.

## Adresy

- index.php?idp=glowna, produkt, kontakt, filmy: podstrony
- lab4.php: katalog z filtrem, formularzem i sesją
- status.php: adres dla AJAX

## Pseudokod

odczytaj idp z $_GET
brak lub pusty tekst -> glowna
nie tekst albo nie ma w mapie -> 404 i link do strony głównej
plik z mapy nie istnieje lub nie da się go odczytać -> 500 bez ścieżki
w innym wypadku -> 200
ustaw kod HTTP przed HTML
wypisz szablon: menu, main (include widoku lub komunikat), stopka

## Jak to działa

index.php ma wspólny szablon. Identyfikator projektu jest w zmiennej $projekt i wypisuje go echo w stopce. Mapa $widoki łączy klucz widoku z plikiem w html/, tytułem i napisem w menu. Menu i tytuł generuje pętla z mapy, a ścieżki biorę tylko z mapy, nigdy od użytkownika.

idp wybiera podstronę informacyjną w index.php, a kategoria filtruje katalog w lab4.php. 404 oznacza, że podstrony nie ma w mapie. 500 oznacza, że jest w mapie, ale jej pliku brakuje.

Nowa podstrona: dodaję plik w html/ i jeden wpis do mapy, bez kopiowania szablonu.

## Wyniki prób

| Próba | Oczekiwany wynik | Rzeczywisty wynik |
|---|---|---|
| index.php i ?idp= oraz menu | Strona główna (200), linki działają | Zgodne |
| ?idp=nieznana | 404 i link powrotny | Zgodne |
| ?idp[]=filmy | 404 bez ostrzeżenia PHP | Zgodne |
| ?idp=..%2Fstatus.php | 404, status.php niedołączony | Zgodne |
| Zmieniona nazwa filmy.html | 500 bez ścieżki, po przywróceniu 200 | Zgodne |
| Strona główna i AJAX | Style, animacje, status.php 200 | Zgodne |
| Katalog i sesja | POST 303, GET 200, wybór zapamiętany | Zgodne |
| Filmy i 360 px | Filmy działają, brak poziomego przewijania | Zgodne |

## Punkt wyjścia

Mam trzy wejścia: index.php (podstrony), lab4.php (katalog) i status.php (AJAX). Treści są w html/, dane w includes/produkty.php.