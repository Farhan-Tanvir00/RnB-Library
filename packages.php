<?php

@include 'config.php';
session_start();


if(isset($_POST['subscriptions'])){

    if(isset($_SESSION['user_name'])) {
        $s_name = $_SESSION['user_name'];
        $s_mail = $_SESSION['user_email'];
    
        $select = " SELECT * FROM subscriptions WHERE email = '$s_mail' && name = '$s_name' ";
        $result = mysqli_query($conn, $select);
     
        if(mysqli_num_rows($result) > 0){
     
           $message[] = 'user already Subscribed';
     
        }else{
     
            $insert = "INSERT INTO subscriptions(name, email) VALUES('$s_name','$s_mail')";
            mysqli_query($conn, $insert);
            $message[] = 'User Subscription completed';
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

 <?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

        <div class="p_m_body">
            <div class="p_text">
                Choose the plan that’s right for you
            </div>
            <div class="allpack">
                <div class="p_blocks" id="week">
                    <div class="p_title">
                        Weekly
                    </div>
                    <div class="p_description">
                        <div class="p_sn">
                            Regular Package: Unlimited access to enriching library for avid readers
                        </div>
                        <div class="bars"></div>
                        <div class="offerings">
                            Read Books 24x7 <br>
                            Life Time 7 Days <br>
                            No Adds
                        </div>
                        <div class="bars"></div>
                        <div class="p_prices">
                            0.00
                        </div>
                    </div>
                </div>
                <div class="p_blocks" id="month">
                    <div class="p_title">
                        Monthly
                    </div>
                    <div class="p_description">
                        <div class="p_sn">
                            Regular Package: Unlimited access to enriching library for avid readers
                        </div>
                        <div class="bars"></div>
                        <div class="offerings">
                            Read Books 24x7 <br>
                            Life Time 7 Days <br>
                            No Adds
                        </div>
                        <div class="bars"></div>
                        <div class="p_prices">
                            0.00
                        </div>
                    </div>
                </div>
                <div class="p_blocks" id="year">
                    <div class="p_title">
                        Yearly
                    </div>
                    <div class="p_description">
                        <div class="p_sn">
                            Regular Package: Unlimited access to enriching library for avid readers
                        </div>
                        <div class="bars"></div>
                        <div class="offerings">
                            Read Books 24x7 <br>
                            Life Time 7 Days <br>
                            No Adds
                        </div>
                        <div class="bars"></div>
                        <div class="p_prices">
                            0.00
                        </div>
                    </div>
                </div>
                <div class="p_blocks" id="s1m">
                    <div class="p_title">
                        Student Monthly
                    </div>
                    <div class="p_description">
                        <div class="p_sn">
                            Student Package: Unlimited access to enriching library for avid readers
                        </div>
                        <div class="bars"></div>
                        <div class="offerings">
                            Read Books 24x7 <br>
                            Life Time 7 Days <br>
                            No Adds
                        </div>
                        <div class="bars"></div>
                        <div class="p_prices">
                            0.00
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_button">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="submit" class="button" name="subscriptions" value="Get a Subscription">
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