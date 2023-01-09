<?php namespace MusicCollection\Handlers;

use MusicCollection\Databases\Objects\Genre;

/**
 * Class GenreHandler
 * @package MusicCollection\Handlers
 * @noinspection PhpUnused
 */
class GenreHandler extends BaseHandler
{
    use FillAndValidate\Genre;

    private Genre $genre;

    protected function index(): void
    {
        //Get all genres
        $genres = Genre::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Genres',
            'genres' => $genres,
            'totalGenres' => count($genres)
        ]);
    }

    protected function create(): void
    {
        //Set default empty genre & execute POST logic
        $this->genre = new Genre();
        $this->executePostHandler();

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Save the record to the db
            if ($this->genre->save()) {
                $success = 'Your new genre has been created in the database!';
                //Override to see a new empty form
                $this->genre = new Genre();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the genre';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create genre',
            'genre' => $this->genre,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit(): void
    {
        try {
            //Get the record from the db & execute POST logic
            $this->genre = Genre::getById($_GET['id']);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //Save the record to the db
                if ($this->genre->save()) {
                    $success = 'Your genre has been updated in the database!';
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the genre';
                }
            }

            $pageTitle = 'Edit ' . $this->genre->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->genre = new Genre();
            $this->errors[] = 'Whoops: ' . $e->getMessage();
            $pageTitle = 'Genre does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'genre' => $this->genre,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    protected function detail(): void
    {
        try {
            //Get the records from the db
            $genre = Genre::getById($_GET['id']);

            //Default page title
            $pageTitle = $genre->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $this->errors[] = $e->getMessage();
            $pageTitle = 'Genre does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'genre' => $genre ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        try {
            //Get the record from the db
            $genre = Genre::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB
                if (Genre::delete((int)$_GET['id'])) {
                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'genres');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete genre',
                'genre' => $genre,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //There is no delete template, always redirect.
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'genres');
            exit;
        }
    }
}
