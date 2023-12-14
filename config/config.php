<?php
return [
    'logo' => [
        'name' => 'logo.jpg',

    ],

    'time' => [
        '8:00 am' => '8:00 am',
        '8:15 am' => '8:15 am',
        '8:30 am' => '8:30 am',
        '8:45 am' => '8:45 am',
        '9:00 am' => '9:00 am',
        '9:15 am' => '9:15 am',
        '9:30 am' => '9:30 am',
        '9:45 am' => '9:45 am',
        '10:00 am' => '10:00 am',
        '10:15 am' => '10:15 am',
        '10:30 am' => '10:30 am',
        '10:45 am' => '10:45 am',
        '11:00 am' => '11:00 am',
        '11:15 am' => '11:15 am',
        '11:30 am' => '11:30 am',
        '11:45 am' => '11:45 am',
        '12:00 pm' => '12:00 pm',
        '12:15 pm' => '12:15 pm',
        '12:30 pm' => '12:30 pm',
        '12:45 pm' => '12:45 pm',
        '1:00 pm' => '1:00 pm',
        '1:15 pm' => '1:15 pm',
        '1:30 pm' => '1:30 pm',
        '1:45 pm' => '1:45 pm',
        '2:00 pm' => '2:00 pm',
        '2:15 pm' => '2:15 pm',
        '2:30 pm' => '2:30 pm',
        '2:45 pm' => '2:45 pm',
        '3:00 pm' => '3:00 pm',
        '3:15 pm' => '3:15 pm',
        '3:30 pm' => '3:30 pm',
        '3:45 pm' => '3:45 pm',
        '4:00 pm' => '4:00 pm',
        '4:15 pm' => '4:15 pm',
        '4:30 pm' => '4:30 pm',
        '4:45 pm' => '4:45 pm',
        '5:00 pm' => '5:00 pm',
        '5:15 pm' => '5:15 pm',
        '5:30 pm' => '5:30 pm',
        '5:45 pm' => '5:45 pm',
        '6:00 pm' => '6:00 pm',
        '6:15 pm' => '6:15 pm',
        '6:30 pm' => '6:30 pm',
        '6:45 pm' => '6:45 pm',
        '7:00 pm' => '7:00 pm',
        '7:15 pm' => '7:15 pm',
        '7:30 pm' => '7:30 pm',
        '7:45 pm' => '7:45 pm',
        '8:00 pm' => '8:00 pm',
        '8:15 pm' => '8:15 pm',
        '8:30 pm' => '8:30 pm',
        '8:45 pm' => '8:45 pm',
        '9:00 pm' => '9:00 pm',
        '9:15 pm' => '9:15 pm',
        '9:30 pm' => '9:30 pm',
        '9:45 pm' => '9:45 pm',
        '10:00 pm' => '10:00 pm',
    ],
 

    'CakePdf' => [
        'engine' => 'CakePdf.Mpdf',
        'margin' => [
            'bottom' => 15,
            'left' => 10,
            'right' => 15,
            'top' => 10,
        ],
        //'orientation' => 'landscape',
        'download' => false
    ],

    'DebugKit' => [
        'panels' => [
            'TinyAuth.Auth' => true,
        ],
    ],

    'TinyAuth' => [
        'multiRole' => true,
        'superAdminRole' => 1,
        'pivotTable'=>'roles_users'
    ],

    'currency' => [
        'USD' => 'USD',
        'CAD' => 'CAD',

    ],
];
