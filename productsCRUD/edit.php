<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
$id=$_GET["id"];
$name = '';
$price = 0;
$description = '';
$catId = '';


if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['EditBtn'])) {
        if (isset($_POST['name']))
            $name = $_POST['name'];
        if (isset($_POST['price']))
            $price = $_POST['price'];
        if (isset($_POST['description']))
            $description = $_POST['description'];
        if (isset($_POST['catId']))
            $catId = $_POST['catId'];

        if (!empty($name) || !empty($price) || !empty($description) || !empty($catId)) {
            $sql = "UPDATE `tbl_products` SET `name` = ?,`price` = ?,`description` = ?,`category_id` = ? WHERE `tbl_products`.`id` = ?;";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$name,$price,$description,$catId, $id]);
            header("location: /index.php");
            exit();
        }
    }

}

if (isset($_POST['DeleteBtn'])){

        $deleteSQL = "SELECT url FROM tbl_product_images WHERE `tbl_product_images`.`product_id` = $id;";
        $stmt2 = $dbh->query($deleteSQL);
        foreach($stmt2 as $row){
            $url = $row["url"];
            unlink("./uploads/$url");
        }

        $sql = "DELETE FROM tbl_product_images WHERE `tbl_product_images`.`product_id` = ?;";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);

        $sql1 = "DELETE FROM tbl_products WHERE `tbl_products`.`id` = ?;";
        $stmt1 = $dbh->prepare($sql1);
        $stmt1->execute([$id]);

        header("location: /index.php");
        exit();
    }
?>
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
        <h1 class="text-center">Edit products</h1>
        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">ID</label>
                <input type="text"
                       class="form-control"
                       value="<?php echo $id; ?>"
                       disabled>
            </div>
            <?php
            $sql = "SELECT * FROM `tbl_products`";
            $stmt = $dbh->query($sql);
            foreach($stmt as $row) {
                $name = $row["name"];
                $price = $row["price"];
                $description = $row["description"];
                $catId = $row["category_id"];
            }
            echo "
                <div class='mb-3'>  
                <label for='name' class='form-label'>Name</label>
                    <input type='text'
                        value='$name'
                        class='form-control'
                        id='name'
                        name='name' required>
                    <label for='price' class='form-label'>Price</label>
                    <input type='text'
                        value='$price'
                        class='form-control'
                        id='price'
                        name='price' required>
                    <label for='description' class='form-label'>Description</label>
                    <input type='text'
                        value='$description'
                        class='form-control'
                        id='description'
                        name='description' required>
                    <label for='catId' class='form-label'>Category ID</label>
                    <input type='text'
                        value='$catId'
                        class='form-control'
                        id='catId'
                        name='catId' required>
                </div>
                ";
            ?>

            <button name="EditBtn"type="submit" class="btn btn-success">Save</button>
            <button name="DeleteBtn" type="delete" class="btn btn-success">Delete products</button>
        </form>

    </div>


</main>
</body>
</html>

