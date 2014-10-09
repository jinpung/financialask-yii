<?php

class m140915_005807_create_featuredAdviser_table extends CDbMigration
{
  public function up()
  {
    $this->createTable('AdviserFeatured', array(
      'id' => 'pk',
      'userId' => 'integer NOT NULL',
      'questionId' => 'integer NOT NULL',
      'datetime' => 'timestamp'));
	}

	public function down()
	{
    $this->dropTable('AdviserFeatured');
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
