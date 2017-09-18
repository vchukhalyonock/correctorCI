<?php


class Fb extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CorrectionsModel', 'corrections');
    }

    public function index() {
        $this->load->view('index');
    }


    public function results() {
        $this->load->view(
            'admin',
            [
                'corrections' => $this->corrections->getAll()
            ]
        );
    }


    public function setApproved() {
        if(!$this->input->is_ajax_request())
            show_404();

        if($this->input->post('id')){
            $this->corrections->setApproved($this->input->post('id'));
            $this->_ajaxResponse(['error' => false]);
        } else {
            $this->_ajaxResponse(['error' => true]);
        }
    }


    public function delete() {
        if(!$this->input->is_ajax_request())
            show_404();

        if($this->input->post('id')){
            $this->corrections->delete($this->input->post('id'));
            $this->_ajaxResponse(['error' => false]);
        } else {
            $this->_ajaxResponse(['error' => true]);
        }
    }

}