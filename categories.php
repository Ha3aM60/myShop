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
        <h1 class="text-center">All categories</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM tbl_categories";
            $command = $dbh->query($sql);
            foreach($command as $row) {
                $name = $row["nameCategory"];
                $id = $row["id"];
                echo "
                <tr>
                    <td>$id</td>
                    <td>$name</td>
                    
                    <td>
                        <a href='/categoriesCRUD/edit.php?id=$id' class='text-primary' style='text-decoration: none;'>
                           <i class='fa fa-pencil fs-4'></i>
                        </a>
                    </td>
                </tr>
                ";
            }
            ?>

            </tbody>
        </table>

        <a class="btn btn-success" href="categoriesCRUD/create.php">Add new category</a>
    </div>
</main>
</body>
</html>
<?php

