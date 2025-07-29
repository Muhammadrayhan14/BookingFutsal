<?php

return [
    'serverKey'     => env('MIDTRANS_SERVER_KEY'),
    'clientKey'     => env('MIDTRANS_CLIENT_KEY'),
    'isProduction'  => false, // tetap false karena masih sandbox
    'isSanitized'   => true,
    'is3ds'         => true,
];

