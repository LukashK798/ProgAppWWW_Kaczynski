# Testy – Laboratorium 1

Przeglądarka: Brave
Serwer: python3 -m http.server 8001 (http://localhost:8001/)

## Test 1: struktura (Nu HTML Checker)
Sprawdziłem trzy pliki HTML w validatorze.
- index.html: 0 błędów, 1 ostrzeżenie "Section lacks heading". Chodzi o to,
  że section zwykle powinien mieć nagłówek. U mnie to tylko pojemnik na
  karty produktów, więc zostawiłem bez zmian.
- produkt.html: czysto.
- kontakt.html: czysto.

## Test 2: widoki
Po dodaniu CSS sprawdziłem w DevTools szerokości 375 px i 1280 px oraz
przejście przez 768 px. Poniżej 768 px katalog ma jedną kolumnę, od 768 px
trzy kolumny. Formularz mieści się w ekranie, zdjęcia mają dobre
proporcje, a strona nie wymaga przewijania w poziomie. Poprawki nie były
potrzebne.

## Test 3: klawiatura
Przeszedłem Tabem po menu i formularzu, wróciłem Shift+Tabem, linki
otwierałem Enterem i klikałem w etykiety. Kolejność jest logiczna, fokus
jest widoczny, a kliknięcie etykiety aktywuje właściwe pole. Poprawki nie
były potrzebne.

## Test 4: walidacja formularza
Przy każdej próbie resztę pól wypełniałem poprawnie.

| Próba | Wynik |
|---|---|
| pusty formularz | zatrzymany |
| zły e-mail | zatrzymany |
| liczba 0 | zatrzymany |
| liczba 6 | zatrzymany |
| wiadomość krótsza niż 10 znaków | zatrzymany |
| poprawny zestaw | wysłany, w URL: email, produkt, ilosc, wiadomosc |

## Test 5: eksperyment z name
Usunąłem name z pola e-mail (id i label zostały) i wysłałem poprawny
formularz. W adresie URL nie było parametru email, zostały tylko produkt,
ilosc i wiadomosc. Przeglądarka wysyła w adresie tylko pola, które mają
name, a id służy do połączenia pola z etykietą i do CSS. Potem
przywróciłem name. W DevTools (Network) widać, że formularz wysyła
żądanie metodą GET.