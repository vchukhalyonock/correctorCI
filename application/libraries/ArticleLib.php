<?php

require_once (APPPATH . 'third_party/phpQuery/phpQuery.php');
require_once (APPPATH . 'libraries/ArticlePage.php');

class ArticleLib {

    public function getArticle($articleURL) {
        return new ArticlePage($articleURL);
    }
}