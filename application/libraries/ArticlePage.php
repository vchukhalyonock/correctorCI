<?php
require_once (APPPATH . 'third_party/phpQuery/phpQuery.php');

class ArticlePage {

    private $title;
    private $paragraphs = [];
    private $document;

    public function __construct($articleURL) {
        $content = file_get_contents($articleURL);
        if($content) {
            $this->document = phpQuery::newDocument($content);
            if($this->document) {
                $this->_setTitle();
                $this->_setParagraphs();
            }
        }
    }

    private function _setTitle() {
        $matchTitle = $this->document->find('title');
        foreach ($matchTitle as $title) {
            $pq = pq($title);
            $this->title = $pq->text();
        }
    }


    private function _setParagraphs() {
        $match = $this->document->find("div[itemprop='articleBody'] > p");
        foreach ($match as $paragraph) {
            $pq = pq($paragraph);
            $this->paragraphs[] = $pq->text();
        }
    }

    public function getTitle() {
        return $this->title;
    }


    public function getParagraphs() {
        return $this->paragraphs;
    }
}
?>