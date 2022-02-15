<?php 

return [ 
    'client_id' => env('PAYPAL_CLIENT_ID','AZR8hLRpmE4st9mF0yAH7uLs8OwAh8vuUKNu1sGCkvr_95Sr_m34NFKxGK0IlUw_8SfafXw7IKcF4_1u'),
    'secret' => env('PAYPAL_SECRET','EFQWaoIk03r2wjjpVJjWejtSx0ImNFYFKinwYGQ2SxikBeoOK3fXdsVMKKJVCGGgbIvP8rXVwqMy15Tp'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR',
        'no_shipping'=>0
        
    ),
];