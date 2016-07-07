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
    public function search($conditions)
    {
        $this->matchedBooks = [];
        $this->setSearchCondition($conditions);

        foreach($this->conditions as $searchTarget => $searchValue) {
            if($searchTarget === 'isbn') {
                $this->getIsbmSrarchResults($searchTarget);
            }
            if($searchTarget === 'title') {
                $this->getTitleSrarchResults($searchTarget);
            }
            if($searchTarget === 'author') {
                $this->getAuthorSrarchResults($searchTarget);
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
        $this->searchTargets = key($conditions);
    }

    /**
     * Get the Isbm search condition.
     *
     * @param string $searchTarget
     */
    public function getIsbmSrarchResults($searchTarget)
    {
        $this->getExactMatchSearch($searchTarget);
    }

    /**
     * Get the Isbm search results.
     *
     * @param string $searchTarget
     */
    public function getTitleSrarchResults($searchTarget)
    {
        $this->getLikeMatchSearch($searchTarget);
    }

    /**
     * Get the author search results.
     *
     * @param string $searchTarget
     */
    public function getAuthorSrarchResults($searchTarget)
    {
        $this->getLikeMatchSearch($searchTarget);
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