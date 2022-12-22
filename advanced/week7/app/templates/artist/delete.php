<?php
/**
 * @var string[] $errors
 * @var \MusicCollection\Databases\Objects\Artist $artist
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

<h1 class="title mt-4">Are you sure you want to delete artist <em><?= $artist->name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>artists/delete?id=<?= $artist->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>artists">Go back to the list</a>
