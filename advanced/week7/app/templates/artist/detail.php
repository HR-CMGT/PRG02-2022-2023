<?php
/**
 * @var array $errors
 * @var \MusicCollection\Databases\Objects\Artist|null $artist
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

<?php if (isset($artist)): ?>
    <h1 class="title mt-4"><?= $artist->name; ?></h1>
    <section class="content">
        <ul>
            <li>Albums:
                <ul>
                    <?php foreach ($artist->albums() as $album): ?>
                        <li><?= $album->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </section>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>artists">Go back to the list</a>
