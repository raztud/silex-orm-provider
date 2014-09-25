# Doctrine ORM Service Provider for Silex
This provider sets up Doctrine ORM for Silex.

Summary:
*   [Installation](#installation)
*   [Configuration](#configuration)
*   [Usage](#usage)

## Installation
TODO

## Configuration
First of all you should have the Doctrine DBAL connection configured. For more information about configuring the DoctrineServiceProvider, I'd recommend reading [this page of the Silex documentation](http://silex.sensiolabs.org/doc/providers/doctrine.html).

Registering the Doctrine ORM Service Provider is rather straight forward:

```php
<?php

/* ... */

$app->register(new Raztud\Provider\DoctrineORMServiceProvider(), array(
    'db.connection' => $app['db'],
    'db.is_dev_mode' => false, 
    'db.orm.entities_paths'  => array(__DIR__ . '/../src/MyProject/Entity')
));

/* ... */

```

OR 

```php
<?php

/* ... */

$app->register(new Raztud\Provider\DoctrineORMServiceProvider(), array(
    'db.connection' => array(
        'driver'   => 'pdo_mysql',
        'user'     => '<USERNAME>',
        'password' => '<PASSWORD>',
        'dbname'   => '<DATABASE>',
    ),
    'db.is_dev_mode' => false, 
    'db.orm.entities_paths'  => array(__DIR__ . '/../src/MyProject/Entity')
));

/* ... */

```

## Usage
You can access the EntityManager by calling ``$app['db.doctrine.em']``.
