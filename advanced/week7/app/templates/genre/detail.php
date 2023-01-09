<?php
/**
 * @var array $errors
 * @var \MusicCollection\Databases\Objects\Genre|null $genre
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

<?php if (isset($genre)): ?>
    <h1 class="title mt-4"><?= $genre->name; ?></h1>
    <section class="content">
        <ul>
            <li>Albums:
                <ul>
                    <?php foreach ($genre->albums() as $album): ?>
                        <li><?= $album->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </section>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>genres">Go back to the list</a>
