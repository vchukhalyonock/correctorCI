<?php

require (APPPATH . 'third_party/phpQuery/phpQuery.php');

class ArticleLib {

    private $_article = null;
    private $_content = false;

    public function getArticle($articleURL) {
        $document = phpQuery::newDocument($articleURL);
        $match = $document->find('main');
    }


    private function _getArticleTextFromContent() {

    }
}