<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="slideshow-container">
                    <?php
                    $id = $_GET['id'];
                    $sql = "select url FROM `tbl_product_images` WHERE `tbl_product_images`.`product_id` = $id";
                    $stmt = $dbh->query($sql);
                    $count_images = 0;
                    foreach($stmt as $row) {
                        $url = $row["url"];
                        echo "
            <div class='mySlides fade'>
                
                <img src='/uploads/$url' style='width:700px height: 500px;'>
                
            </div>
                ";
                        $count_images++;
                    }


                    ?>
                    <div style="text-align:center">
                        <?php
                        for($i = 0; $i < $count_images;$i++){
                            echo "
                <span class='dot' onclick='currentSlide($i)'></span>
            ";
                        }
                        ?>

                    </div>
            </div>
            <div class="col-sm">
                <?php
                    $id = $_GET['id'];
                    $sql = "select tbl_products.id, tbl_products.name, tbl_products.price, tbl_products.description, tbl_categories.nameCategory FROM `tbl_products` 
                            INNER JOIN tbl_categories on tbl_products.category_id = tbl_categories.id
                            WHERE tbl_products.id = $id";
                    $stmt = $dbh->query($sql);
                foreach($stmt as $row){
                    $productId = $row["id"];
                    $name = $row["name"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $categoryName = $row["nameCategory"];
                    echo "
                        <h1 class='text-center'>$name</h1>
                        <h2 class='text-center'><span class='text-primary'>Price:</span> $price UAH</h2>
                        <h2 class='text-center'><span class='text-primary'>Category:</span> $categoryName</h2>
                        <button class='btn btn-success' style='margin: 0 auto; display: block; width: 100px'> Buy</button>
                        <h2 class='text-center font-monospace fs-5'><span class='text-primary'>Description:</span> $description</h2>
                    ";
                }
                ?>
            </div>
        </div>
    </div>




</main>

</body>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }


    </script>

</html>