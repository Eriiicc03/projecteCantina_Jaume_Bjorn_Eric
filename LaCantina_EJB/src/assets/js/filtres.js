
// Gestiona el filtratge dels productes del catàleg segons la franja seleccionada
export function mostrarFiltres() {
    const menuNav = document.querySelector(".filtres");
    const productes = document.querySelectorAll(".productes .producte");

    if (!menuNav) return; // Si no troba l'atribut torna per evitar errors de notFound.

    menuNav.addEventListener("click", (e) => {
        let seleccionat = e.target.closest("button"); // Botó de filtre clicat

        if (!seleccionat) return; // Evita errors si es clica fora d'un botó

        let actiu = document.querySelector(".actiu"); // Filtre que està actiu actualment
        if (actiu) {
            actiu.classList.remove("actiu");
        }
        seleccionat.classList.add("actiu"); // Marca el botó clicat com a actiu

        // Bucle per recórrer tots els productes i mostrar només els de la categoria triada
        productes.forEach(producte => {
            if (seleccionat.id !== "tot" && !producte.classList.contains(seleccionat.id)) {
                producte.classList.add("ocult"); // Amaguem el producte
            } else {
                producte.classList.remove("ocult"); // Mostrem el producte
            }
        });
    });
}