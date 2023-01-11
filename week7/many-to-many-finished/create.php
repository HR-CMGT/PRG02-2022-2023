<?php
/** @var mysqli $db */

//Require database in this file
require_once "includes/database.php";

//Get the categories from the database with a SQL query
$query = "SELECT * FROM categories";
$result = mysqli_query($db, $query) or die ('Error: ' . $query);

//Loop through the result to create a custom array
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

//Get the tags from the database with a SQL query
$query = "SELECT * FROM tags";
$result = mysqli_query($db, $query) or die ('Error: ' . $query);

//Loop through the result to create a custom array
$tags = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tags[] = $row;
}

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = mysqli_escape_string($db, $_POST['name']);
    $categoryId = mysqli_escape_string($db, $_POST['category-id']);
    //I used array map, the 'easy/normal' way to do it is via a foreach
    $tagIds = isset($_POST['tag-ids']) ? array_map(fn($value) => mysqli_escape_string($db, $value), $_POST['tag-ids']) : [];
    $description = mysqli_escape_string($db, $_POST['description']);
    $price = mysqli_escape_string($db, $_POST['price']);

    if ($name == "") {
        $errors['name'] = 'Name cannot be empty';
    }
    if ($description == "") {
        $errors['description'] = 'Description cannot be empty';
    }
    if ($price == "") {
        $errors['price'] = 'Price cannot be empty';
    }
    if (empty($tagIds)) {
        $errors['tag_ids'] = 'You need to choose at least 1 tag';
    }

    if (empty($errors)) {
        //Save the record to the database
        $query = "INSERT INTO products (category_id, name, description, price)
                  VALUES ('$categoryId', '$name', '$description', '$price')";
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

        //Get the last inserted ID of the DB
        $productId = mysqli_insert_id($db);

        //Add every many-to-many relation to the database
        foreach($tagIds as $tagId) {
            $query = "INSERT INTO product_tag (product_id, tag_id)
                        VALUES ('$productId', '$tagId')";
            $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
        }

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: create.php');
        exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Create Product</title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Create new product</h1>

    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="name" type="text" name="name" value="<?= $name ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['name'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="category-id">Category</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control select">
                            <select id="category-id" name="category-id">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['category_id'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="tag-ids">Tags</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control select is-multiple">
                            <select id="tag-ids" name="tag-ids[]" multiple>
                                <?php foreach ($tags as $tag) { ?>
                                    <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['tag_ids'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="description">Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" id="description" name="description"><?= $description ?? '' ?></textarea>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['description'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="price">Price</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="price" type="number" name="price" value="<?= $price ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['price'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                    <button class="button is-link is-fullwidth" type="submit" name="submit">Save</button>
                </div>
            </div>
        </form>
    </section>
</div>
</body>
</html>
