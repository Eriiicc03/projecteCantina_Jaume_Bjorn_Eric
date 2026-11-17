export function canviaTema() {
    const html = document.documentElement;
    const themeButton = document.querySelector("#theme-toggle");
    themeButton.addEventListener("click", () => {
        const currentTheme = html.getAttribute("data-theme");
        const newTheme = currentTheme === "dark"
            ? "light"
            : "dark";
        html.setAttribute("data-theme", newTheme);
    });
}