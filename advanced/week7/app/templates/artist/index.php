<?php
/**
 * @var array $errors
 * @var int $totalArtists
 * @var \MusicCollection\Databases\Objects\Artist[] $artists
 */
?>
<h1 class="title mt-4">Artists</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<a class="button is-primary" href="<?= BASE_PATH; ?>">&laquo; Back home</a>
<a class="button" href="<?= BASE_PATH; ?>artists/create">Create new artist</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Total Albums</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="6" class="has-text-centered">&copy; My Collection with <?= $totalArtists; ?> artists</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($artists as $artist): ?>
        <tr>
            <td><?= $artist->id; ?></td>
            <td><?= $artist->name; ?></td>
            <td><?= count($artist->albums()); ?></td>
            <td><a href="<?= BASE_PATH; ?>artists/detail?id=<?= $artist->id; ?>">Details</a></td>
            <td><a href="<?= BASE_PATH; ?>artists/edit?id=<?= $artist->id; ?>">Edit</a></td>
            <td><a href="<?= BASE_PATH; ?>artists/delete?id=<?= $artist->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
