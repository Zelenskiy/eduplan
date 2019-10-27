<?php
include 'example.php';

//   https://www.php.net/manual/ru/simplexml.examples-basic.php

$movies = new SimpleXMLElement($xmlstr);

echo $movies->movie[0]->plot.'<br/>';
echo $movies->movie->{'great-lines'}->line.'<br/>';

/* Для каждого узла <character>, мы отдельно выведем имя <name>. */
foreach ($movies->movie->characters->character as $character) {
    echo $character->name, ' играет ', $character->actor, PHP_EOL.'<br/>';
}

?>