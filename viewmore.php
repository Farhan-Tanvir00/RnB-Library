<?php
@include 'config.php';
session_start();

$product_name_query = mysqli_query($conn, "SELECT name FROM `viewall`");
if ($product_name_query) {
    $row = mysqli_fetch_assoc($product_name_query);
    $product_name = $row['name'];

    $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE name = '$product_name'");
    if ($select_product) {
        $fetch_product = mysqli_fetch_assoc($select_product);
        
    } else {
        echo "Error fetching product details: " . mysqli_error($conn);
    }

} else {
    echo "Error fetching product name: " . mysqli_error($conn);
}



if(isset($_POST['all_products'])){
    header("Location: products.php");                       
}

if(isset($_POST['read_book'])){

    if(isset($_SESSION['user_name'])) {
        $s_name = $_SESSION['user_name'];
        $s_mail = $_SESSION['user_email'];
    
        $select = " SELECT * FROM subscriptions WHERE email = '$s_mail' && name = '$s_name' ";
        $result = mysqli_query($conn, $select);
     
        if(mysqli_num_rows($result) > 0){
            header('Location: bookreader.php');
        }else{
            header('Location:packages.php');  
        }
    } else {
        header('Location:userlogin.php');
    }
 
}

if(isset($_POST['add_to_cart'])){


    if(isset($_SESSION['user_name'])) {

        $product_name = $fetch_product['name'];
    $product_price = $fetch_product['price'];
    $product_image = $fetch_product['image'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
 
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'product already added to cart';
    }else{
       $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
       $message[] = 'product added to cart succesfully';
    }
       
    } else {
        header('Location:userlogin.php');
    }
 
 }


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
   <link rel="stylesheet" href="vmstyle.css">
   

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
            <li>
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
            </li>
            <li style="background-color:#27ae60; padding: 4px; border-radius: 0.5rem;"><a href="userlogin.php"><?php 
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
    <form action="" method="post">
    <div class="container">
        <div class="box">
            <div class="images">
                <div class="img-holder active">
                    <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" width='100%' height='auto' alt="">
                </div>
                
            </div>
            <div class="basic-info">
                <h1><?php echo $fetch_product['name']; ?></h1>
                <span><?php echo $fetch_product['price']; ?></span>
                
                <div class="options">
                    <input type="submit" class="btn" name="read_book" value="read book">
                    <input type="submit" class="btn" name="add_to_cart" value="add to cart">
                </div>
            </div>
            <div class="description">
                <h3>by <?php echo $fetch_product['author']; ?></h3>
                <p><?php echo $fetch_product['description']; ?></p> 
                <input type="submit" class="btn" name="all_products" value="all products"> 
            </div>
        </div>
    </div>
</form>
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