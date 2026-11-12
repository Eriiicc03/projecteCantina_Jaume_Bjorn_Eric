<?php

/*Funcio que carregar una llista de tots els producte*/
function carregarProductes()
{
    /*Accedim al contingut del fitxer*/
    $myfile = file_get_contents(__DIR__ . "/../data/productes.json");
    $arry = json_decode($myfile, true); //Convertim el JSON en una arry associoatiu (TRUE)

    return $arry; //Finalment retornem el resultat que volem que es mostri.
}

/*Funcio que cerca per el id que ens indiqui l'usuari*/
function cercaPerID($id)
{
    /*Accedim al contingut del fitxer*/
    $myfile = file_get_contents(__DIR__ . "/../data/productes.json");
    $arry = json_decode($myfile, true); //Convertim el JSON en una arry associoatiu (TRUE)

    foreach ($arry as $producte) { //Per cada producte de la arry
        if ($producte["id"] == $id) { //Si el id del producte es igual que al del parametre del usuari.
            return $producte; // retornarem el producte
        }
    }
    echo ("El producte no hi es a la llista "); //Si no troba es ho indicara.
    return 0; // Retornara un 0

}

/*Uso de la funcion por id:
$producte = cercaPerID(3);

if ($producte != null) {
    print_r($producte);
} else {
    echo "Producte no trobat";
}
*/

function calcularTotal(array $ticket): float
{
    $total = 0.0;

    foreach ($ticket as $id => $quantitat) {
        $quantitat = (int) $quantitat;
        if ($quantitat <= 0) {
            continue;
        }

        $producte = cercaPerID($id);
        if (!is_array($producte)) {
            continue;
        }

        $total += (float) $producte['preu'] * $quantitat;
    }
    return round($total, 2);
}

function desarComanda(array $dades): bool
{
    $dades['data'] = date('Y-m-d H:i:s');

    $linia = json_encode($dades, JSON_UNESCAPED_UNICODE);
    if ($linia === false) {
        return false;
    }

    $resultat = file_put_contents(
        __DIR__ . '/../data/comandes.txt',
        $linia . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );

    return $resultat !== false;
}
function netejar() {}
