<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Album $album
 */
?>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (isset($album)): ?>
    <h1 class="title mt-4"><?= $album->artist . ' - ' . $album->name; ?></h1>
    <img class="image is-128x128" src="images/<?= $album->image; ?>" alt="<?= $album->name; ?>"/>
    <section class="content">
        <ul>
            <li>Genre: <?= $album->genre; ?></li>
            <li>Year: <?= $album->year; ?></li>
            <li>Tracks: <?= $album->tracks; ?></li>
        </ul>
    </section>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>">Go back to the list</a>
