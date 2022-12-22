<?php
/**
 * @var string|null $pageTitle
 * @var string|null $content
 */
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection | <?= $pageTitle ?? ''; ?></title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <?= $content ?? ''; ?>
</div>
</body>
</html>
