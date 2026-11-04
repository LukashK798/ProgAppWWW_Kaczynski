# Laboratorium 3: jQuery i PHP

Rozbudowałem sklep z lab 2 o trzy animacje jQuery i sprawdzenie serwera PHP przez AJAX.

## Jak uruchomić

1. Zainstalowałem XAMPP i włączyłem Apache.
2. Folder lab3 skopiowałem do htdocs.
3. Stronę otwieram pod http://localhost/lab3/, a test PHP pod http://localhost/lab3/status.php (pokazuje "PHP działa").

Apache działa u mnie na domyślnym porcie, więc w adresie nie ma numeru portu.

## Wersja jQuery

jQuery 4.0.0, pełna wersja (nie slim, bo potrzebuję efektów i AJAX). Plik: vendor/jquery-4.0.0.min.js. W konsoli jQuery.fn.jquery zwraca "4.0.0", a jQuery.fn.animate jest funkcją.

## Pseudokody

Animacja A:
  po kliknięciu zmieniam stan (duży / mały) i zapisuję go w aria-pressed
  zatrzymuję poprzednią animację razem z kolejką
  animuję do 240x130 albo z powrotem do 160x90 (300 ms)

Animacja B:
  trzymam dwa stany: kursor nad obiektem i fokus
  przy każdej zmianie stanu: jeśli któryś jest włączony, rozmiar 220x120, w przeciwnym razie 160x90
  przed animacją zatrzymuję poprzednią

Animacja C:
  po kliknięciu: jeśli trwa animacja albo są już 5 kroki, nic nie robię
  w przeciwnym razie zwiększam licznik kroków i animuję do (160 + 20 * kroki) x (90 + 10 * kroki)
  licznik pokazuję w obszarze role="status"

AJAX:
  po kliknięciu wyłączam przycisk i pokazuję "Ładowanie…"
  wysyłam GET do status.php (timeout 5 s)
  sukces: wyświetlam odpowiedź; błąd: wyświetlam komunikat; na końcu zawsze włączam przycisk

## Testy

| Próba | Co zrobiłem | Oczekiwane | Rzeczywiste |
|---|---|---|---|
| Szybkie kliknięcia A | Reset, potem 10 szybkich kliknięć w A | Po kliknięciach stan bazowy, bez zaległej kolejki | Zgodne z oczekiwanym |
| Kursor i fokus B | Wszedłem w B Tabem, wyjechałem kursorem; potem straciłem fokus | Przy fokusie obiekt się nie zmniejsza, bez fokusu i kursora wraca do 160x90 | Zgodne z oczekiwanym |
| Limit i reset C | 5 kliknięć w C, kolejne kliknięcia, reset w trakcie animacji | 260x140 po pięciu krokach, dalej bez zmian, reset zeruje stan | Zgodne z oczekiwanym |
| Klawiatura i ruch | Tab, Enter i Spacja na A, C i reset; włączone ograniczenie ruchu | Wszystko działa klawiaturą, przy ograniczeniu ruchu zmiany są natychmiastowe | Zgodne z oczekiwanym |
| Stare funkcje | Motyw, zegar, formularz | Działają jak w lab 2, w konsoli brak błędów | Zgodne z oczekiwanym |
| AJAX | Kliknięcie "Sprawdź serwer" | GET, status 200, odpowiedź "PHP działa", strona się nie przeładowuje | Zgodne z oczekiwanym |
| AJAX błąd 404 | Zmieniłem nazwę status.php i kliknąłem, potem przywróciłem nazwę | Komunikat o błędzie 404, po przywróceniu znów "PHP działa" | Zgodne z oczekiwanym |
| AJAX wolna sieć | Throttling Slow 3G w Network, kliknięcie | Widać "Ładowanie…", przycisk jest wyłączony, jedno kliknięcie to jedno żądanie | Zgodne z oczekiwanym |