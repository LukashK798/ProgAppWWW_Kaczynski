<?php
session_start();
require_once __DIR__ . '/includes/produkty.php';

const MAX_ILOSC = 5;

$tytul = 'Katalog PHP';
$grupa = 'GR-1';

/* GET: filtr */
$dozwolone = ['wszystkie', 'ksiazki', 'akcesoria'];
$filtr = 'wszystkie';
$komunikatFiltra = '';

if (isset($_GET['kategoria'])) {
    $k = $_GET['kategoria'];
    if (is_string($k) && in_array($k, $dozwolone, true)) {
        $filtr = $k;
    } else {
        $komunikatFiltra = 'Nieznana kategoria. Pokazuję pełną listę.';
    }
}

/* POST: zapis wyboru */
$bledy = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduktu = filter_var($_POST['produkt'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $ilosc = filter_var($_POST['ilosc'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => MAX_ILOSC]]);

    $wybrany = null;
    if ($idProduktu === false) {
        $bledy['produkt'] = 'Wybierz produkt z listy.';
    } else {
        foreach ($produkty as $p) {
            if ($p['id'] === $idProduktu) {
                $wybrany = $p;
            }
        }
        if ($wybrany === null) {
            $bledy['produkt'] = 'Taki produkt nie istnieje.';
        }
    }

    if ($ilosc === false) {
        $bledy['ilosc'] = 'Podaj ilość jako liczbę całkowitą od 1 do ' . MAX_ILOSC . '.';
    } elseif ($wybrany !== null && $ilosc > $wybrany['stan']) {
        $bledy['ilosc'] = 'Na stanie jest tylko ' . $wybrany['stan'] . ' szt.';
    }

    if (count($bledy) === 0) {
        $_SESSION['ostatni_wybor'] = ['id' => $wybrany['id'], 'ilosc' => $ilosc];
        header('Location: lab4.php', true, 303);
        exit;
    }

    http_response_code(400);
}

/* Odczyt wyboru z sesji */
$sesjaProdukt = null;
$sesjaIlosc = 0;
if (isset($_SESSION['ostatni_wybor'])) {
    foreach ($produkty as $p) {
        if ($p['id'] === $_SESSION['ostatni_wybor']['id']) {
            $sesjaProdukt = $p;
        }
    }
    $sesjaIlosc = $_SESSION['ostatni_wybor']['ilosc'];
}
?>
<!doctype html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($tytul, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/main.js" defer></script>
</head>
<body>
<?php include __DIR__ . '/includes/naglowek.php'; ?>

  <main>
    <p><a href="index.html">Strona główna</a></p>

    <h2>Ostatni wybór</h2>
    <?php if ($sesjaProdukt !== null) : ?>
      <p>Produkt: <?php echo htmlspecialchars($sesjaProdukt['nazwa'], ENT_QUOTES, 'UTF-8'); ?>, ilość: <?php echo (int) $sesjaIlosc; ?></p>
    <?php else : ?>
      <p>Nie zapisano jeszcze wyboru.</p>
    <?php endif; ?>

    <h2>Filtr</h2>
    <form method="get" action="lab4.php">
      <p>
        <label for="kategoria">Kategoria</label>
        <select id="kategoria" name="kategoria">
          <option value="wszystkie">Wszystkie</option>
          <option value="ksiazki">Książki</option>
          <option value="akcesoria">Akcesoria</option>
        </select>
      </p>
      <button type="submit">Filtruj</button>
    </form>
    <?php if ($komunikatFiltra !== '') : ?>
      <p><?php echo htmlspecialchars($komunikatFiltra, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <h2>Produkty</h2>
    <div class="katalog">
    <?php
    $i = 0;
    $ile = count($produkty);
    while ($i < $ile) {
        $p = $produkty[$i];
        $i++;
        if ($filtr !== 'wszystkie' && $p['kategoria'] !== $filtr) {
            continue;
        }

        switch ($p['kategoria']) {
            case 'ksiazki':
                $etykieta = 'Książki';
                break;
            case 'akcesoria':
                $etykieta = 'Akcesoria';
                break;
            default:
                $etykieta = 'Inne';
        }

        if ($p['stan'] === 0) {
            $komunikat = 'Niedostępny';
        } elseif ($p['stan'] <= 5) {
            $komunikat = 'Niski stan';
        } else {
            $komunikat = 'Dostępny';
        }
        ?>
      <article class="karta">
        <h3><?php echo htmlspecialchars($p['nazwa'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p>Kategoria: <?php echo $etykieta; ?></p>
        <p>Stan: <?php echo $p['stan']; ?></p>
        <p><?php echo $komunikat; ?></p>
      </article>
        <?php
    }
    ?>
    </div>

    <h2>Wybierz produkt</h2>
    <form method="post" action="lab4.php">
      <p>
        <label for="produkt">Produkt</label>
        <select id="produkt" name="produkt">
          <option value="">Wybierz produkt</option>
          <?php foreach ($produkty as $p) : ?>
            <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nazwa'], ENT_QUOTES, 'UTF-8'); ?></option>
          <?php endforeach; ?>
        </select>
      </p>
      <p><?php echo isset($bledy['produkt']) ? htmlspecialchars($bledy['produkt'], ENT_QUOTES, 'UTF-8') : ''; ?></p>

      <p>
        <label for="ilosc">Ilość</label>
        <select id="ilosc" name="ilosc">
          <?php for ($n = 1; $n <= MAX_ILOSC; $n++) : ?>
            <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
          <?php endfor; ?>
        </select>
      </p>
      <p><?php echo isset($bledy['ilosc']) ? htmlspecialchars($bledy['ilosc'], ENT_QUOTES, 'UTF-8') : ''; ?></p>

      <button type="submit">Zapisz wybór</button>
    </form>
  </main>
</body>
</html>