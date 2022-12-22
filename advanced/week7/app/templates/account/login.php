<h1 class="title mt-4">Login</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<section class="columns">
    <form class="column is-6" action="" method="post" enctype="multipart/form-data">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="email">Email</label>
            </div>
            <div class="field-body">
                <input class="input" id="email" type="email" name="email" value="<?= $email ?? ''; ?>"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="password">Password</label>
            </div>
            <div class="field-body">
                <input class="input" id="password" type="password" name="password"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal"></div>
            <div class="field-body">
                <button class="button is-primary is-fullwidth" type="submit" name="submit">Login</button>
            </div>
        </div>
    </form>
</section>

<a class="button mt-4" href="<?= BASE_PATH; ?>">&laquo; Go back to the homepage</a>
