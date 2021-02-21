<?php
   $username = "root";
   $password ="";
   $server = 'localhost';
   $db ='trans';


   $con = mysqli_connect($server,$username,$password,$db);
   if($con){
    ?>
  
   }
  





?>
  <script>
   alert('connection Succesful');
  </script>
     <?php
}else{
    die("no connection". mysqli_connect_error());
}     
?>