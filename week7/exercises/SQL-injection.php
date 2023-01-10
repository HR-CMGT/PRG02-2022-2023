<?php
/** @var mysqli $db */
require_once 'includes/database.php';

// redirect when uri does not contain a id
if(!isset($_GET['id']) || $_GET['id'] == '') {
    // redirect to index.php
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Registreren</title>
</head>
<body>

<section class="section">
    <div class="container">
        <h2 class="title">
            Profile
        </h2>
        <div class="columns">

            <div class="column is-one-third">
                <div class="card">
                    <div class="card-header-icon">
                        <?php if(isset($user['name'])) { ?>
                        <figure>
                            <img src="https://thispersondoesnotexist.com/image" alt=""/>
                        </figure>
                        <?php } else { ?>
                            <i class="fa-solid fa-user-slash fa-3x"></i>
                            not found
                        <?php } ?>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">
                                    <?= $user['name'] ?>
                                </p>
                                <p class="subtitle is-6">
                                    <?= $user['email'] ?>
                                </p>
                            </div>
                        </div>

                        <div class="media">
                            <div class="media-left">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div class="media-content">
                                <p class="title is-5 mb-5">
                                    <a href="">Change password</a>
                                </p>
                                <p class="subtitle is-7">
                                    <time datetime="2016-1-1" class="is-small">Last update<br>Jan 15 2021 11:09 AM</time>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
