<?php /*namespace friendofmysql;*/
/*FriendofMySQL 1.0.2*/

/*  Three parameters That can make magic $pass (password of the friendofmysql library ), $cmd (Command what you want to do), $data (The data if you are going to insert data if it is not left blank). */




class FriendofMySQL{

/*properties of data outputs | Return call*/
public $callback;

                /* example. $pass = friendofmysql , $cmd = insert_animals */
public function __construct($pass,$cmd,$data=""){

      try{   
  

                //connection and name of the database
                include("bin/connection"); /*batch connection*/

                $pass = strip_tags($pass); $query = strip_tags($cmd); //Data entry security protection

                if($pass ="root" /* <- You can change this password*/ && ! empty($connection)){
               
                
                  $file="query/query.php";
                  include "MySQL.dll";


                  /*Close connection*/
                  if($CONFIG['connection']['type']=="MySQLi_Object"){
                    $connection->close();
                  }else if($CONFIG['connection']['type']=="MySQLi_Procedural"){
                    mysqli_close($connection);
                  }else if($CONFIG['connection']['type']=="PDO"){
                    $connection = null;
                  }

                 }
                 else
                 {

                    throw new Exception('<br> 200 Error of clases');/*200 Error of clases*/
                 }



        }catch(Exception $e){

            echo $e->getMessage(); /*Return error*/

        }

              
}

                   public function __destruct(){
                   return true;
      
                  }


}

#by yolfry


?>
