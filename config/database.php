<?php

return [
    'default'=>'database1' ,
    'connections' =>[
        'database1' =>[
            'driver'=>'sqlite',
            'database'=>'/mts.sqlite'
        ] ,
        'database2' =>[
            'driver'=>'mysql',
            'host'=>'127.0.0.1',
            'database'=>'unit_test',
            'username'=>'root',
            'password'=>'0000',
        ]
    ]
];