<?php

namespace Mitsubachi\BookShelf;

class Book {

    const PROPERTY_ISBM = 10;
    const PROPERTY_TITLE = 20;
    const PROPERTY_AUTHOR = 30;

    /**
     * ISBN
     *
     * @var string
     */
    public $isbn;

    /**
     * タイトル
     *
     * @var string
     */
    public $title;

    /**
     * 著者
     *
     * @var string
     */
    public $author;

    public static $propatyLabels = [
        self::PROPERTY_ISBM => 'isbn',
        self::PROPERTY_TITLE => 'title',
        self::PROPERTY_AUTHOR => 'author',
    ];

    /**
     * Set the isbn.
     * 
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * Set the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set the author.
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    
}