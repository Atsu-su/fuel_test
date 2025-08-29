<?php

namespace Fuel\Migrations;

class Create_books
{
    const TABLE_NAME = 'books';

	public function up()
	{
		\DBUtil::create_table(self::TABLE_NAME, array(
			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
			'title' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
			'author_id' => array('constraint' => '11', 'type' => 'int', 'unsigned' => true, 'null' => false),
			'published_date' => array('null' => false, 'type' => 'date'),
			'description' => array('null' => false, 'type' => 'text'),
			'created_at' => array('null' => false, 'type' => 'datetime'),
			'updated_at' => array('null' => false, 'type' => 'datetime'),
		), array('id'));

        \DBUtil::add_foreign_key(self::TABLE_NAME, array(
                'constraint' => 'foreignkey_'.self::TABLE_NAME.'_author_id',
				'key' => 'author_id',
				'reference' => array(
					'table' => 'authors',
					'column' => 'id',
                ),
				'on_delete' => 'RESTRICT', // 紐づくレコードがある限り、参照元の削除はNG
                'on_update' => 'CASCADE',
            ));
	}

	public function down()
	{
        \DBUtil::drop_foreign_key(self::TABLE_NAME, 'foreignkey_'.self::TABLE_NAME.'_author_id');
		\DBUtil::drop_table(self::TABLE_NAME);
	}
}