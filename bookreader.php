
<?php
@include 'config.php';

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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navstyle.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    
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


    <div class="pdf-toolbar">
        <div class="navigation_controls">
            <button class="pdf-toolbar-button" id="previous">Previous</button>
            <input class="pdf-input" id="current_page" value="1"/>
            <button class="pdf-toolbar-button" id="next">Next</button>
        </div>

        <div class="zoom_controls">
            <button class="pdf-toolbar-button" id="zoom_in"> ZOOM[+] </button>
            <button class="pdf-toolbar-button" id="zoom_out"> ZOOM[-] </button>
        </div>
        <div class="canvas_container">
            <canvas id="pdf_render">

            </canvas>
            <script>
                var defaultState = {
                    pdf: null,
                    currentPage: 1,
                    zoom: 1.5
                }
                pdfjsLib.getDocument('uploaded_pdf/<?php echo $fetch_product['file']; ?>').then((pdf)=>{
                    defaultState.pdf=pdf;
                    render();
                });

                function render(){
                    defaultState.pdf.getPage(defaultState.currentPage).then((page)=> {

                        var canvas = document.getElementById("pdf_render");
                        var ctx = canvas.getContext('2d');

                        var viewport = page.getViewport(defaultState.zoom);

                        canvas.width = viewport.width;
                        canvas.height = viewport.height;
 
                        page.render({
                            canvasContext: ctx,
                            viewport: viewport
                        });
                    });
                }

                document.getElementById('previous').addEventListener('click', (e)=>{
                    if(defaultState.pdf == null || defaultState.currentPage ==1)
                        return;
                    defaultState.currentPage -= 1;
                    document.getElementById("current_page").value = defaultState.currentPage;
                    render();
                });

                document.getElementById('next').addEventListener('click', (e)=>{
                    if(defaultState.pdf == null || defaultState.currentPage > defaultState.pdf._pdfInfo.numPages)
                        return;
                    defaultState.currentPage += 1;
                    document.getElementById("current_page").value = defaultState.currentPage;
                    render();
                });

                document.getElementById('zoom_in').addEventListener('click',(e)=>{
                    if(defaultState.pdf == null) return;
                    defaultState.zoom += 0.5;
                    render();
                });

                document.getElementById('zoom_out').addEventListener('click',(e)=>{
                    if(defaultState.pdf == null) return;
                    defaultState.zoom -= 0.5;
                    render();
                });
            </script>
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