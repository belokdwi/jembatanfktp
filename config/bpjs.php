<?php

return [
    'cons_id' => env('BPJS_CONS_ID'), // consumer ID dari BPJS Kesehatan
    'secret_key' => env('BPJS_SECRET_KEY'), // consumer secret key
    'username' => env('BPJS_USERNAME'), // username pcare
    'password' => env('BPJS_PASSWORD'), // password pcare
    'user_key' => env('BPJS_USER_KEY'), // user_key untuk akses webservice
    'app_code' => env('BPJS_APP_CODE', '095'), // kode aplikasi
    'base_url' => env('BPJS_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id'), // base url aplikasi
];
