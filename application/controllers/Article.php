<?php

use Restserver\Libraries\REST_Controller;

class Article extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->library('ArticleLib');
        $this->load->model('CorrectionsModel', 'corrections');
    }

    public function index_get() {
        $articlePage = $this->articlelib->getArticle($this->get('url'));
        $this->response([
            'title' => $articlePage->getTitle(),
            "paragraphs" => $articlePage->getParagraphs()
        ]);
    }


    public function index_post(){
        $req = $this->input->raw_input_stream;
        $requestJSON = json_decode($req);
        if(!$requestJSON) {
            $this->response(['error' => 'Invalid JSON'], 400);
        } elseif(isset($requestJSON->articleURL) && isset($requestJSON->originalText) && isset($requestJSON->usersText)) {
            $recordId = $this->corrections->create($requestJSON->articleURL, $requestJSON->originalText, $requestJSON->usersText);
            $this->response([
                'id' => $recordId
            ]);
        } else {
            $this->response(['error' => 'Bad Request'], 400);
        }
    }
}