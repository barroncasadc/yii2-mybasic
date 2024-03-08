<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_DRIVER').':host='.getenv('DB_HOST').';dbname='.getenv('DB_DATABASE').'',
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];