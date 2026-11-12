export function mostrarFiltres() {
    let entrepans = document.querySelector("#entrepans");
    entrepans.addEventListener("click", () => {
        let entrepans = document.querySelector("#entrepans");
        entrepans.classList.toggle("active");
    });
}