<?php
// Si algú intenta accedir dona error.
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    http_response_code(403);
    exit('Acceso denegado');
}

return [
    ['usuario' => 'admin', 'password' => '1234'],
];
