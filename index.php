<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>


<main>
    <div class="container">
        <a class="btn btn-success m-3" href="productsCRUD/create.php">Add new products</a>
        <div class="row">
            <?php
            $sql = "SELECT tbl_products.name,tbl_products.price,tbl_products.description, tbl_categories.name, tbl_product_images.url
                    FROM tbl_products
                    INNER JOIN tbl_categories ON tbl_products.category_id=tbl_categories.id
                    INNER JOIN tbl_product_images ON tbl_product_images.product_id=tbl_products.id;";
            $command = $dbh->query($sql);
            foreach($command as $row) {
                $name = $row["name"];
                $price = $row["price"];
                $description = $row["description"];
                $id_cat = $row["name"];
                $image = $row["url"];
                echo "
                <div class='card m-3' style='width: 18rem;'>
                    <img class='card-img-top' src='/uploads/$image' alt='Card image cap'>
                    <div class='card-body'>
                        <h5 class='card-title'>$name</h5>
                        <p class='card-text'>$description</p>
                    </div>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>$id_cat</li>
                        <li class='list-group-item'>$price UAH</li>
                    </ul>
                    <div class='card-body'>
                        <a href=''#' class='card-link'>About page</a>
                    </div>
                </div>
                ";
            }
            ?>

        </div>


    </div>

</main>

</body>
</html>
<?php
