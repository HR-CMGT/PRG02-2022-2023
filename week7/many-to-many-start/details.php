<?php
/** @var mysqli $db */

//Redirect when uri does not contain an id
if (!isset($_GET['id']) || $_GET['id'] == '') {
    // redirect to index.php
    header('Location: create.php');
    exit;
}

//Require database in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$id = mysqli_escape_string($db, $_GET['id']);

//Get the record from the database result
//TODO: Change this query to also retrieve the tags
$query = "SELECT p.*, c.name AS category_name
            FROM products AS p
            LEFT JOIN categories AS c ON c.id = p.category_id
            WHERE p.id = '$id'";
$result = mysqli_query($db, $query) or die ('Error: ' . $query);

//Redirect when db returns no result
if (mysqli_num_rows($result) != 1) {
    header('Location: create.php');
    exit;
}

$product = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Details - <?= $product['name'] ?></title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $product['name'] ?></h1>
    <section class="content">
        <ul>
            <li>Description: <?= $product['description'] ?></li>
            <li>Price: &euro;<?= $product['price'] ?></li>
            <li>Category: <?= $product['category_name'] ?? 'Geen categorie' ?></li>
        </ul>
    </section>
</div>
</body>
</html>
