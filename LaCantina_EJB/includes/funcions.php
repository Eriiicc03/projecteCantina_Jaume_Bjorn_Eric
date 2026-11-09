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

function cercaPerID($id) {
    $myfile = file_get_contents(__DIR__ . "/../data/productes.json");
    $arry = json_decode($myfile, true);

    foreach ($arry as $producte) {
        if ($producte["id"] == $id) {
            return $producte;
        }
    }
    echo ("El producte no hi es a la llista ");
    return 0;
    
}

/*Uso de la funcion por id:
$producte = cercaPerID(3);

if ($producte != null) {
    print_r($producte);
} else {
    echo "Producte no trobat";
}
*/ 

function calcularTotal() {}
function desarComanda() {}
function netejar() {}
