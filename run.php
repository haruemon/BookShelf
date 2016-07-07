<?php

require_once('./Mitsubachi/BookShelf/Book.php');
require_once('./Mitsubachi/BookShelf/BookShelf.php');
require_once('./Mitsubachi/BookShelf/Faker.php');

$books = [];

$total = 100;

$replace = rand(0, $total);

for ($i=1; $i<=$total; $i++) {
    
    $book = new Mitsubachi\BookShelf\Book();
    
    if ($i === $replace) {
        $book->setIsbn('ISBN000-0-0000-0000-0');
    } else {
        $book->setIsbn(Mitsubachi\BookShelf\Faker::isbn());
    }
    
    $book->setTitle(Mitsubachi\BookShelf\Faker::title());
    $book->setAuthor(Mitsubachi\BookShelf\Faker::author());
    $books[] = $book;
}

$shelf = new Mitsubachi\BookShelf\BookShelf($books);

$book1 = $shelf->search(['isbn' => 'ISBN000-0-0000-0000-0'], [Mitsubachi\BookShelf\BookShelf::EXACT_MATCH_SEARCH]);
var_dump($book1);

echo '=====' . PHP_EOL;

$book2 = $shelf->search(['title' => 'オブジェクト指向'], [Mitsubachi\BookShelf\BookShelf::LIKE_MATCH_SEARCH]);
var_dump($book2);

echo '=====' . PHP_EOL;

$book3 = $shelf->search(['author' => 'Williams'], [Mitsubachi\BookShelf\BookShelf::LIKE_MATCH_SEARCH]);
var_dump($book3);




