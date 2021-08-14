# Friend of MySQL

![myimage-alt-tag](https://i.ibb.co/kX8n3Y2/friendof-My-SQL-text.png)

**_Friend of MySQL is a simple php framework, which allows you to synchronize in an organized and structured way the queries to the MySQL database._**

This Framework was developed for the applications and web platform in MVC, that is, model, view, controller.

This one focuses on the wall of the Model -> Backend. In this way it manages to organize the queries sent to the database,
through an object-oriented programming (OOP).


## Friend of MySQL 2.3.0 V

- Prop Statis

## Friend of MySQL 2.2.0 V

- Set Data, push Query $data

## Friend of MySQL 2.1.2 V

- Autoload Update

## Friend of MySQL 2.1.1 V

- README Edit

## Friend of MySQL 2.1.0 V

- Composer Autoload
- class FOM namespace ypw



## Friend of MySQL 2.0.0 V

NEW **Implementation control of properties and methods**

- Composer support
- Dynamic query file path
- Mysql ports
- Dynamic Mysql configuration

## Friend of MySQL 1.0.3 V

NEW **Implementation control of properties and methods**

- query/complement/Add_property_and_methods.php

## Friend of MySQL 1.0.2 V

NEW **Connection type settings added**

- PDO

- MySQLi Procedural

- MySQLi Object-Oriented

## Installation

```json
"ypw/friendofmysql": "^2.1"
```

or run

```sh
composer require ypw/friendofmysql

```

## Setting

To use this library, you need to create a query file called "queryApp" to store all the application's queries.

> queryApp.php

```php

<?php

switch ($cmd) {

    #Select Animals
  case 'consul_animals':
    $sql = "SELECT * FROM animals";
    $datos = $connection/*connection parameter*/->query($sql);
    $animals = array();
    $table = array();
    $i = 0;

    while ($animals = $datos->fetch_array(MYSQLI_BOTH)) {
      $table[$i]['id_animals'] = strip_tags($animals['id_animals']);
      $table[$i]['name'] = strip_tags($animals['name']);

      $i++;
    }

    $this->res = $table;/*return parameter*/
    break;

    #Insert Animals
  case 'insert_animals':
    $sql = "INSERT INTO `animals`(`id_animals`, `name`) VALUES ('','" . $data['name'] . "')";
    if (!$connection->query($sql)) {
      $this->res = false;
    }
    $this->res = true;
    break;

  default:
    $this->res = false;
    break;
}



```

> api.php

```php

use ypw\FOM;

include_once "./vendor/autoload.php";

$FOM = new FOM(true);

$FOM->type = 'MySQLi_Object';
$FOM->serverDB ='localhost';
$FOM->nameDB = 'mysql';
$FOM->userDB = 'root';
$FOM->passDB = '';
$FOM->port = '3306';

$FOM->fileQuery = __DIR__ ."/queryApp.php";

$FOM->sed('consul_animals',null);

echo $FOM->res;
```

**©2021 YOLFRY BAUTISTA REYNOSO | YOLFRI1997@HOTMAIL.COM**
