<?php

class m140929_041349_create_table_question_response_thank extends CDbMigration
{
	public function up()
  {
            
    if (Yii::app()->db->schema->getTable('QuestionResponseThanks',true)===null) {
        $this->createTable('QuestionResponseThanks', array(
          'id'=>'pk',
          'responseId' => 'integer NOT NULL',
          'questionId'=>'integer NOT NULL',
          'adviserId'=>'integer NOT NULL',
          'userId'=>'integer NOT NULL',
          'datetime'=>'timestamp NOT NULL'
        ));
    } else {
        $this->dropTable('QuestionResponseThanks');
        $this->createTable('QuestionResponseThanks', array(
          'id'=>'pk',
          'responseId' => 'integer NOT NULL',
          'questionId'=>'integer NOT NULL',
          'adviserId'=>'integer NOT NULL',
          'userId'=>'integer NOT NULL',
          'datetime'=>'timestamp NOT NULL'
        ));
    }
	}

	public function down()
  {
    $this->dropTable('QuestionResponseThanks');
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
