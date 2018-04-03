<?php /*box query  

Parameters:
($connection)       #connection of the database. (MySQLi_Object),(MySQLi_Procedural),(PDO)
($data)             #data sent from the implementation.
($this->callback)   #Result of return: false, true or data.      These are the utility parameters*/




/* first box query->consul_animals */
if($cmd =="consul_animals"){

                                  $sql ="SELECT * FROM animals";
                                  $datos = $connection/*connection parameter*/->query($sql);
                                  $animals = array();
                                  $table = array();
                                  $i=0;
                            
                                  while($animals = $datos->fetch_array(MYSQLI_BOTH)){
                                  $table[$i]['id_animals'] = strip_tags($animals['id_animals']);
                                  $table[$i]['name'] = strip_tags($animals['name']);
                                  
                                  $i++;                      
                                            
                                 }
                            
                                 $this->callback = $table;/*return parameter*/
                                
                           }










/*second box query -> insert_animals*/
if($cmd =="insert_animals"){
                          

                           $sql = "INSERT INTO `animals`(`id_animals`, `name`) VALUES ('','".$data['name']."')";
                           if(!$connection->query($sql)){ 
                             $this->callback="false";
                           }
 
                            $this->callback="true"; 
      
}

  
