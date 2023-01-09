<?php
/**
 * @var array $errors
 * @var int $totalGenres
 * @var \MusicCollection\Databases\Objects\Genre[] $genres
 */
?>
<h1 class="title mt-4">Genres</h1>
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
<a class="button" href="<?= BASE_PATH; ?>genres/create">Create new genre</a>
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
        <td colspan="6" class="has-text-centered">&copy; My Collection with <?= $totalGenres; ?> genres</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($genres as $genre): ?>
        <tr>
            <td><?= $genre->id; ?></td>
            <td><?= $genre->name; ?></td>
            <td><?= count($genre->albums()); ?></td>
            <td><a href="<?= BASE_PATH; ?>genres/detail?id=<?= $genre->id; ?>">Details</a></td>
            <td><a href="<?= BASE_PATH; ?>genres/edit?id=<?= $genre->id; ?>">Edit</a></td>
            <td><a href="<?= BASE_PATH; ?>genres/delete?id=<?= $genre->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
