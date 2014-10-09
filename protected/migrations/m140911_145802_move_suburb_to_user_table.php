<?php

class m140911_145802_move_suburb_to_user_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn(User::model()->tableName(),'suburb','string NOT NULL');
		$this->dropColumn(Adviser::model()->tableName(),'suburb');
	}

	public function down()
	{
		$this->addColumn(Adviser::model()->tableName(),'suburb','string NOT NULL');
		$this->dropColumn(User::model()->tableName(),'suburb');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}