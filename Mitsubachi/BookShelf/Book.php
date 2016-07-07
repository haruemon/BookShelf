<?php

namespace Mitsubachi\BookShelf;

class Book {
    
    /**
     * ISBN
     *
     * @var string
     */
    protected $isbn;

    /**
     * タイトル
     *
     * @var string
     */
    protected $title;

    /**
     * 著者
     *
     * @var string
     */
    protected $author;
    
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