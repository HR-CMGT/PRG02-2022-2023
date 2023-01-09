<?php
/**
 * @var array $errors
 * @var string|boolean $success
 * @var \MusicCollection\Databases\Objects\Genre $genre
 */
?>
<h1 class="title mt-4">Create genre</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if ($success) { ?>
    <p class="notification is-primary"><?= $success; ?></p>
<?php } ?>

<section class="columns">
    <form class="column is-6" action="" method="post" enctype="multipart/form-data">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="name">Name</label>
            </div>
            <div class="field-body">
                <input class="input" id="name" type="text" name="name" value="<?= $genre->name; ?>"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal"></div>
            <div class="field-body">
                <button class="button is-primary is-fullwidth" type="submit" name="submit">Save</button>
            </div>
        </div>
    </form>
</section>
<a class="button mt-4" href="<?= BASE_PATH; ?>genres">&laquo; Go back to the list</a>
