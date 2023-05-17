<?php
require("dbcont.php");
if(!empty($_GET['id'])) {
  $id= $_GET['id'];
}

if(isset($_POST['delete'])) {
$usql = "DELETE FROM order_item where orderId='$id';";  
      $uresult = mysqli_query($conn, $usql); 
      if($uresult) {
         
        $m="Record deleted successfully";
        header("Location:cart.php?m=$m");
      } else {
        
        $m="Error deleting record: " . mysqli_error($conn);
        header("Location:cart.php?m=$m"); 
      }

}

if(isset($_POST['cancle'])) { 
header("Location:cart.php");
}
?>
<div class="login">
<form method="POST" style="border:1px solid #ccc" class="login_form">
<H2> Do you really want to remove your item from the order list? </h2>
<button type="submit" class="login_submit" name="delete" > Delete </button>
<button type="submit" class="login_submit" name="cancle" > Cancle </button>
</form>