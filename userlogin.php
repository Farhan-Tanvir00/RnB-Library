<?php

@include 'config.php';
session_start();

if(isset($_POST['register_new'])){
    header('Location:userreg.php');
}
if(isset($_POST['adm_logout'])){

    header('Location:logout.php');
}

if(isset($_POST['adm_login'])){

   $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
   $pass = md5($_POST['admin_password']);

   if(empty($email) || empty($pass)){
      $message[] = 'please fill out all';
   }else{

      $select = " SELECT * FROM regularusers WHERE email = '$email' && password = '$pass' ";
      $result = mysqli_query($conn, $select);

      if(mysqli_num_rows($result) > 0){

         $row = mysqli_fetch_array($result);
         $_SESSION['user_name'] = $row['fname'];
         $_SESSION['user_email'] = $row['email'];

        header('location:products.php');
        
      }else{
         $message[] = 'incorrect email or password!';
      }

   }

};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="navstyle.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<nav>
        <div class="logo">
            <h1>RnB Library</h1>
        </div>
        <ul id="menuList">
            <li><a href="home.php">Home</a></li>
            <li><a href="products.php">Books</a></li>
            <li><a href="packages.php">Packages</a></li>
            <li style="background-color:#27ae60; padding: 4px; border-radius: 0.5rem;"><a href="adminlogin.php"><?php 
                if(isset($_SESSION['user_name'])) {
                    echo "User >> ".$_SESSION['user_name'];
                } else {
                    echo "User >> Guest";
                }
            ?></a></li>
        </ul>
        <div class="menu-icon">
            <i class="fa-solid fa-bars" onclick="toggleMenu()"></i>
        </div>
    </nav>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

    <div class="admin-product-form-container" style="margin-top:200px;">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Login as User</h3>
         <input type="text" placeholder="email" name="admin_email" class="box"><!--NF-->
         <input type="text" placeholder="password" name="admin_password" class="box"><!--NF-->

         <input type="submit" class="btn" name="adm_login" value="Login">
         <input type="submit" class="btn" name="adm_logout" value="Logout">
         <input type="submit" class="btn" name="register_new" value="Register New User">
      </form>

   </div>

   

<footer>
        <p>Copyright © 2022 My Website</p>
    </footer>


    <script>
        let menuList = document.getElementById("menuList")
        menuList.style.maxHeight = "0px";

        function toggleMenu(){
            if(menuList.style.maxHeight == "0px")
            {
                menuList.style.maxHeight = "300px";
            }
            else{
                menuList.style.maxHeight = "0px";
            }
        }
        
    </script>
    <script src="https://kit.fontawesome.com/f8e1a90484.js" crossorigin="anonymous"></script>


</body>
</html>