export function canviaTema() {
    const html = document.documentElement;
    const themeButton = document.querySelector("#theme-toggle");

    // 1. En carregar la pàgina, recuperem el tema guardat a localStorage (si n'hi ha)
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        html.setAttribute("data-theme", savedTheme);
    }

    if (!themeButton) return;

    // 2. En fer clic al botó, alternem entre clar i fosc i guardem l'elecció
    themeButton.addEventListener("click", () => {
        const currentTheme = html.getAttribute("data-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        
        html.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);
    });
}