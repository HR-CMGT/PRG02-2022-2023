<?php namespace MusicCollection\Handlers;

/**
 * Class HomeHandler
 * @package MusicCollection\Handlers
 * @noinspection PhpUnused
 */
class HomeHandler extends BaseHandler
{
    protected function index(): void
    {
        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Welcome to this music collection!'
        ]);
    }
}
