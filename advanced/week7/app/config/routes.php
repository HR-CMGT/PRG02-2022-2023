<?php

function getRoutes(): array
{
    return [
        '' => 'HomeHandler@index',
        'artists' => 'ArtistHandler@index',
        'artists/detail' => 'ArtistHandler@detail',
        'artists/create' => 'ArtistHandler@create',
        'artists/edit' => 'ArtistHandler@edit',
        'artists/delete' => 'ArtistHandler@delete',
        'albums' => 'AlbumHandler@index',
        'albums/detail' => 'AlbumHandler@detail',
        'albums/create' => 'AlbumHandler@create',
        'albums/edit' => 'AlbumHandler@edit',
        'albums/delete' => 'AlbumHandler@delete',
        'genres' => 'GenreHandler@index',
        'genres/detail' => 'GenreHandler@detail',
        'genres/create' => 'GenreHandler@create',
        'genres/edit' => 'GenreHandler@edit',
        'genres/delete' => 'GenreHandler@delete',
        'user/login' => 'AccountHandler@login',
        'user/logout' => 'AccountHandler@logout',
        'user/register' => 'AccountHandler@register'
    ];
}
