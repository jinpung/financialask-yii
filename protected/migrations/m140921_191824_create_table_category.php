<?php

class m140921_191824_create_table_category extends CDbMigration
{
	public function up()
	{
		$this->createTable('Category',array(
			'id'=>'pk',
			'parentId'=>'integer NOT NULL',
			'title'=>'string NOT NULL',
			'description'=>'text NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('Category');
	}
}