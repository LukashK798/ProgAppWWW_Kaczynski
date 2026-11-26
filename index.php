<?php
$projekt = 'sklep-demo';
$wersja = 'v1.5';

$kod = 200;
$aktywny = null;
$rekord = null;
$menu = [];

$idp = $_GET['idp'] ?? '';
if ($idp === '') {
    $idp = 'glowna';
}

try {
    require_once __DIR__ . '/cfg.php';
    require_once __DIR__ . '/showpage.php';

    $zapytanieMenu = $pdo->prepare('SELECT alias, page_title FROM page_list WHERE status = 1 ORDER BY id');
    $zapytanieMenu->execute();
    $menu = $zapytanieMenu->fetchAll(PDO::FETCH_ASSOC);

    if (!is_string($idp) || preg_match('/^[a-z0-9-]{1,20}$/', $idp) !== 1) {
        $kod = 404;
    } else {
        $rekord = PokazPodstrone($pdo, $idp);
        if ($rekord === null) {
            $kod = 404;
        } else {
            $aktywny = $idp;
        }
    }
} catch (Throwable $e) {
    error_log('Blad CMS: ' . $e->getMessage());
    $kod = 500;
    $rekord = null;
    $menu = [];
    $aktywny = null;
}

http_response_code($kod);

if ($kod === 404) {
    $tytul = 'Nie znaleziono strony';
} elseif ($kod === 500) {
    $tytul = 'Błąd serwera';
} else {
    $tytul = $rekord['page_title'];
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
<?php foreach ($menu as $pozycja) : ?>
      <a href="index.php?idp=<?php echo htmlspecialchars($pozycja['alias'], ENT_QUOTES, 'UTF-8'); ?>"<?php echo $pozycja['alias'] === $aktywny ? ' aria-current="page"' : ''; ?>><?php echo htmlspecialchars($pozycja['page_title'], ENT_QUOTES, 'UTF-8'); ?></a>
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
<?php echo $rekord['page_content']; ?>
<?php endif; ?>
  </main>

  <footer>
    <p>Laboratorium 6, projekt: <?php echo htmlspecialchars($projekt, ENT_QUOTES, 'UTF-8'); ?>, wersja <?php echo htmlspecialchars($wersja, ENT_QUOTES, 'UTF-8'); ?></p>
  </footer>
</body>
</html>