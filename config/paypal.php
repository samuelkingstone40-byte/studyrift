<?php 

return [ 
    'client_id' => env('PAYPAL_CLIENT_ID','AVQZaJNGJXrEqXf_0TS_3VnG51Sgdc6s5K11YMkkVfaSqvlYw-2XC1XabNWJhlNa0stWsgU-rC7NFyrl'),
    'secret' => env('PAYPAL_SECRET','EN9TsEqUVPxyjMLiAA1dGhULCfNx4deYS_6_YRVR8BEGJo8syllPsWqfGFDWCIPKWHHr9z_nS9MYTmlk'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR',
        'no_shipping'=>0
        
    ),
];