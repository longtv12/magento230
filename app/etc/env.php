<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'db' => [
        'connection' => [
            'indexer' => [
                'host' => 'localhost',
                'dbname' => 'magento230',
                'username' => 'admin',
                'password' => 'admin1234',
                'active' => '1',
                'persistent' => NULL
            ],
            'default' => [
                'host' => 'localhost',
                'dbname' => 'magento230',
                'username' => 'admin',
                'password' => 'admin1234',
                'active' => '1'
            ]
        ],
        'table_prefix' => ''
    ],
    'crypt' => [
        'key' => 'd9b41ba06d0a6732fd87624a9d7cf5ba'
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'target_rule' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1
    ],
    'install' => [
        'date' => 'Fri, 12 Apr 2019 10:12:10 +0000'
    ]
];
