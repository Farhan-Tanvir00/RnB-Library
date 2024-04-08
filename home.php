<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <link rel="stylesheet" href="navstyle.css">   
    <link rel="stylesheet" href="style.css"> 
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

    <div class="m_body">
        <div class="image">
            <img src="homeimages/homeimage.png" alt="Home_Image" width="100%" height="auto">
        </div>

        <div class="newsandbooks">

            <div class="texts">
                <h2>Welcome to RnB Library.</h2></br>
                <h3>Read a variety of books and newspapers, and also buy books, all in one place.</h3>
            </div>
            <div class="content">
                <div class="newspapers">
                    <button onclick="window.location.href='newspapers.php'">News</button>
                </div>
                <div class="books">
                    <button onclick="window.location.href='products.php'">Book</button>
                </div>
            </div>
            <button class="allusers" onclick="window.location.href='login.php'">Login</button>
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