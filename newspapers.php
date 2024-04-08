<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="navstyle.css">    
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

    <div class="news_m_body">

        <div class="news_top">
            <div class="mid">
                <img src="nplogos/npheadings/nphead1.png" alt="" width="100%" height="auto">
                <img src="nplogos/npheadings/nphead2.png" alt="" width="100%" height="auto">
                <img src="nplogos/npheadings/nphead3.png" alt="" width="100%" height="auto">
                <img src="nplogos/npheadings/nphead4.png" alt="" width="100%" height="auto">
            </div>
        </div>

        <div class="news_main1">
            <div class="np_container" id="p1">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p2">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p3">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p4">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p5">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p6">
                <a href="#" class="button">Read</a>
            </div>
            
            
        </div>
        <div class="news_main2">
            <div class="np_container" id="p7">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p8">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p9">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p10">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p11">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p12">
                <a href="#" class="button">Read</a>
            </div>
        </div>
        <div class="news_main3">
            <div class="np_container" id="p13">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p14">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p15">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p16">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p17">
                <a href="#" class="button">Read</a>
            </div>
            <div class="np_container" id="p18">
                <a href="#" class="button">Read</a>
            </div>
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