<?php
/**
 * @var string[] $errors
 * @var \MusicCollection\Databases\Objects\Album|null $album
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
    <h1 class="title mt-4"><?= $album->artists_name . ' - ' . $album->name; ?></h1>
    <img class="image is-128x128" src="<?= BASE_PATH; ?>images/<?= $album->image; ?>" alt="<?= $album->name; ?>"/>
    <section class="content">
        <ul>
            <li>Genre(s): <?= implode(', ', $album->getGenres()); ?></li>
            <li>Year: <?= $album->year; ?></li>
            <li>Tracks: <?= $album->tracks; ?></li>
        </ul>
    </section>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>albums">Go back to the list</a>
