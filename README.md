# Laboratorium 4: formularze i sesja w PHP

## Jak uruchomić

1. Włączam Apache w XAMPP.
2. Folder lab4 kopiuję do htdocs.
3. Otwieram http://localhost/lab4/ i klikam "Katalog PHP" (adres: http://localhost/lab4/lab4.php).

## Pseudokod

lab4.php:
  start sesji
  wczytaj dane z includes/produkty.php
  jeśli GET kategoria jest jedną z: wszystkie, ksiazki, akcesoria -> użyj jej
  jeśli jest inna wartość albo tablica -> pełna lista i komunikat
  jeśli metoda to POST:
    sprawdź, czy produkt i ilość są liczbami całkowitymi
    produkt musi istnieć, ilość musi być od 1 do limitu i nie większa niż stan
    jeśli jest błąd -> kod 400, komunikat przy polu, sesja bez zmian
    jeśli jest dobrze -> zapisz id produktu i ilość w sesji, przekieruj (303) na lab4.php, exit
  wypisz stronę: ostatni wybór z sesji, filtr, listę produktów, formularz

## Jak to działa

Dane katalogu są w includes/produkty.php (tablica $produkty). Plik niczego nie wypisuje.

GET służy do pobrania katalogu z wybranym filtrem i nie zmienia sesji.

POST zapisuje wybór produktu i ilości. Sesja zmienia się tylko wtedy, gdy POST jest poprawny. Po zapisie następuje przekierowanie 303, więc odświeżenie strony nie wysyła formularza ponownie.

## include i require_once

require_once użyłem do pliku z danymi, bo bez niego strona nie ma sensu, a "once" nie pozwala wczytać go drugi raz. include użyłem do nagłówka, bo to tylko fragment HTML i brak pliku nie powinien zatrzymywać całej strony.

## Limit ilości

Limit jest w stałej MAX_ILOSC na początku lab4.php (domyślnie 5). Zmieniłem go na 3 i sprawdziłem: ilość 4 jest odrzucana (400), a 3 przechodzi.

## Wyniki prób

Metodę i kod odpowiedzi sprawdzałem w panelu Network.

| Próba | Kroki | Oczekiwany wynik | Rzeczywisty wynik |
|---|---|---|---|
| Filtr GET | Otworzyłem lab4.php?kategoria=ksiazki, potem ?kategoria=abc i ?kategoria[]=ksiazki | Pierwszy adres pokazuje tylko książki, pozostałe pełną listę i komunikat | Zgodne z oczekiwanym |
| Poprawny POST i odświeżenie | Wybrałem produkt z dużym stanem i ilość 2, zapisałem, odświeżyłem stronę i zmieniłem filtr | W Network POST 303, potem GET 200. Po odświeżeniu i zmianie filtra wybór zostaje | Zgodne z oczekiwanym |
| Błędne wartości POST | W Inspektorze ustawiłem ilość 0, 6, 2.5 i 2abc, usunąłem atrybut name, dopisałem [] do nazwy pola i wpisałem nieistniejące id produktu | Każda próba daje HTTP 400, komunikat przy polu, a poprzedni wybór zostaje | Zgodne z oczekiwanym |
| Stan magazynowy | Wybrałem produkt ze stanem 1 i ilość 2 | Serwer odrzuca wybór (400), mimo że 2 mieści się w zakresie 1–5 | Zgodne z oczekiwanym |
| Odrębna sesja i tekst HTML | Otworzyłem stronę w oknie prywatnym. W produkty.php zmieniłem nazwę produktu na <b>Test</b> i wybrałem go | W nowej sesji nie ma wyboru. Nazwa wyświetla się jako tekst, bez pogrubienia | Zgodne z oczekiwanym |
| Zmiana ścieżek | Otworzyłem stronę główną i obie podstrony, kliknąłem linki, animacje A/B/C i "Sprawdź serwer" | Style, obrazy, linki i animacje działają, a żądanie do status.php zwraca 200 | Zgodne z oczekiwanym |