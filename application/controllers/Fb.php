<?php

use Restserver\Libraries\REST_Controller;

class Fb extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->library('ArticleLib');
    }

    public function index_get(){
        $this->articlelib->getArticle($this->get('articleURL'));
        echo $this->get('articleURL');
    }
}