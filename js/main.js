const THEME_KEY = "theme";

function applyTheme(theme) {
  document.documentElement.setAttribute("data-theme", theme);
  const btn = document.querySelector("#theme-toggle");
  if (btn) btn.setAttribute("aria-pressed", String(theme === "dark"));
}

function getSavedTheme() {
  try {
    const v = localStorage.getItem(THEME_KEY);
    return v === "dark" || v === "light" ? v : "light";
  } catch {
    return "light";
  }
}

function initTheme() {
  applyTheme(getSavedTheme());
  const btn = document.querySelector("#theme-toggle");
  if (!btn) return;
  btn.addEventListener("click", () => {
    const next = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
    applyTheme(next);
    try { localStorage.setItem(THEME_KEY, next); } catch {}
  });
}

function initClock() {
  const dateEl = document.querySelector("#data");
  const timeEl = document.querySelector("#czas");
  const startBtn = document.querySelector("#start-zegara");
  const stopBtn = document.querySelector("#stop-zegara");
  if (!dateEl || !timeEl || !startBtn || !stopBtn) return;

  const dateFmt = new Intl.DateTimeFormat("pl-PL", { day: "2-digit", month: "long", year: "numeric" });
  const timeFmt = new Intl.DateTimeFormat("pl-PL", { hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: false });
  let intervalId = null;

  function update() {
    const now = new Date();
    dateEl.textContent = dateFmt.format(now);
    timeEl.textContent = timeFmt.format(now);
  }

  function start() {
    if (intervalId !== null) return;
    update();
    intervalId = setInterval(update, 1000);
  }

  function stop() {
    clearInterval(intervalId);
    intervalId = null;
  }

  startBtn.addEventListener("click", start);
  stopBtn.addEventListener("click", stop);
  start();
}

function initSearch() {
  const input = document.querySelector("#szukaj");
  const status = document.querySelector("#status-wyszukiwania");
  const cards = document.querySelectorAll(".karta");
  if (!input || !status || cards.length === 0) return;

  function filter() {
    const query = input.value.trim().toLowerCase();
    let count = 0;
    cards.forEach((card) => {
      const title = card.querySelector("h2");
      const name = title ? title.textContent.toLowerCase() : "";
      const match = name.includes(query);
      card.hidden = !match;
      if (match) count++;
    });
    status.textContent = count === 0
      ? "Brak produktów pasujących do zapytania."
      : `Znalezione produkty: ${count} z ${cards.length}`;
  }

  input.addEventListener("input", filter);
  filter();
}

const products = [
  { id: "iphone-17-pro", nazwa: "Iphone 17 pro", cenaGrosze: 509900 },
  { id: "samsung-galaxy-z-flip", nazwa: "Samsung Galaxy Z Flip", cenaGrosze: 1000000 },
  { id: "iphone-fold", nazwa: "Iphone Fold", cenaGrosze: 1200000 },
];

const plnFormat = new Intl.NumberFormat("pl-PL", { style: "currency", currency: "PLN" });

function calculateTotal(priceGrosze, quantity) {
  return priceGrosze * quantity;
}

function parseQuantity(raw) {
  const text = raw.trim();
  if (text === "") return null;
  const n = Number(text);
  if (!Number.isInteger(n) || n < 1 || n > 5) return null;
  return n;
}

function initOrderForm() {
  const form = document.querySelector("form");
  const select = document.querySelector("#produkt");
  const qtyInput = document.querySelector("#ilosc");
  const message = document.querySelector("#wiadomosc");
  const qtyError = document.querySelector("#blad-ilosc");
  const msgError = document.querySelector("#blad-wiadomosc");
  const price = document.querySelector("#wycena");
  const summary = document.querySelector("#podsumowanie");
  if (!form || !select || !qtyInput || !message || !qtyError || !msgError || !price || !summary) return;

  function updatePrice() {
    summary.textContent = "";
    const product = products.find((p) => p.id === select.value);
    const qty = parseQuantity(qtyInput.value);
    if (!product || qty === null) {
      price.textContent = "Wybierz produkt i podaj ilość jako liczbę całkowitą od 1 do 5.";
      return null;
    }
    const total = calculateTotal(product.cenaGrosze, qty);
    price.textContent = `Wartość: ${plnFormat.format(total / 100)}`;
    return { product, qty, total };
  }

  select.addEventListener("change", updatePrice);
  qtyInput.addEventListener("input", updatePrice);

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    qtyError.textContent = "";
    msgError.textContent = "";

    const result = updatePrice();
    if (!result) {
      qtyError.textContent = "Wybierz produkt i podaj ilość jako liczbę całkowitą od 1 do 5.";
      qtyInput.focus();
      return;
    }
    if (message.value.trim().length < 10) {
      msgError.textContent = "Wiadomość musi mieć co najmniej 10 znaków.";
      message.focus();
      return;
    }

    summary.textContent = "";
    const lines = [
      `Produkt: ${result.product.nazwa}`,
      `Ilość: ${result.qty}`,
      `Wartość: ${plnFormat.format(result.total / 100)}`,
      `Wiadomość: ${message.value.trim()}`,
    ];
    lines.forEach((text) => {
      const p = document.createElement("p");
      p.textContent = text;
      summary.appendChild(p);
    });
  });

  message.addEventListener("input", () => {
    msgError.textContent = "";
    summary.textContent = "";
  });
  updatePrice();
}

initTheme();
initClock();
initSearch();
initOrderForm();