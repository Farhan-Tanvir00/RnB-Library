<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_author = $_POST['product_author'];
   $product_description = $_POST['product_description'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_pdf = $_FILES['product_pdf']['name']; // Get PDF file name
   $product_pdf_tmp_name = $_FILES['product_pdf']['tmp_name']; // Get PDF file temporary name
   $product_image_folder = 'uploaded_img/'.$product_image;
   $product_pdf_folder = 'uploaded_pdf/' . $product_pdf; // Destination folder for PDF file

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image, author, description, file) VALUES('$product_name', '$product_price', '$product_image','$product_author','$product_description','$product_pdf')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         move_uploaded_file($product_pdf_tmp_name, $product_pdf_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
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
   <link rel="stylesheet" href="logregstyle.css">

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
        </ul>
        <div class="menu-icon">
            <i class="fa-solid fa-bars" onclick="toggleMenu()"></i>
        </div>
    </nav>

    <div class="useradmin">
        <div class="onuser">
            <div class="descr">
            "You can explore a wide array of literature including books and newspapers. Additionally, you have the option to purchase hard copies of books to complement your reading experience."
            </div>
            <button onclick="window.location.href='userlogin.php'">Login as User</button>
        </div>
        <div class="onadmin">
        <div class="descr">
        "You have the ability to seamlessly add books to your shop inventory. Moreover, you can easily manage your inventory by editing or removing book details as needed, ensuring a streamlined and organized catalog."
            </div>
            <button onclick="window.location.href='adminlogin.php'">Login as Admin</button>
        </div>
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