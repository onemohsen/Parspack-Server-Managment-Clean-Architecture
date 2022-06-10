<?php

return [

    /*
    |
    | General Settings
    |
    */

    'api' => [
        'grant_type' => env('PARSPACK_GRANT_TYPE') ?? 'password',
        'client_id' => env('PARSPACK_CLIENT_ID') ?? '2',
        'client_secret' => env('PARSPACK_CLIENT_SECRET') ?? 'L8erqTADUWRjv8TsAVWjlkSn2abyIekuK6mcgJV2',
    ],
];
