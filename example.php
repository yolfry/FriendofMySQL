
<!--FILE: EXAMPLE 1-->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>EXAMPLE 1</title>

  <?php 
   /*Include framework*/  /*PHP 7.1.0*/ require_once("FriendofMySQL/FriendofMySQL.php"); 

      #Insert Animals 

   if(!empty($_POST["name"])){ 
      
      $data["name"]=$_POST["name"];

      #execute framework inserting the name of the animal 
      $FriendofMySQL = new FriendofMySQL("root","insert_animals",$data);

      #callback
      if(!empty($FriendofMySQL->callback)){
        if($FriendofMySQL->callback=="false"){
          echo "<script>alert('error');</script>";
        }
      }   
   }

?>

</head>

<a href="FriendofMySQL/documentation.html">Documentation</a>
<body>




<form action="index.php" method="POST">

<img width="200px" src="https://images.freeimages.com/images/premium/previews/2200/22005669-illustrated-animals.jpg">
<br>
<labe>example. dog,cat </label>
<br>
<input name="name" type="text" placeholder="name of animal">
<input type='submit' value="Add">

</form>


  

</body>
</html>


































<!--FILE: EXAMPLE 2-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>EXAMPLE 2</title>
</head>
<body>

<table>
   <tr>
     <th>ID</th>
     <th>name</th>
   </tr>

<!--HTML-->


<?php /*Include framework*/  /*PHP 7.1.0*/  require_once("FriendofMySQL/FriendofMySQL.php");  


  
  /*Tabla animals*/   
  #execute framework inserting the name of the animal
  $FriendofMySQL = new FriendofMySQL("root","consul_animals");



  if($FriendofMySQL->callback!="false"){

    for($i=0;$i<count($FriendofMySQL->callback);$i++):
           
      ?>
    

        <tr>
          <td><?php  echo $FriendofMySQL->callback[$i]['id_animals']; ?></td>
           <td><?php echo $FriendofMySQL->callback[$i]['name']; ?></td> 
        </tr>

    
    <?php
      
    endfor;

   
  }
  else
  {
    echo"<script>alert('error');</script>";
  }


  ?>

   </table>



  
</body>
</html>


