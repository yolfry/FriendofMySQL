<?php

/**
 * FriendOfMysql 2.4.0.
 * PHP Version =>7.4.x.
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

/* 
* Three parameters That can make magic $pass (password of the friendofmysql library ), $cmd (Command what you want to do), $data (The data if you are going to insert data if it is not left blank). 
*/

use Error;
use PDO;
use mysqli;




class FOM
{

  /*
    * Properties of data outputs | Return call
    */
  public  $res;
  public  static $active;
  public  $type = 'MySQLi_Object';

  /*
    * Conection DB:
    * MySQLi_Object
    * MySQLi_Procedural
    * PDO
    */


  /*
    * configuration by  Data Base name
    */
  public  $nameDB;
  public  $serverDB;
  public  $userDB;
  public  $passDB;
  public  $port = '3306';

  public  $fileQuery;
  public $connection;


  /* 
    * Example. $pass = friendofmysql , $cmd = insert_animals 
    * @param boolean $active  Enable error output
    */
  public function __construct($active = true)
  {
    error_reporting($active);
    FOM::$active = $active;
  }


  /* 
    * @param string $e  error message
    */
  public static function Error($e = 'Error')
  {
    try {
      throw new Error($e);
    } catch (Error $e) {
      if (FOM::$active)
        echo $e->getMessage();
    }
  }



  /*
    * Database connection
    */

  public function connection()
  {


    /* 
      * Conections  Config
      */

    $CONFIG['connection']['type'] = $this->type;
    /*
      * MySQLi_Object 
      * MySQLi_Procedural 
      * PDO
      */

    /*
      * configuration by  Data Base name 
      */

    $CONFIG['db']['name'][1] = $this->nameDB;


    /*
      * Configuration of the database
      */

    $CONFIG['db']['host'] = $this->serverDB;
    $CONFIG['db']['user'] = $this->userDB;
    $CONFIG['db']['pass'] = $this->passDB;

    $CONFIG['db']['port'] = $this->port;


    if (!empty($CONFIG['connection']['type'])) {

      switch ($CONFIG['connection']['type']) {

        case 'MySQLi_Object':
          /*
            * Connection of the database (MySQLi_Object) 
            */
          $connection = new mysqli($CONFIG['db']['host'], $CONFIG['db']['user'], $CONFIG['db']['pass'], $CONFIG['db']['name'][1], $CONFIG['db']['port']);
          if ($connection->connect_errno) {
            FOM::Error('Error of connection ' . $connection->connect_error);
            /*
              * Error of connection
              */
          }
          $this->connection = $connection;
          break;

        case 'MySQLi_Procedural':
          /*
            * Connection of the database (MySQLi_Procedural)
            */
          $connection = mysqli_connect($CONFIG['db']['host'], $CONFIG['db']['user'], $CONFIG['db']['pass'], $CONFIG['db']['name'][1], $CONFIG['db']['port']);
          if (!$connection) {
            $connection::close();

            FOM::Error('Error of connection ' . mysqli_connect_error());
            /*
              * Error of connection
              */
          }
          $this->connection = $connection;
          break;


        case 'PDO':
          /* 
            * Connection of the database (PDO)
            */
          $connection = new PDO("mysql:host=" . $CONFIG['db']['host'] . ";port=" . $CONFIG['db']['port'] . ";dbname=" . $CONFIG['db']['name'][1] . "", $CONFIG['db']['user'], $CONFIG['db']['pass']);
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->connection = $connection;
          break;

        default:
          FOM::Error("Error connection type (Driver), no exists, MySQLi_Object
          MySQLi_Procedural,
          PDO ");
          break;
      }
    } else {
      FOM::Error("Error connection  type");
    }
  }



  /*
    * @param string $cmd Query block name
    * @param array $data Data to send to the query block
    */

  public function sed($cmd = null, $data = null)
  {

    /*
      * connection and name of the database
      */
    $this->connection();

    $connection = $this->connection;

    /*
      * Var declare
      */
    $query = strip_tags($cmd);
    $file_query = strip_tags($this->fileQuery);


    /*
      * File Query Connect
      */

    /*
      * MySQL
      */

    if (!empty($query)) {

      if (file_exists($file_query)) {
        include $file_query;
      } else {
        FOM::Error("Error The query file does not exist");
      }
    } else {
      FOM::Error("Error The query command is not defined");
    }


    /*
      * Close connection
      */
    if ($this->type == "MySQLi_Object") {
      $this->connection = null;
    } else if ($this->type  == "MySQLi_Procedural") {
      $this->connection = null;
    } else if ($this->type  == "PDO") {
      $this->connection = null;
    }
  }

  public function __destruct()
  {
    isset($this);
  }
}
