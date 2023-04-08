<?php

$name = "";
$id=$_GET["id"];
include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['EditBtn'])) {
        if (isset($_POST['name']))
            $name = $_POST['name'];

        if (!empty($name)) {
            $sql = "UPDATE `tbl_categories` SET `nameCategory` = ? WHERE `tbl_categories`.`id` = ?;";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$name, $id]);
            header("location: /categories.php");
            exit();
        }
    }

}
    if (isset($_POST['DeleteBtn'])){
        $sql = "DELETE FROM `tbl_categories` WHERE `tbl_categories`.`id` = ?;";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);
        header("location: /categories.php");
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
    <link rel="stylesheet" href="/css/font-awesome.min.css">
</head>
<body>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/header.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>
<main>
    <div class="container">
        <h1 class="text-center">Edit category</h1>
        <form method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">ID</label>
                <input type="text"
                       class="form-control"
                       value="<?php echo $id; ?>"
                        disabled>
            </div>
            <?php
                $sql = "select nameCategory FROM `tbl_categories` WHERE `tbl_categories`.`id` = $id";
                $stmt = $dbh->query($sql);
            foreach($stmt as $row) {
                $name = $row["nameCategory"];
            }
            echo "
                <div class='mb-3'>
                    <label for='image' class='form-label'>URL фото</label>
                <input type='text'
                       value='$name'
                        class='form-control'
                        id='name'
                        name='name' required>
                </div>
                ";
            ?>


            <button name="EditBtn"type="submit" class="btn btn-success">Save</button>
            <button name="DeleteBtn" type="delete" class="btn btn-success">Delete category</button>
        </form>

    </div>

</main>

</body>
</html>