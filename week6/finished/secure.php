<?php
session_start();

//May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

//Get email from session
$name = $_SESSION['loggedInUser']['name'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Secure page</title>
</head>
<body>
<section class="section">
    <div class="container content">

        <article class="message is-warning">
            <div class="message-header">
                <p>YOU SHALL NOT PASS (unless you have logged in).</p>
            </div>
            <div class="message-body columns">
                <img class="column image is-one-fifth" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/1dbc1935-6542-4ee3-822f-135cff4ba62c/df8bak7-1db31a67-3431-410f-a531-3da321cbd0fb.png/v1/fill/w_1024,h_1731,strp/gandalf_the_grey__the_hobbit____transparent__by_speedcam_df8bak7-fullview.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTczMSIsInBhdGgiOiJcL2ZcLzFkYmMxOTM1LTY1NDItNGVlMy04MjJmLTEzNWNmZjRiYTYyY1wvZGY4YmFrNy0xZGIzMWE2Ny0zNDMxLTQxMGYtYTUzMS0zZGEzMjFjYmQwZmIucG5nIiwid2lkdGgiOiI8PTEwMjQifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.ZJjn7_YG0nKL-NvMFNoKmoVelhqE1YmMWBpSRTCj5Tg" alt=""/>
                <div class="column">
                    <h2 class="title">
                        Welcome, <?= $name ?>
                    </h2>
                    <p>
                        This is a secure page. You have to log in to see this page.
                    </p>
                    <p>
                        When you have logged in on the login page, your name, email and id are stored in a SESSION. When
                        this page is visited, the SESSION is checked to see if this information is present.
                    </p>
                    <p>
                        If present, it means you have logged in before, and you are allowed to visit the page. If there
                        is nothing in the SESSION, you will be sent to the login page.
                    </p>

                    <a class="button is-link" type="button" href="logout.php">Log out</a>
                </div>
            </div>
        </article>
    </div>
</section>
</body>
</html>
