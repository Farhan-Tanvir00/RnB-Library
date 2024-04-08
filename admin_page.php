<?php

@include 'config.php';
session_start();
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

if(isset($_POST['add_new_admin'])){
   header('location:adminreg.php');
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
            <li style="background-color:#27ae60; padding: 4px; border-radius: 0.5rem;"><a href=""><?php 
                if(isset($_SESSION['admin_name'])) {
                    echo "Admin >> ".$_SESSION['admin_name'];
                } else {
                    echo "Admin >> Guest";
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
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new Book</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="text" placeholder="enter product Author name" name="product_author" class="box"><!--NF-->
         <input type="text" placeholder="enter product description" name="product_description" class="box"><!--NF-->
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="file" accept="application/pdf" name="product_pdf" class="box"> <!-- Add input for PDF -->

         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product Author</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
         <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="submit" class="btn" name="add_new_admin" value="add new admin">
         </form>
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