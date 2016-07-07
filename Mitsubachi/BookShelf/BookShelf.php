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
    protected $searchTargets;

    /**
     * 検索値
     *
     * @var array
     */
    protected $searchValues;

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
    public function search($conditions, $searchPatterns)
    {
        $this->matchedBooks = [];
        $this->setSearchCondition($conditions);
        foreach($this->searchTargets as $searchTarget) {
            if(in_array(self::EXACT_MATCH_SEARCH, $searchPatterns)) {
                $this->getExactMatchSearch($searchTarget);
            }
            if(in_array(self::LIKE_MATCH_SEARCH, $searchPatterns)) {
                $this->getLikeMatchSearch($searchTarget);
            }
        }

        return $this->matchedBooks;
    }

    /**
     * Set the search condition.
     *
     * @param string $title
     */
    public function setSearchCondition($conditions)
    {
        $this->conditions = $conditions;
        $this->searchTargets = array_keys($conditions);
    }

    /**
     * Set the exact match search result.
     *
     * @param string $searchTarget
     */
    public function getExactMatchSearch($searchTarget)
    {
        foreach($this->books as $book) {
            if($book->$searchTarget === $this->conditions[$searchTarget]) {
                $this->matchedBooks[] = $book;
            }
        }
    }

    /**
     * Set the like match search result.
     *
     * @param string $searchTarget
     */
    public function getLikeMatchSearch($searchTarget)
    {
        foreach($this->books as $book) {
            if(strstr($book->$searchTarget, $this->conditions[$searchTarget])) {
                $this->matchedBooks[] = $book;
            }
        }
    }
}