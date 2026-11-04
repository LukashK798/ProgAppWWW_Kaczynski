(function ($) {
  const BASE = { width: 160, height: 90 };
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

  $.fx.off = reduceMotion.matches;
  reduceMotion.addEventListener("change", (e) => {
    $.fx.off = e.matches;
  });

  const $section = $("#lab3-demo");
  const $a = $section.find("#obiekt-a");
  const $b = $section.find("#obiekt-b");
  const $c = $section.find("#obiekt-c");
  const $statusC = $section.find("#lab3-status-c");

  let bigA = false;
  $a.on("click", function () {
    bigA = !bigA;
    $a.attr("aria-pressed", String(bigA));
    const target = bigA ? { width: 240, height: 130 } : BASE;
    $a.stop(true, false).animate(target, 300);
  });

  let hoverB = false;
  let focusB = false;

  function updateB() {
    const target = hoverB || focusB ? { width: 220, height: 120 } : BASE;
    $b.stop(true, false).animate(target, 200);
  }

  $b.on("mouseenter", function () { hoverB = true; updateB(); });
  $b.on("mouseleave", function () { hoverB = false; updateB(); });
  $b.on("focus", function () { focusB = true; updateB(); });
  $b.on("blur", function () { focusB = false; updateB(); });

  const MAX_STEPS = 5;
  let stepsC = 0;

  function showStepsC() {
    $statusC.text(`Kroki C: ${stepsC} z ${MAX_STEPS}`);
  }

  $c.on("click", function () {
    if ($c.is(":animated")) return;
    if (stepsC >= MAX_STEPS) return;
    stepsC++;
    $c.animate(
      { width: BASE.width + 20 * stepsC, height: BASE.height + 10 * stepsC },
      200
    );
    showStepsC();
  });

  showStepsC();

  $section.find("#lab3-reset").on("click", function () {
    $a.add($c).stop(true, false).css(BASE);
    bigA = false;
    $a.attr("aria-pressed", "false");
    stepsC = 0;
    showStepsC();
  });

  const $serverBtn = $section.find("#sprawdz-serwer");
  const $serverResult = $section.find("#wynik-serwera");

  $serverBtn.on("click", function () {
    if ($serverBtn.prop("disabled")) return;
    $serverBtn.prop("disabled", true);
    $serverResult.text("Ładowanie…");

    $.ajax({
      url: "status.php",
      method: "GET",
      dataType: "text",
      timeout: 5000,
    })
      .done(function (text) {
        $serverResult.text(text);
      })
      .fail(function (jqXHR, textStatus) {
        if (textStatus === "timeout") {
          $serverResult.text("Błąd: przekroczono czas oczekiwania (5 s).");
        } else if (jqXHR.status) {
          $serverResult.text(`Błąd: serwer zwrócił kod ${jqXHR.status}.`);
        } else {
          $serverResult.text("Błąd: nie udało się połączyć z serwerem.");
        }
      })
      .always(function () {
        $serverBtn.prop("disabled", false);
      });
  });
})(jQuery);