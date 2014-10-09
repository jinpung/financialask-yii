<?php

class m140929_030526_add_gcm_id_to_users extends CDbMigration
{
	public function up()
  {
    $this->addColumn(User::model()->tableName(), 'gcm_regid', 'text');
    
	}

	public function down()
	{
    $this->dropColumn(User::model()->tableName(), 'gcm_regid');
		return false;
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
