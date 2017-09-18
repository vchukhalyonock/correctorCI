<?php

class MY_Controller extends CI_Controller {

    protected function _ajaxResponse($response = array()) {
        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode(
                    $response
                )
            );
    }
}