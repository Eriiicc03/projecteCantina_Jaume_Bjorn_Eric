<?php
function carregarProductes() {
    
    $myfile = file_get_contents(__DIR__ . "/../data/productes.json");
    $arry = json_decode($myfile, true);
    $noms=[];

    foreach ($arry as $element) {
       $noms[] = $element["nom"];
    }
    return $noms;
}
print_r(carregarProductes());

function calcularTotal() {}
function desarComanda() {}
function netejar() {}
