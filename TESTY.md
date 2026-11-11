# Testy – Laboratorium 4

Przeglądarka: Brave
Serwer: XAMPP (Apache i PHP), http://localhost/lab4/

## Test 1: filtr GET

Otworzyłem lab4.php?kategoria=ksiazki i zobaczyłem tylko trzy książki. Przy ?kategoria=abc oraz ?kategoria[]=ksiazki pojawiła się pełna lista i komunikat o nieznanej kategorii. Poprawki nie były potrzebne.

## Test 2: poprawny zapis

Wybrałem "Kurs PHP dla początkujących" i ilość 2. W Network zobaczyłem POST ze statusem 303, a zaraz po nim GET ze statusem 200. W sekcji "Ostatni wybór" pojawił się ten produkt i ilość 2. Po odświeżeniu strony i po zmianie filtra na Akcesoria wybór nadal był widoczny. Poprawki nie były potrzebne.

## Test 3: błędne wartości POST

W Inspektorze zmieniałem formularz i wysyłałem go z ilością 0, 6, 2.5 i 2abc. Zmieniłem też nazwę pola ilosc, dopisałem [] do nazwy pola i wpisałem nieistniejący identyfikator produktu 999. Każda próba dała status 400 i komunikat obok pola. Poprzedni wybór w sesji pozostał bez zmian. Poprawki nie były potrzebne.

## Test 4: stan magazynowy

Wybrałem "HTML i CSS w praktyce" (stan 1) i ilość 2. Serwer odrzucił wybór statusem 400 i komunikatem o stanie, mimo że 2 mieści się w zakresie 1–5. Podobnie było przy "Szkle ochronnym" (stan 0) i ilości 1. Poprawki nie były potrzebne.

## Test 5: odrębna sesja i tekst HTML

W oknie prywatnym zobaczyłem komunikat, że nie zapisano jeszcze wyboru. Potem tymczasowo zmieniłem nazwę produktu w produkty.php na <b>Test</b> i wybrałem go. Nazwa wyświetliła się jako zwykły tekst z nawiasami, bez pogrubienia. Po teście przywróciłem starą nazwę. Poprawki nie były potrzebne.

## Test 6: ścieżki po przeniesieniu plików

Otworzyłem stronę główną i obie podstrony w folderze html. Style, obrazy, linki i tryb ciemny działały. Animacje A, B, C oraz reset też działały, a przycisk "Sprawdź serwer" pokazał "PHP działa" (status.php dał 200). Poprawki nie były potrzebne.

## Test 7: zmiana limitu ilości

Zmieniłem stałą MAX_ILOSC z 5 na 3. Lista ilości miała opcje od 1 do 3. Ilość 4, wysłana po zmianie wartości w Inspektorze, dała status 400. Ilość 3 została zapisana (303, potem 200). Poprawki nie były potrzebne.