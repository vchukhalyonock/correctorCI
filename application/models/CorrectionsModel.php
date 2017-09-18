<?php

class CorrectionsModel extends CI_Model {

    private $_table = 'corrections';

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param $articleURL
     * @param $originText
     * @param $usersText
     * @return mixed
     */
    public function create($articleURL, $originalText, $usersText) {
        $this->db->insert(
            $this->_table,
            [
                'articleURL' => strval($articleURL),
                'originalText' => strval($originalText),
                'usersText' => strval($usersText)
            ]
        );

        return $this->db->insert_id();
    }


    /**
     * @param $id
     * @return bool
     */
    public function setApproved($id) {
        $this->db->update(
            $this->_table,
            [
                'isApproved' => 1
            ],
            [
                'id' => intval($id)
            ]
        );

        return true;
    }


    /**
     * @param $id
     * @return bool
     */
    public function delete($id) {
        $this->db->delete(
            $this->_table,
            ['id' => intval($id)]
        );

        return true;
    }
}