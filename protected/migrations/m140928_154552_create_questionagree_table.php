<?php

class m140928_154552_create_questionagree_table extends CDbMigration
{
	public function up()
	{
            if (Yii::app()->db->schema->getTable('QuestionAgree',true)===null) {
                $this->createTable('QuestionAgree', array(
			'id' => 'pk',
			'responseID' => 'int(11) NOT NULL',
			'adviserId' => 'int(11) NOT NULL',
			'datetime' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
		));
		$this->insert('QuestionAgree',array(
                        'id' => 1,
			'responseID' => 27,
			'adviserId' => 19,
			'datetime' => '2014-09-04 05:55:20',
                 ));
                 $this->insert('QuestionAgree',array(
                        'id' => 2,
			'responseID' => 27,
			'adviserId' => 20,
			'datetime' => '2014-09-04 06:21:48',
                 ));
            } else {
                $this->dropTable('QuestionAgree');
		$this->createTable('QuestionAgree', array(
			'id' => 'pk',
			'responseID' => 'int(11) NOT NULL',
			'adviserId' => 'int(11) NOT NULL',
			'datetime' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
		));
		$this->insert('QuestionAgree',array(
                        'id' => 1,
			'responseID' => 27,
			'adviserId' => 19,
			'datetime' => '2014-09-04 05:55:20',
                 ));
                 $this->insert('QuestionAgree',array(
                        'id' => 2,
			'responseID' => 27,
			'adviserId' => 20,
			'datetime' => '2014-09-04 06:21:48',
                 ));
            }
		return true;
	}
        
        

	public function down()
	{
		$this->dropTable('QuestionAgree');
		return true;
	}
}