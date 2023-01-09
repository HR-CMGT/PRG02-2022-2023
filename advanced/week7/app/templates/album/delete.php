<?php
/**
 * @var string[] $errors
 * @var \MusicCollection\Databases\Objects\Album $album
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

<h1 class="title mt-4">Are you sure you want to delete album <em><?= $album->name; ?></em> from <em><?= $album->artists_name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>albums/delete?id=<?= $album->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>albums">Go back to the list</a>
