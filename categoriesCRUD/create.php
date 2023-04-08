<?php
$name = "";
include($_SERVER["DOCUMENT_ROOT"] . "/connection.php");

    if (isset($_POST['AddBtn'])){

        $name = $_POST['name'];
        if (!empty($name)) {
            $stmt = $dbh->prepare("INSERT INTO tbl_categories (id, nameCategory) VALUES (NULL, :name)");
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->execute();
            header("location: /categories.php");
            exit();
        }

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
<main>
<div class="container">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button  class="btn btn-outline-success"  type="submit" name="AddBtn">Add</button>
            </div>
            <input name="name"
                   type="text"
                   class="form-control"
                   placeholder="Enter name of categories"
                   aria-describedby="basic-addon1">
        </div>

    </form>
</div>

</main>
</body>
</html>

