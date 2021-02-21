<?php
session_start();
?>
<!DOCTYPE html>
 <html>
 <head><title>Storing in database</title>
 </head>
 <body>
<?php
    $conn=mysqli_connect('localhost','root','','trans');
     
    
     $sender=$_POST['send'];
     $receiver=$_POST['rece'];
     $amount=$_POST['amt'];
        
        $sql="select * from Customer where Name='".$sender."' ";
        
        $result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
         $sql1 = mysqli_fetch_array($result);
        
     $sql = "SELECT * from Customer where Name='".$receiver."' ";
    $query = mysqli_query($conn,$sql)or die(mysqli_error($conn));
    $sql2 = mysqli_fetch_array($query);
        
    
    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo 'alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1[3]) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }
     
     else {
        
                // deducting amount from sender's account
                $newbalance = $sql1[3] - $amount;
                $sql = "UPDATE Customer set balance=$newbalance where name='".$sender."' ";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2[3] + $amount;
                $sql = "UPDATE Customer set balance=$newbalance where name='".$receiver."' ";
                mysqli_query($conn,$sql);
                
                $sender = $sql1[1];
                $receiver = $sql2[1];
                $sql = "INSERT INTO transaction(`sender`, `receipient`, `amount`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transactionhistory.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
     if(mysqli_num_rows($result)==1)
        {
             header('Location:viewcust.html');
           
        }
        

?>

 </body>  
 </html>   