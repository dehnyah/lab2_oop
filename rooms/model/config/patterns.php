<?php
$patterns = [
    
    
    'phone-ukr'=> [
        'regex' => '/^[0-9]{10}$/',
        'callback' => function ($matches) { 
            printme($matches); 
            $string = $matches[0];

            return '+38' .$string;
        }
    ],

    'surname' => [ 
        'regex' => '/^([A-Z]{1}[a-z]{1,23})$/' 
    ],
    
    'email' => [ 
        'regex' => '/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/'
    ]
    

    
];
