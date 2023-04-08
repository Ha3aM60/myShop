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
</head>
<body>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>


<main>
    <div class="container">
        <a class="btn btn-success m-3" href="productsCRUD/create.php">Add new products</a>
        <div class="row">
            <?php

            $sql = "SELECT tbl_products.name,tbl_products.price,tbl_products.description, tbl_categories.nameCategory, tbl_product_images.url,tbl_products.id
                    FROM tbl_products
                    INNER JOIN tbl_categories ON tbl_products.category_id=tbl_categories.id
                    INNER JOIN tbl_product_images ON tbl_product_images.product_id=tbl_products.id;";
            $command = $dbh->query($sql);
            $nameCount = '';
            foreach($command as $row) {
                $name = $row["name"];

                $price = $row["price"];
                $description = $row["description"];
                $id_cat = $row["nameCategory"];
                $image = $row["url"];
                $id = $row["id"];

                if($nameCount != $name){
                    echo "
                <div class='card m-3' style='width: 18rem;'>
                    <img class='card-img-top' style='width: 250px; height: 300px; margin: 0 auto; display: block;' src='/uploads/$image' alt='Card image cap'>
                    <div class='card-body'>
                        <h5 class='card-title'>$name</h5>
                        
                    </div>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>$id_cat</li>
                        <li class='list-group-item'>$price UAH</li>
                    </ul>
                    <div class='card-body'>
                        <a href='/productsCRUD/aboutPage.php?id=$id' class='card-link'>About page</a>
                        <a href='/productsCRUD/edit.php?id=$id' class='text-primary' style='text-decoration: none; float: right'>
                           <i class='fa fa-pencil fs-4'></i>
                    </div>
                </div>
                ";
                }
                $nameCount = $name;
            }
            ?>

        </div>


    </div>

</main>

</body>
</html>
<?php
