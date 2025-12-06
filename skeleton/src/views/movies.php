<?php
ob_start() ?>

<h1>Ma Collection</h1>

<div class="movies">
    <?php
    foreach ($_SESSION['listMovies'] as $film) {
        $film = get_object_vars($film);
        $watched = $film['is_watched'] == 0 ? "A voir" : "Vu";
        echo "<div><h2> " . $film['title'] . "</h2><h3>" . $film['genre'] . "</h3><p>" . $film['type'] . "</p>" . $film['rating'] . " / 5<p></p><p>" . $watched . "</p></div>";
    } ?>
</div>
<form method="get">
    <label for="filter">Ne voir que les </label>
    <select required name="filter" id="filter">
        <option value="all">Tout</option>
        <option value="film">Films</option>
        <option required value="serie">Séries</option>
    </select>
    <button type="submit">Trier</button>
</form>
<form method="post">
    <label for="title">Titre</label>
    <input required type="text" name="title" id="title">
    <select required name="type">
        <option value="film">Film</option>
        <option required value="serie">Série</option>
    </select>
    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre">
    <label for="rating">Note / 5</label>
    <input type="number" name="rating" id="rating">
    <select required name="watched">
        <option value="yes">Déjà vu</option>
        <option required value="no">A voir</option>
    </select>
    <button type="submit" name="addBook">Ajouter à ma collection</button>

</form>

<?php
render('default', true, [
    'title' => 'films',
    'css' => 'style',
    'content' => ob_get_clean(),
]);
?>