export function showBurger() {
    let burger = document.querySelector("#burgerBtn");
    burger.addEventListener("click", function(){
        let menu = document.querySelector(".menu");
        menu.style.display = "none";
        burger.innerHTML("X");
    });
}