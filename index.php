<?php
const KATALOG_WIDOKOW = __DIR__ . '/html/';

$projekt = 'sklep-demo';

$widoki = [
    'glowna'  => ['plik' => 'glowna.html',  'tytul' => 'Sklep – katalog',            'menu' => 'Katalog'],
    'produkt' => ['plik' => 'produkt.html', 'tytul' => 'Iphone 17 pro – szczegóły',  'menu' => 'Produkt'],
    'kontakt' => ['plik' => 'kontakt.html', 'tytul' => 'Kontakt – zapytanie o produkt', 'menu' => 'Kontakt'],
    'filmy'   => ['plik' => 'filmy.html',   'tytul' => 'Filmy',                       'menu' => 'Filmy'],
];

$kod = 200;
$aktywny = null;
$plik = null;

$idp = $_GET['idp'] ?? '';
if ($idp === '') {
    $idp = 'glowna';
}

if (!is_string($idp) || !array_key_exists($idp, $widoki)) {
    $kod = 404;
} else {
    $aktywny = $idp;
    $sciezka = KATALOG_WIDOKOW . $widoki[$idp]['plik'];
    if (is_file($sciezka) && is_readable($sciezka)) {
        $plik = $sciezka;
    } else {
        $kod = 500;
    }
}

http_response_code($kod);

if ($kod === 404) {
    $tytul = 'Nie znaleziono strony';
} elseif ($kod === 500) {
    $tytul = 'Błąd serwera';
} else {
    $tytul = $widoki[$aktywny]['tytul'];
}
?>
<!doctype html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($tytul, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/lab3.css">
  <script src="vendor/jquery-4.0.0.min.js" defer></script>
  <script src="js/main.js" defer></script>
  <script src="js/lab3.js" defer></script>
</head>
<body>
  <header>
    <nav>
<?php foreach ($widoki as $id => $widok) : ?>
      <a href="index.php?idp=<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>"<?php echo $id === $aktywny ? ' aria-current="page"' : ''; ?>><?php echo htmlspecialchars($widok['menu'], ENT_QUOTES, 'UTF-8'); ?></a>
<?php endforeach; ?>
      <a href="lab4.php">Katalog PHP</a>
    </nav>
    <button type="button" id="theme-toggle" aria-pressed="false">Tryb ciemny</button>
  </header>

  <main>
<?php if ($kod === 404) : ?>
    <h1>Nie znaleziono strony</h1>
    <p>Taka podstrona nie istnieje.</p>
    <p><a href="index.php">Wróć do strony głównej</a></p>
<?php elseif ($kod === 500) : ?>
    <h1>Błąd serwera</h1>
    <p>Nie można teraz wyświetlić tej podstrony.</p>
    <p><a href="index.php">Wróć do strony głównej</a></p>
<?php else : ?>
<?php include $plik; ?>
<?php endif; ?>
  </main>

  <footer>
    <p>Laboratorium 5, projekt: <?php echo htmlspecialchars($projekt, ENT_QUOTES, 'UTF-8'); ?></p>
  </footer>
</body>
</html>