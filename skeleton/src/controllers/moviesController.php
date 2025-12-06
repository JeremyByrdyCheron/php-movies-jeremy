<?php

session_start();

$error = [];


use Models\Movie;

$movies = new Movie();


if (isset($_POST['addBook']) && isset($_POST['title']) && isset($_POST['type']) && isset($_POST['watched'])) {
    if (strlen($_POST['title']) < 255 && strlen($_POST['title']) > 0) {
        $title = htmlspecialchars($_POST['title']);

    }

    if ($_POST['type'] == 'serie' || $_POST['type'] == 'film') {
        $type = $_POST['type'];
    } else {
        $error['type'] = 'Le type doit être "film" ou "serie".';
    }

    if ($_POST['watched'] == 'yes' || $_POST['watched'] == 'no') {
        $watched = $_POST['watched'] == 'yes' ? 1 : 0;
    }
    if ($_POST['rating'] < 5 && $_POST['rating'] > 0) {
        $rating = $_POST['rating'];
    }



    if (isset($title)) {
        if (isset($type)) {
            $movies->addFilm($title, $type, htmlspecialchars($_POST['genre']), $watched, $rating);
        } else {
            $error['type'] = 'Le type ne peut être que film ou serie';
        }
    } else {
        $error['title'] = 'Le titre ne doit pas dépasser les 255 caractères';
    }
}
if (isset($_GET['filter'])) {
    $listMovies = $_GET['filter'] == 'all' ? $movies->getAll() : $movies->getAllByType($_GET['filter']);
} else {
    $listMovies = $movies->getAll();

}



$_SESSION['listMovies'] = $listMovies;
render('movies', false, [
    'error' => $error,

]);
