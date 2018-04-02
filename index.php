
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

   if(!empty($_POST['name'])){ 
      
      $data['name']=$_POST['name'];

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
<body>




<form action="index.php" method="POST">

<img width="30px" src="https://cms-assets.tutsplus.com/uploads/users/107/posts/24710/image/35-flat-animals-fox.jpg">
<img width="30px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBgOor5fHNAMS4LI3n-XaW-1K6y5Xs4Im81KUmEOQ237DOAYbE">
<img width="30px" src="data:image/png;base64,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">
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


