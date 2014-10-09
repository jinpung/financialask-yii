<?php

class m140921_202615_add_field_category_to_question extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Question::model()->tableName(),'categoryId','integer NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(Question::model()->tableName(),'categoryId');
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