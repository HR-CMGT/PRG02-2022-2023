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
    <h1 class="title mt-4">Are you sure you want to delete <?= $album->artist . ' - ' . $album->name; ?>?</h1>
    <a class="button is-danger mt-4" href="<?= BASE_PATH; ?>delete?id=<?= $album->id; ?>&continue">Yes, delete!</a>
    <a class="button mt-4" href="<?= BASE_PATH; ?>">Go back to the list</a>
<?php endif; ?>

