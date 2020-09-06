<?php

$app->get('/activate', function() use ($app) {
	echo 'Activate';
})->name('activate');