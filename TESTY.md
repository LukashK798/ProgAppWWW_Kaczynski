# Testy – Laboratorium 3

Przeglądarka: Brave
Serwer: XAMPP (Apache i PHP), http://localhost/lab3/

## Test 1: biblioteka jQuery

W konsoli wpisałem jQuery.fn.jquery i dostałem "4.0.0", a typeof jQuery.fn.animate zwróciło "function". W konsoli nie było żadnych błędów. Poprawki nie były potrzebne.

## Test 2: animacja A

Kliknąłem przycisk A, który powiększył się do 240 × 130 px, a drugie kliknięcie przywróciło 160 × 90 px. Atrybut aria-pressed zgadzał się ze stanem. Po resecie kliknąłem go 10 razy bardzo szybko. Skończył w stanie bazowym i nie odtwarzał zaległej kolejki. Poprawki nie były potrzebne.

## Test 3: animacja B

Najechanie kursorem na B powiększyło go do 220 × 120 px. Wejście w B klawiszem Tab dało ten sam efekt. Po zabraniu kursora przy zachowanym fokusie obiekt został duży, a po utracie fokusu wrócił do 160 × 90 px. Poprawki nie były potrzebne.

## Test 4: animacja C i reset

Każde kliknięcie w C zwiększało obiekt o 20 × 10 px, a po pięciu krokach miał 260 × 140 px. Licznik pokazywał "Kroki C: 5 z 5", a kolejne kliknięcia niczego nie zmieniały. Reset zadziałał także w trakcie animacji i przywrócił 160 × 90 px oraz licznik 0. Poprawki nie były potrzebne.

## Test 5: klawiatura i ograniczony ruch

Tabem dotarłem do wszystkich przycisków, a Enter i Spacja obsługiwały A, C i reset. Po włączeniu w systemie ograniczenia ruchu i przeładowaniu strony zmiany rozmiarów były natychmiastowe, a funkcje działały tak samo. Fokus był widoczny. Poprawki nie były potrzebne.

## Test 6: poprzednie funkcje

Sprawdziłem tryb ciemny, zegar (Start, Stop) oraz formularz na stronie kontakt.html. Wszystko działało tak jak w laboratorium 2, a w konsoli nie było błędów. Poprawki nie były potrzebne.

## Test 7: PHP i AJAX

Strona http://localhost/lab3/status.php pokazała napis "PHP działa". Po kliknięciu "Sprawdź serwer" w Network widziałem żądanie GET z kodem 200 i odpowiedzią "PHP działa". Strona się nie przeładowała, a jedno kliknięcie wysłało jedno żądanie. Poprawki nie były potrzebne.

## Test 8: błąd 404 i wolna sieć

Zmieniłem nazwę status.php i kliknąłem przycisk. W Network pojawił się błąd 404, a na stronie komunikat o błędzie. Po przywróceniu nazwy pliku kolejna próba znów pokazała "PHP działa". Potem włączyłem Slow 3G. Było widać "Ładowanie…", przycisk był w tym czasie wyłączony, a odpowiedź przyszła po dłuższej chwili. Poprawki nie były potrzebne.