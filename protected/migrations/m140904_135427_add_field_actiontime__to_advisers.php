<?php

class m140904_135427_add_field_actiontime__to_advisers extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Adviser::model()->tableName(),'actiontime','timestamp NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(Adviser::model()->tableName(),'actiontime');
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