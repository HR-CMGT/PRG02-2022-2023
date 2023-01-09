<?php
/**
 * @var string[] $errors
 * @var string|bool $success
 * @var \MusicCollection\Databases\Objects\Album|null $album
 * @var \MusicCollection\Databases\Objects\Artist[] $artists
 * @var \MusicCollection\Databases\Objects\Genre[] $genres
 * @var int[] $genreIds
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

<?php if ($success): ?>
    <p class="notification is-primary"><?= $success; ?></p>
<?php endif; ?>

<?php if (isset($album)): ?>
    <h1 class="title mt-4">Edit <em><?= $album->artists_name . ' - ' . $album->name; ?></em></h1>
    <section class="columns">
        <form class="column is-6" action="" method="post" enctype="multipart/form-data">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="artist-id">Artist</label>
                </div>
                <div class="field-body select is-fullwidth">
                    <select name="artist-id" id="artist-id">
                        <?php foreach ($artists as $artist): ?>
                            <option value="<?= $artist->id; ?>" <?= $artist->id === $album->artist_id ? 'selected' : '' ?>><?= $artist->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Album</label>
                </div>
                <div class="field-body">
                    <input class="input" id="name" type="text" name="name" value="<?= $album->name; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="genre-ids">Genre(s)</label>
                </div>
                <div class="field-body select is-multiple is-fullwidth">
                    <select multiple size="3" name="genre-ids[]" id="genre-ids" title="Genres">
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?= $genre->id; ?>" <?= in_array($genre->id, $genreIds) ? 'selected' : '' ?>><?= $genre->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="year">Year</label>
                </div>
                <div class="field-body">
                    <input class="input" id="year" type="text" name="year" value="<?= $album->year; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="tracks">Tracks</label>
                </div>
                <div class="field-body">
                    <input class="input" id="tracks" type="number" name="tracks" value="<?= $album->tracks; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="image">Image</label>
                </div>
                <div class="field-body">
                    <input class="input" id="image" type="file" name="image"/>
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
<?php endif; ?>
<a class="button" href="<?= BASE_PATH; ?>albums">&laquo; Go back to the list</a>
