<?php

return [

    'vocations' => [
        1 => ['name' => 'Sorcerer', 'createable' => true],
        2 => ['name' => 'Druid', 'createable' => true],
        3 => ['name' => 'Paladin', 'createable' => true],
        4 => ['name' => 'Knight', 'createable' => true],
        5 => ['name' => 'Master Sorcerer', 'createable' => false],
        6 => ['name' => 'Elder Druid', 'createable' => false],
        7 => ['name' => 'Royal Paladin', 'createable' => false],
        8 => ['name' => 'Elite Knight', 'createable' => false],
    ],

    'client_download_url' => [
        'windows' => 'https://example.com/setup.exe',
        'linux' => '', // If there is no support for a platform, leave it blank.
        'mac' => '',
    ],

];
