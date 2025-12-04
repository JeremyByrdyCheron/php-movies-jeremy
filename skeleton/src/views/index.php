<?php ob_start();
redirectTo("movies") ?>


<?php
render('default', true, [
	'title' => 'Acceuil',
	'css' => 'index',
	'content' => ob_get_clean(),
]);
?>