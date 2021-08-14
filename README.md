# Friend of MySQL

![myimage-alt-tag](https://i.ibb.co/kX8n3Y2/friendof-My-SQL-text.png)

**_Friend of MySQL is a simple php library, which allows you to synchronize in an organized and structured way the queries to the MySQL database._**

This library was developed for applications and servers in MVC, API.

This one focuses on the wall of the Model -> Backend. In this way it manages to organize the queries sent to the database,
through an object-oriented programming (OOP).

## Friend of MySQL 2.4.0 V

- The library code was organized
- Fixed error when including the query App file more than 2 times
- Prepared queries
- Show error
- Try Catch Object

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
"ypw/friendofmysql": "^2.4"
```

or run

```sh
composer require ypw/friendofmysql

```

## Setting

To use this library, you need to create a query file called "queryApp" to store all the application's queries.

> queryApp.php

> Query file structure "queryApp.php"

```php

<?php

/**
 * FriendOfMysql.
 * PHP Version =>7.4.
 *
 * @see https://github.com/yolfry/FriendOfMysql/ The FriendOfMysql GitHub project
 *
 * @author    yolfry (ypw) <yolfri1997@hotmail.com>
 * @copyright 2015 - 2021 yolfry
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */



/*
 * QueryApp structure
 * */

/*
* Input variables that the query block receives:
*
* $cmd           Command to select the query on the switch
* $connection    Object variable, which contains the structure of the connection
* $data          Array containing the data to send by the query
*/


/*
*   @param string $cmd Query block name
*/


try {
    switch ($cmd) {

            /* 
            * * * * *  * * * * * * * * * * * 
            *          Insert user         *
            * * * * * * * * * * * * * * * * *
            */

        case 'insertUser':
            $sql = "INSERT INTO `user` (name) VALUES(?);";

            if (!($sentencia = $connection->prepare($sql))) {
                throw new Exception("Preparation failed: (" . $connection->errno . ") " . $connection->error);
            }

            if (!$sentencia->bind_param("s", $data['name'])) {
                throw new Exception("Parameter binding failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }

            if (!$sentencia->execute()) {
                throw new Exception("Execution failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }

            $sentencia->close();

            $this->res = true;
            break;

            /* 
            * * * * *  * * * * * * * * * * * 
            *         Select user          *
            * * * * * * * * * * * * * * * * *
            */
        case 'selectUser':

            $sql = "SELECT * FROM `user`";

            if (!($sentencia = $connection->prepare($sql))) {
                throw new Exception("Preparation failed: (" . $connection->errno . ") " . $connection->error);
            }

            if (!$sentencia->execute()) {
                throw new Exception("Execution failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }

            $datos = $sentencia->get_result();

            $field = array();
            $table = array();
            $i = 0;

            while ($field = $datos->fetch_array(MYSQLI_BOTH)) {
                $table[$i]['userID'] = strip_tags($field['userID']);
                $table[$i]['name'] = strip_tags($field['name']);
                $i++;
            }

            $sentencia->close();

            $this->res = $table;/*return parameter*/
            break;

        default:
            $this->res = false;
            break;
    }
} catch (\Throwable $e) {
    echo $e->getMessage();
    $this->res = false;
}




```

> api.php

```php

use ypw\FOM;

include_once "./vendor/autoload.php";

$FOM = new FOM(true);

$FOM->type = 'MySQLi_Object';
$FOM->serverDB ='127.0.0.1';
$FOM->nameDB = 'system';
$FOM->userDB = 'root';
$FOM->passDB = '123456789';
$FOM->port = '3306';

$FOM->fileQuery = __DIR__ ."/queryApp.php";


$data['name'] = 'Alejandro';
$FOM->sed('insertUser',$data);


if($FOM->res){
    echo "\n Registered user";
}else
{
    echo "\n Unregistered user";
}

/*
* sed 2, Select User and print
*/


$FOM->sed('selectUser');

if($FOM->res){
    echo json_encode($FOM->res);
}else{
    echo "\n Unable to select user user";
}


```

©2021 YOLFRY BAUTISTA REYNOSO . yolfri1997@hotmail.com . YPW
