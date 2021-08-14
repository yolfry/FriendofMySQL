<?php

/**
 * FriendOfMysql 2.1.2.
 * PHP Version =>7.2.
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

namespace ypw;

/* Three parameters That can make magic $pass (password of the friendofmysql library ), $cmd (Command what you want to do), $data (The data if you are going to insert data if it is not left blank). */

use Error;
use PDO;
use mysqli;


class FOM
{

  /*properties of data outputs | Return call*/
  public static $res;
  public static $active;

  /*Conection DB*/
  public static $type;
  /*MySQLi_Object*/ /*MySQLi_Procedural*/  /*PDO*/

  //configuration by  Data Base name 
  public static $nameDB;
  public static $serverDB;
  public static $userDB;
  public static $passDB;
  public static $port;

  public static $fileQuery;

  /* 
  -------------------------------------------------
  Architecture
  -------------------------------------------------

 
  use YPW\FriendOfMysql\FriendofMySQL;

$fom = new FriendofMySQL(true);

$fom->type = 'MySQLi_Object';
$fom->serverDB ='localhost'; 
$fom->nameDB = 'mysql';
$fom->userDB = 'root';
$fom->passDB = '';
$fom->port = '3306';

$fom->fileQuery = 'appQuery.php';

$fom->sed('Query Get api Show');

echo $fom->res; 

  */



  /* example. $pass = friendofmysql , $cmd = insert_animals */
  public function __construct($active = true)
  {
    try {
      $this->active = $active;
    } catch (Error $e) {
      echo $e->getMessage(); /*Return error*/
    }
  }



  /*Database connection*/

  public function connection()
  {


    /* 
-------------------------
-   Conections  Config  -     
-------------------------
*/

    $CONFIG['connection']['type'] = $this->type;
    /*MySQLi_Object*/ /*MySQLi_Procedural*/  /*PDO*/

    //configuration by  Data Base name 
    $CONFIG['db']['name'][1] = $this->nameDB;


    //Configuration of the database
    $CONFIG['db']['host'] = $this->serverDB;
    $CONFIG['db']['user'] = $this->userDB;
    $CONFIG['db']['pass'] = $this->passDB;

    $CONFIG['db']['port'] = (!empty($this->port)) ? $this->port : null;



    if (!empty($CONFIG['connection']['type'])) {

      switch ($CONFIG['connection']['type']) {

        case 'MySQLi_Object':

          //Connection of the database (MySQLi_Object) 
          $connection = new mysqli($CONFIG['db']['host'], $CONFIG['db']['user'], $CONFIG['db']['pass'], $CONFIG['db']['name'][1], $CONFIG['db']['port']);

          try {

            if ($connection->connect_errno) {
              throw new Error('Error of connection' . $connection->connect_error);
              /*Error of connection*/
            }
          } catch (Error $e) {
            echo $e->getMessage();
          }

          break;

        case 'MySQLi_Procedural':
          //Connection of the database (MySQLi_Procedural)
          $connection = mysqli_connect($CONFIG['db']['host'], $CONFIG['db']['user'], $CONFIG['db']['pass'], $CONFIG['db']['name'][1], $CONFIG['db']['port']);

          if (!$connection) {
            $connection::close();
            die("Error of connection:" . mysqli_connect_error());
            /*Error of connection*/
          }

          break;


        case 'PDO':
          //Connection of the database (PDO)
          $connection = new PDO("mysql:host=" . $CONFIG['db']['host'] . ";port=" . $CONFIG['db']['port'] . ";dbname=" . $CONFIG['db']['name'][1] . "", $CONFIG['db']['user'], $CONFIG['db']['pass']);
          try {
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch (Error $e) {
            echo $e->getMessage();
          }
          break;


        default:
          echo "Error connection type, no exists";
          break;
      }
    } else {
      echo "Error connection  type";
    }
  }



  public function sed($cmd = null)
  {
    try {

      //connection and name of the database
      $this->connection();

      /*Var declare*/
      $query = strip_tags($cmd); //Data entry security protection
      $file_query = strip_tags($this->fileQuery);


      //File Query Connect

      /*MySQL*/
      if (!empty($query)) {

        if (file_exists($file_query)) {
          include_once($file_query);
        } else {
          throw new Error("Error The query file does not exist");
        }
      } else {
        throw new Error("Error The query command is not defined");
      }


      /*Close connection*/
      if ($CONFIG['connection']['type'] == "MySQLi_Object") {
        $connection->close();
      } else if ($CONFIG['connection']['type'] == "MySQLi_Procedural") {
        mysqli_close($connection);
      } else if ($CONFIG['connection']['type'] == "PDO") {
        $connection = null;
      }
    } catch (Error $e) {
      echo $e->getMessage(); /*Return error*/
    }
  }

  public function __destruct()
  {
    isset($this); /*Delete objet "this" */
  }
}

#by yolfry
