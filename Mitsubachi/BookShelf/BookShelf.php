<?php

namespace Mitsubachi\BookShelf;

class BookShelf extends Book
{
    /**
     * Bookオブジェクトの配列
     *
     * @var array
     */
    private $books;

    /**
     * 検索条件
     *
     * @var array
     */
    protected $searchTarget;

    /**
     * 検索値
     *
     * @var array
     */
    protected $searchValue;

    /**
     * 検索結果
     *
     * @var array
     */
    protected $matchedBooks;

    /**
     * BookShelf constructor.
     *
     * @param array $books
     */
    public function __construct($books)
    {
        $this->books = $books;
    }

    /**
     * 蔵書を検索し、条件に一致するBookオブジェクトの配列を返す
     * 
     * @param array $conditions
     * @return array
     */
    public function search($conditions)
    {
        $this->conditions = $conditions;
        //$this->setSearchCondition($conditions);

        foreach($this->books as $book) {
            $this->getExactMatchSearch($book);
        }

        return $this->matchedBooks;
    }

    /**
     * Set the search condition.
     *
     * @param string $title
     */
//    public function setSearchCondition($conditions)
//    {
//        $this->conditions = $conditions;
//    }

    /**
     * Set the search condition.
     *
     * @param string $title
     */
    public function getExactMatchSearch($book)
    {
        foreach($this->conditions as $searchTarget => $searchValue) {
            if($book->$searchTarget === $searchValue) {
                $this->matchedBooks[] = $book;
            }
        }
    }
}