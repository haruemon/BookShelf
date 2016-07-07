<?php

require_once('./Mitsubachi/BookShelf/Book.php');
require_once('./Mitsubachi/BookShelf/BookShelf.php');
require_once('./Mitsubachi/BookShelf/Faker.php');

use Mitsubachi\BookShelf\BookShelf as BookShelf;
use Mitsubachi\BookShelf\Book as Book;
use Mitsubachi\BookShelf\Faker as Faker;

$books = [];

$total = 100;

$replace = rand(1, $total);

for ($i=1; $i<=$total; $i++) {
    
    $book = new Book();
    
    if ($i === $replace) {
        $book->setIsbn('ISBN000-0-0000-0000-0');
    } else {
        $book->setIsbn(Faker::isbn());
    }
    
    $book->setTitle(Faker::title());
    $book->setAuthor(Faker::author());
    $books[] = $book;
}

$shelf = new BookShelf($books);

$book1 = $shelf->search([Book::$propatyLabels[Book::PROPERTY_ISBM] => 'ISBN000-0-0000-0000-0'], [BookShelf::EXACT_MATCH_SEARCH]);
var_dump($book1);

echo '=====' . PHP_EOL;

$book2 = $shelf->search([Book::$propatyLabels[Book::PROPERTY_TITLE] => 'オブジェクト指向'], [BookShelf::LIKE_MATCH_SEARCH]);
var_dump($book2);

echo '=====' . PHP_EOL;

$book3 = $shelf->search([Book::$propatyLabels[Book::PROPERTY_AUTHOR] => 'Williams'], [BookShelf::LIKE_MATCH_SEARCH]);
var_dump($book3);




