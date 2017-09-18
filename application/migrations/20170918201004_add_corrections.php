<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_corrections extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'articleURL' => ['type' => 'VARCHAR', 'constraint' => 1000],
            'originalText' => ['type' => 'TEXT'],
            'usersText' => ['type' => 'TEXT'],
            'isApproved' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0]
        ]);

        $this->dbforge->add_key('id', true);

        $this->dbforge->create_table('corrections', true);
    }


    public function down() {
        $this->dbforge->drop_table('corrections',TRUE);
    }
}