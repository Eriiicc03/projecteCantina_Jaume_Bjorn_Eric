export function showBurger() {
  const burger = document.querySelector("#burgerBtn");
  const menu = document.querySelector("#menu");

  if (!burger || !menu) return;

  burger.addEventListener("click", () => {
    const abierto = menu.classList.toggle("open");
    burger.textContent = abierto ? "X" : "☰";
    burger.setAttribute("aria-expanded", abierto);
  });
}
