<?php
/**
 * @var string[] $errors
 * @var int $totalAlbums
 * @var \System\Databases\Objects\Album[] $albums
 */
?>
<h1 class="title mt-4">Music Collection</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (isset($albums) && isset($totalAlbums)): ?>
    <a class="button" href="<?= BASE_PATH; ?>create">Create new album</a>
    <table class="table is-striped mt-4">
        <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th>Artist</th>
            <th>Album</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Tracks</th>
            <th colspan=3"></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="10" class="has-text-centered">&copy; My Collection with <?= $totalAlbums; ?> albums</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($albums as $album): ?>
            <tr>
                <td class="is-vcentered">
                    <img class="image is-64x64" src="images/<?= $album->image; ?>" alt="<?= $album->name; ?>"/>
                </td>
                <td class="is-vcentered"><?= $album->id; ?></td>
                <td class="is-vcentered"><?= $album->artist; ?></td>
                <td class="is-vcentered"><?= $album->name; ?></td>
                <td class="is-vcentered"><?= $album->genre; ?></td>
                <td class="is-vcentered"><?= $album->year; ?></td>
                <td class="is-vcentered"><?= $album->tracks; ?></td>
                <td class="is-vcentered"><a href="<?= BASE_PATH; ?>detail?id=<?= $album->id; ?>">Details</a></td>
                <td class="is-vcentered"><a href="<?= BASE_PATH; ?>edit?id=<?= $album->id; ?>">Edit</a></td>
                <td class="is-vcentered"><a href="<?= BASE_PATH; ?>delete?id=<?= $album->id; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
