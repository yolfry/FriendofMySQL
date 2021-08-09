# Friend of MySQL

![myimage-alt-tag](https://lh6.googleusercontent.com/rvIkMVD_oDTpDaJSovemeBDuWe4CDFgiQzkB1c5i7A2ZoCJkkTL1eOGETWMz8idygwlLILsBuyNJ6w=w1920-h885-rw)

***Friend of MySQL is a simple php framework, which allows you to synchronize in an organized and structured way the queries to the MySQL database.***

This Framework was developed for the applications and web platform in MVC, that is, model, view, controller.


This one focuses on the wall of the Model -> Backend. In this way it manages to organize the queries sent to the database,
through an object-oriented programming (OOP).




## Friend of MySQL 2.0.0 V ##
NEW **Implementation control of properties and methods**
* Composer support
* Dynamic query file path
* Mysql ports
* Dynamic Mysql configuration


## Friend of MySQL 1.0.3 V ##
NEW **Implementation control of properties and methods**
* query/complement/Add_property_and_methods.php


## Friend of MySQL 1.0.2 V ##

NEW **Connection type settings added**

* PDO

* MySQLi Procedural

* MySQLi Object-Oriented

## Installation ##


```
composer require ypw/friendofmysql

```



## Setting ##

To use this library, you need to create a query file called "queryApp" to store all the application's queries.


> queryApp.php

```

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

    $this->callback = $table;/*return parameter*/
    break;

    #Insert Animals
  case 'insert_animals':
    $sql = "INSERT INTO `animals`(`id_animals`, `name`) VALUES ('','" . $data['name'] . "')";
    if (!$connection->query($sql)) {
      $this->callback = false;
    }
    $this->callback = true;
    break;

  default:
    $this->callback = false;
    break;
}



```


> api.php


```
use YPW\FriendOfMysql\FriendofMySQL;

$fom = new FriendofMySQL(true);

$fom->type = 'MySQLi_Object';
$fom->serverDB ='localhost'; 
$fom->nameDB = 'mysql';
$fom->userDB = 'root';
$fom->passDB = '';
$fom->port = '3306';

$fom->fileQuery = 'queryApp.php';

$fom->sed('consul_animals');

echo $fom->res;
````




**©202021 YOLFRY BAUTISTA REYNOSO | YOLFRI1997@HOTMAIL.COM**
