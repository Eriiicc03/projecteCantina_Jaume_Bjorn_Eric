<?php

/*Funcio que carregar una llista de tots els producte*/
function carregarProductes(): array
{
    /*Accedim al contingut del fitxer*/
    $myfile = file_get_contents(__DIR__ . "/../data/productes.json");
    $arry = json_decode($myfile, true); //Convertim el JSON en una arry

    return $arry ?? []; //Si el JSON no es pot llegir, retornem una array buida.
}

/*Funcio que cerca per el id que ens indiqui l'usuari.
  Retorna el producte (array) o null si no el troba, per això el tipus és ?array */
function cercaPerID($id): ?array
{
    /*Accedim al contingut del fitxer*/
    $myfile = file_get_contents(__DIR__ . "/../data/productes.json");
    $arry = json_decode($myfile, true); //Convertim el JSON en una arry 

    foreach ($arry as $producte) { //Per cada producte de la arry
        if ($producte["id"] == $id) { //Si el id del producte es igual que al del parametre del usuari.
            return $producte; // retornarem el producte
        }
    }
    return null; // Si no el troba, retornem null

}

function calcularTotal(array $ticket): float
{
    $total = 0.0;
    foreach ($ticket as $producte) {
        $total += (float) $producte['preu'];
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

function preuFinal(array $producte): float
{
    // Si el producte no està en oferta, es cobra el preu normal
    if (empty($producte['oferta'])) {
        return $producte['preu'];
    }

    // Si està en oferta i té el camp "preu_oferta" al JSON, es cobra aquest preu
    if (!empty($producte['preu_oferta'])) {
        return $producte['preu_oferta'];
    }

    // Si està en oferta però no té "preu_oferta", apliquem un 20% de descompte.
    // Aquest return és obligatori: amb ": float" la funció sempre ha de retornar un número.
    return $producte['preu'] * 0.8;
}

function afegirAComanda($IdProducte): void
{
    $producte = cercaPerID($IdProducte);
    if ($producte === null) return; // Si el producte no existeix, no afegim res
    $producte['preu'] = preuFinal($producte);

    $_SESSION['comanda'][] = $producte;
}

function buidarComanda(): void
{
    unset($_SESSION['comanda']);
}

// Determina la franja horària per defecte segons l'hora actual (format 24h)
function obtenirFiltrePerHora(): string
{
    date_default_timezone_set('Europe/Madrid');
    $horaActual = (int) date('H');

    if ($horaActual >= 8 && $horaActual < 12) {
        return 'esmorzar'; // De 8:00 a 11:59
    } elseif ($horaActual >= 12 && $horaActual < 16) {
        return 'dinar';    // De 12:00 a 15:59
    } elseif ($horaActual >= 16 && $horaActual < 20) {
        return 'berenar';  // De 16:00 a 19:59
    }

    return 'tancat'; // De 20:00 a 07:59 la cantina està tancada
}

// Eliminar producte de la llista del carrito
function treureDeComanda($index)
{
    if (isset($_SESSION['comanda'][$index])) {
        unset($_SESSION['comanda'][$index]);
        $_SESSION['comanda'] = array_values($_SESSION['comanda']);
    }
}
