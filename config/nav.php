<?php

return [
    [
        'name'=>'Dashboard',
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard.dashboard',
        'active'=>'dashboard.dashboard',
    ],

    [
        'name'=>'Categories',
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard.categories.index',
        'batch'=>'new',
        'active'=>'dashboard.categories.*'
    ]
]


?>
