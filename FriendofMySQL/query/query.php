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








/* 1.0.2 V
Example red


if($cmd =="login"){


  $user = $connection->real_escape_string( $data['user']);
  $password = $connection->real_escape_string($data['password']);

                             $sql ="SELECT * FROM user WHERE user='$user' AND password='$password'";
                                                        
                                                         $datos = $connection->query($sql);
                                                         $login= array();
                                                         $table = array();

                            $login = $datos->fetch_array(MYSQLI_BOTH);
                                                       
                            if($login['user'] == $user && $login['password'] == $password){

                              $sql ="SELECT * FROM employee WHERE id_employee='".$login['id_employee']."'";
                              $account = $connection->query($sql);
                              $row = $account -> fetch_array(MYSQLI_BOTH);


                              $table['result']="true";
                              $table['id_user']=$login['id_user'];
                              $table['rank']=$login['rank'];

                                                         //Empleado
                             $table['name']=$row['name'];
                             $table['last_name']=$row['last_name'];
                             $table['date_of_birth']=$row['date_of_birth'];

                             $this->callback =$table;
                            }
                            else
                            {
                              $table['result'] = "false";
                              $this->callback =$table;

                            }
                            
                                                         
                            return true;     

}




/* first box query->consul_animals 
if($cmd =="consul_system"){

  $sql ="SELECT * FROM system";
  if($callback_query = $connection->query($sql)){

    $row = $callback_query-> fetch_array(MYSQLI_BOTH);

                             $table['id_system']=$row['id_system'];
                             $table['name']=$row['name'];
                             $table['id_name']=$row['id_name'];
                             $table['rnc']=$row['rnc'];
                             $table['phone']=$row['phone'];
                             $table['president']=$row['president'];
                             $table['logo']=$row['logo'];
                             $table['favicon']=$row['favicon'];
                             $table['code']=$row['code'];
                             $table['server_name']=$row['server_name'];
                             $table['title']=$row['title'];
                             $table['slogan']=$row['slogan'];
                             $table['lang']=$row['lang'];
                             $table['date_of_origin']=$row['date_of_origin'];
                             $table['published_by']=$row['published_by'];
                             $table['country']=$row['country'];
                             $table['email']=$row['email'];
                             $table['developer_number']=$row['developer_number'];
                             $table['server_charset']=$row['server_charset'];
                             $this->callback =$table;
  

                             
                                
                           }
                           else
                           {
                             $this->callback=false;
                           }

  }




  /*Insert Slide
  if($cmd =="insert_slide"){

    $data['id_product'] = $connection->real_escape_string($data['id_product']);
    $data['url'] = $connection->real_escape_string($data['url']);
    $data['image'] = $connection->real_escape_string($data['image']);
    $data['presentation'] = $connection->real_escape_string($data['presentation']);
    $data['id_user'] = $connection->real_escape_string($data['id_user']);
    $data['date'] = $connection->real_escape_string($data['date']);
    $data['title'] = $connection->real_escape_string($data['title']);
    $data['content'] = $connection->real_escape_string($data['content']);
    $data['active'] = $connection->real_escape_string($data['active']);
    

    $sql = "INSERT INTO `slide`(`id_slide`, `id_product`, `url`, `image`, `presentation`, `id_user`, `date`, `title`, `content`,`active`) VALUES ('','".$data['id_product']."','".$data['url']."','".$data['image']."','".$data['presentation']."','".$data['id_user']."','".$data['date']."','".$data['title']."','".$data['content']."','".$data['active']."')";
    if(!$connection->query($sql)){
    $this->callback=false;
    }

    $this->callback=true;
  }



/*Actualizar slide*
  if($cmd=="update_slide"){

    $data['title'] = $connection->real_escape_string($data['title']);
    $data['content'] = $connection->real_escape_string($data['content']);
    $data['id_slide'] = $connection->real_escape_string($data['id_slide']);
    $data['url'] = $connection->real_escape_string($data['url']);
    $data['active'] = $connection->real_escape_string($data['active']);
    $data['presentation'] = $connection->real_escape_string($data['presentation']);
    $data['user_modification'] = $connection->real_escape_string($data['user_modification']);
    $data['date_modification'] = $connection->real_escape_string($data['date_modification']);


            $sql = "UPDATE `slide` SET title ='".$data['title']."' ,  `content` = '".$data['content']."' , url='".$data['url']."' , date_modification='".$data['date_modification']."' , user_modification ='".$data['user_modification']."' , presentation='".$data['presentation']."' , active='".$data["active"]."' WHERE `slide`.`id_slide` =".$data['id_slide']."";
            if(!$connection->query($sql)){
            $this->callback=false;
            }
        
            $this->callback=true;


  }




  #select slide
  if($cmd =="select_slide"){


    $sql ="SELECT * FROM slide  ORDER BY id_slide DESC";
    if($callback_query = $connection->query($sql)){
  
                           $i=0;
                           while($row = $callback_query-> fetch_array(MYSQLI_BOTH)){
                            
                               $table[$i]['id_slide']=$row['id_slide'];
                               $table[$i]['id_product']=$row['id_product'];
                               $table[$i]['url']=$row['url'];
                               $table[$i]['image']=$row['image'];
                               $table[$i]['presentation']=$row['presentation'];
                               $table[$i]['id_user']=$row['id_user'];
                               $table[$i]['date']=$row['date'];
                               $table[$i]['title']=$row['title'];
                               $table[$i]['content']=$row['content'];
                               $table[$i]['active']=$row['active'];
                          
                           $i++;

                           }
                               
                              $this->callback =$table;
                               
                                  
                           }
                           else
                           {
                              $this->callback=false;
                           }
  
    }

    /*delete slide*
    if($cmd =="delete_slide"){

    $sql ="DELETE FROM `slide` WHERE id_slide=".$data['id'];
    if(!$connection->query($sql)){
    $this->callback=false;
    }

    $this->callback=true;

    }



    /*select_slide_id*
    if($cmd =="select_slide_id"){

      
    $sql ="SELECT * FROM slide WHERE id_slide=".$data['id'];
    if($callback_query = $connection->query($sql)){
  
                          
                           $row = $callback_query-> fetch_array(MYSQLI_BOTH);
                           $table['id_slide']=$row['id_slide'];
                           $table['id_product']=$row['id_product'];
                           $table['url']=$row['url'];
                           $table['image']=$row['image'];
                           $table['presentation']=$row['presentation'];
                           $table['id_user']=$row['id_user'];
                           $table['date']=$row['date'];
                           $table['title']=$row['title'];
                           $table['content']=$row['content'];
                           $table['active']=$row['active'];
                          
                               
                           $this->callback =$table;
                               
                                  
                           }
                           else
                           {
                              $this->callback=false;
                           }





    }
   






  /*Insert Day*
  if($cmd =="insert_day"){
    
    $data['day'] = $connection->real_escape_string($data['day']);
    $data['title'] = $connection->real_escape_string($data['title']);
    $data['content'] = $connection->real_escape_string($data['content']);
    $data['deadline_date'] = $connection->real_escape_string($data['deadline_date']);
    $data['registration_date'] = $connection->real_escape_string($data['registration_date']);

    $data['id_user'] = $connection->real_escape_string($data['id_user']);
    /*$data['user_modification'] = $connection->real_escape_string($data['user_modification']);
    $data['date_modification'] = $connection->real_escape_string($data['date_modification']);*
    $data['image'] = $connection->real_escape_string($data['image']);
    $data['group_product_id'] = $connection->real_escape_string($data['group_product_id']);
    $data['url'] = $connection->real_escape_string($data['url']);
    
    $sql = "INSERT INTO `day`(`id_day`, `day`, `title`, `content`, `deadline_date`, `registration_date`, `id_user`, `user_modification`,`date_modification`, `image`, `group_product_id`, `url`) VALUES ('','".$data['day']."','".$data['title']."','".$data['content']."','".$data['deadline_date']."','".$data['registration_date']."','".$data['id_user']."','NULL','NULL','".$data['image']."','".$data['group_product_id']."','".$data['url']."')";
    if(!$connection->query($sql)){
    $this->callback=false;
    }

    $this->callback=true;

  }



/* first box query->select_day *
if($cmd =="select_day"){

  $sql ="SELECT * FROM day ORDER BY id_day DESC";

   if($callback_query = $connection->query($sql)){

                    $i=0;

                  while($row = $callback_query -> fetch_array(MYSQLI_BOTH) ){

                    $table[$i]['id_day']=$row['id_day'];
                    $table[$i]['day']=$row['day'];
                    $table[$i]['title']=$row['title'];
                    $table[$i]['content']=$row['content'];
                    $table[$i]['deadline_date']=$row['deadline_date'];
                    $table[$i]['registration_date']=$row['registration_date'];
                    $table[$i]['id_user']=$row['id_user'];
                    $table[$i]['user_modification']=$row['user_modification'];
                    $table[$i]['date_modification']=$row['date_modification'];
                    $table[$i]['image']=$row['image'];
                    $table[$i]['group_product_id']=$row['group_product_id'];
                    $table[$i]['url']=$row['url'];

                    $i++;

                  }

                  $this->callback =$table; 

                                
  }
  else
  {
    $this->callback=false;
  }




  }


   /*delete day*
   if($cmd =="delete_day"){

    $sql ="DELETE FROM `day` WHERE id_day=".$data['id'];
    if(!$connection->query($sql)){
    $this->callback=false;
    }

    $this->callback=true;

    }






       /*select_day_id*
       if($cmd =="select_day_id"){

      
        $sql ="SELECT * FROM day WHERE id_day=".$data['id'];
        if($callback_query = $connection->query($sql)){




          $row = $callback_query-> fetch_array(MYSQLI_BOTH);
                              
                     $table['id_day']=$row['id_day'];
                     $table['day']=$row['day'];
                     $table['title']=$row['title'];
                     $table['content']=$row['content'];
                     $table['deadline_date']=$row['deadline_date'];
                     $table['registration_date']=$row['registration_date'];
                     $table['id_user']=$row['id_user'];
                     $table['user_modification']=$row['user_modification'];
                     $table['date_modification']=$row['date_modification'];
                     $table['image']=$row['image'];
                     $table['group_product_id']=$row['group_product_id'];
                     $table['url']=$row['url'];
                              
                                   
                     $this->callback =$table;
                                             
                               }
                               else
                               {
                                  $this->callback=false;
                               }

    
        }


        /*Actualizar day*
  if($cmd=="update_day"){

    $data['id_day'] = $connection->real_escape_string($data['id_day']);
    $data['day'] = $connection->real_escape_string($data['day']);
    $data['title'] = $connection->real_escape_string($data['title']);
    $data['content'] = $connection->real_escape_string($data['content']);
    $data['deadline_date'] = $connection->real_escape_string($data['deadline_date']);
    $data['url'] = $connection->real_escape_string($data['url']);
    $data['user_modification'] = $connection->real_escape_string($data['user_modification']);
    $data['date_modification'] = $connection->real_escape_string($data['date_modification']);


            $sql = "UPDATE `day` SET `day` = '".$data['day']."' , title ='".$data['title']."' ,  `content` = '".$data['content']."' , deadline_date='".$data['deadline_date']."' , url='".$data['url']."' , date_modification='".$data['date_modification']."' , user_modification ='".$data['user_modification']."'  WHERE `day`.`id_day` =".$data['id_day']."";
            if(!$connection->query($sql)){
            $this->callback=false;
            }
        
            $this->callback=true;


  }



  /*Insert product*
  if($cmd =="insert_product"){

    $data['name'] = $connection->real_escape_string($data['name']);
    $data['code'] = $connection->real_escape_string($data['code']);
    $data['model'] = $connection->real_escape_string($data['model']);
    $data['id_category'] = $connection->real_escape_string($data['id_category']);
    $data['group_name'] = $connection->real_escape_string($data['group_name']);
    $data['color'] = $connection->real_escape_string($data['color']);
    $data['itbis'] = $connection->real_escape_string($data['itbis']);
    $data['value'] = $connection->real_escape_string($data['value']);
    $data['description'] = $connection->real_escape_string($data['description']);
    $data['folder_name'] = $connection->real_escape_string($data['folder_name']);
    $data['product_location'] = $connection->real_escape_string($data['product_location']);
    $data['registration_date'] = $connection->real_escape_string($data['registration_date']);
    $data['id_user'] = $connection->real_escape_string($data['id_user']);
    /*$data['quantity_in_inventory'] = $connection->real_escape_string($data['quantity_in_inventory']);*
    

    $sql = "INSERT INTO `product`(`id_product`, `name`, `code`, `model`, `id_category`, `group_name`, `color`, `itbis`, `value`, `description`, `imagen`,`folder_name`, `product_location`, `registration_date`, `id_user`, `user_modification`, `date_modification`, `quantity_in_inventory`) VALUES ('','".$data['name']."','".$data['code']."','".$data['model']."','".$data['id_category']."','".$data['group_name']."','".$data['color']."','".$data['itbis']."','".$data['value']."','".$data['description']."','".$data['imagen']."','".$data['folder_name']."','".$data['product_location']."','".$data['registration_date']."','".$data['id_user']."','','','')";
    if(!$connection->query($sql)){
    $this->callback=false;
    }

    $this->callback=true;
  }



  /*Select product SQL *
  if($cmd =="select_product"){

    $sql ="SELECT * FROM product ORDER BY id_product DESC";
  
     if($callback_query = $connection->query($sql)){
  
                      $i=0;
  
                    while($row = $callback_query -> fetch_array(MYSQLI_BOTH) ){
  
                      /*SELECT `id_product`, 
                      `name`, `code`, `model`, `id_category`,
                       `group_name`, `color`, `itbis`, `value`, `description`,
                        `imagen`, `folder_name`, `product_location`, `registration_date`,
                         `id_user`, `user_modification`, `date_modification`, `quantity_in_inventory`
                          FROM `product` WHERE 1 *
                      $table[$i]['id_product']=$row['id_product'];
                      $table[$i]['name']=$row['name'];
                      $table[$i]['code']=$row['code'];
                      $table[$i]['model']=$row['model'];
                      $table[$i]['group_name']=$row['group_name'];
                      $table[$i]['color']=$row['color'];
                      $table[$i]['itbis']=$row['itbis'];
                      $table[$i]['value']=$row['value'];
                      $table[$i]['description']=$row['description'];
                      $table[$i]['imagen']=$row['imagen'];
                      $table[$i]['folder_name']=$row['folder_name'];
                      $table[$i]['product_location']=$row['product_location'];
                      $table[$i]['registration_date']=$row['registration_date'];
                      $table[$i]['id_user']=$row['id_user'];
                      $table[$i]['user_modification']=$row['user_modification'];
                      $table[$i]['date_modification']=$row['date_modification'];
                      $table[$i]['quantity_in_inventory']=$row['quantity_in_inventory'];
                      $i++;
  
                    }
  
                    $this->callback =$table; 
  
                                  
    }
    else
    {
      $this->callback=false;
    }
  
  
  
  
    }





*/

  
