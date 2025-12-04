<?php
ob_start() ?>


<h1>Ma Collection</h1>

<?php

foreach ($_SESSION['listMovies'] as $film) {
    $film = get_object_vars($film);
    // est censé afficher toutes les informations des films
    $watched = $film['is_watched'] == 0 ? "A voir" : "Vu";
    echo "<div><h2> " . $film['title'] . "</h2><h3>" . $film['genre'] . "</h3><p>" . $film['type'] . "</p>" . $film['rating'] . " / 5<p></p><p>" . $watched . "</p><div>";
} ?>
<form method="get">
    <label for="filter">Ne voir que les </label>
    <select required name="filter">
        <option value="all">Tout</option>
        <option value="film">Films</option>
        <option required value="serie">Séries</option>
    </select>
    <button type="submit">Trier</button>
</form>
<form method="post">
    <label for="title">Titre</label>
    <input required type="text" name="title">
    <select required name="type">
        <option value="film">Film</option>
        <option required value="serie">Série</option>
    </select>
    <label for="genre">Genre</label>
    <input type="text" name="genre">
    <label for="rating">Note / 5</label>
    <input type="number" name="rating">
    <select required name="watched">
        <option value="yes">Oui</option>
        <option required value="no">Non</option>
    </select>
    <button type="submit" name="addBook">Ajouter à ma collection</button>

</form>

<?php
render('default', true, [
    'title' => 'films',
    'css' => 'index',
    'content' => ob_get_clean(),
]);
?>