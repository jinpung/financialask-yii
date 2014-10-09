<?php

class m140913_092738_feeds_delete_prev_question_answer_trigger extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('DROP TRIGGER IF EXISTS QuestionResponseInsert');
		$this->execute("CREATE TRIGGER `QuestionResponseInsert` AFTER INSERT ON `QuestionResponses`
 FOR EACH ROW BEGIN
  DELETE FROM FeedItems WHERE feedTypeID = 1 AND instID = NEW.questionID;
	INSERT INTO FeedItems SET feedTypeID = 2, instID = NEW.id, `datetime` = NEW.`datetime`;
END");
		return true;
	}

	public function safeDown()
	{
		return true;
	}
}