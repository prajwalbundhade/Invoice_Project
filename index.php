<?php
include 'dbconn.php';


if(isset($_POST['submit'])){
    
   $user_id = $_POST['user_id'];
   $password = $_POST['password'];

   $select = " SELECT * FROM login WHERE user_id = '$user_id' ";

   $result = mysqli_query($conn, $select);

   $user_count = mysqli_num_rows($result);

   if( $user_count<1){
    ?>
        <script>alert("data mismatch. enter again")</script>
    <?php
    }else{
       
      
        header("location:dashboard.php");
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
  
    <link rel="stylesheet" href="assets/css/form-style.css">
</head>
<body>
    <div class="form-container">
    <form action="" method="post">
       <center><label for="user_id">User ID:</label><br>
        <input type="text" name="user_id" id="user_id" class="box" required><br>

        <label for="password">Password:</label>
        <input type="password" class="box" name="password" id="password" required>

        <input type="submit" class="form-btn" name="submit" value="Login"></center> 
    </form>
    </div>
</body>
</html>