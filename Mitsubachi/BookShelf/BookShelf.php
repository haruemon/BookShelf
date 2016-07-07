<?php

namespace Mitsubachi\BookShelf;

class BookShelf extends Book
{
    const EXACT_MATCH_SEARCH = 10;
    const LIKE_MATCH_SEARCH = 20;

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
    private $searchTargets;

    /**
     * 検索値
     *
     * @var array
     */
    private $searchValues;

    /**
     * 検索結果
     *
     * @var array
     */
    private $matchedBooks;

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
     *        array $searchPatterns
     * @return array
     */
    public function search($conditions, $searchPatterns)
    {
        $this->matchedBooks = [];
        $this->setSearchCondition($conditions);
        foreach($this->searchTargets as $searchTarget) {
            if(in_array(self::EXACT_MATCH_SEARCH, $searchPatterns)) {
                $this->getExactSearchResults($searchTarget);
            }
            if(in_array(self::LIKE_MATCH_SEARCH, $searchPatterns)) {
                $this->getLikeSearchResults($searchTarget);
            }
        }

        return $this->matchedBooks;
    }

    /**
     * Set the search condition.
     *
     * @param array $conditions
     */
    public function setSearchCondition($conditions)
    {
        $this->conditions = $conditions;
        $this->searchTargets = array_keys($conditions);
    }

    /**
     * Set the exact match search result.
     *
     * @param array $searchTarget
     */
    public function getExactSearchResults($searchTarget)
    {
        foreach($this->books as $book) {
            if(in_array($book->$searchTarget, (Array)$this->conditions[$searchTarget])) {
                $this->matchedBooks[] = $book;
            }
        }
    }

    /**
     * Set the like match search result.
     *
     * @param array $searchTarget
     */
    public function getLikeSearchResults($searchTarget)
    {
        foreach($this->books as $book) {
            foreach((Array)$this->conditions[$searchTarget] as $searchValue) {
                if(strstr($book->$searchTarget, $searchValue)) {
                    $this->matchedBooks[] = $book;
                }
            }
        }
    }
}