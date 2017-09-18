<?php

use Restserver\Libraries\REST_Controller;

class Article extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->library('ArticleLib');
    }

    public function index_get() {
        $articlePage = $this->articlelib->getArticle($this->get('url'));
        $this->response([
            'title' => $articlePage->getTitle(),
            "paragraphs" => $articlePage->getParagraphs()
        ]);
    }
}