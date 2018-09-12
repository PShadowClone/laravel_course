<?php


return [
    'service_account' => base_path() . '/storage/' . env('SERVICE_ACCOUNT_FIREBASE', null),
    'database_uri' => env('FIREBASE_DATABASE_URI')
];