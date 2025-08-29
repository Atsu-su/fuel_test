<?php

namespace Fuel\Migrations;

class Create_authors
{
	public function up()
	{
		\DBUtil::create_table('authors', array(
			'id' => array('constraint' => '11', 'type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true),
			'name' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
            'birthplace' => array('constraint' => 255, 'null' => true, 'type' => 'varchar'),
            'birthday' => array('null' => true, 'type' => 'date'),
			'created_at' => array('null' => false, 'type' => 'datetime'),
			'updated_at' => array('null' => false, 'type' => 'datetime'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('authors');
	}
}