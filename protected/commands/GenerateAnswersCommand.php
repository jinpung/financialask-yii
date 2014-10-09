<?php

class GenerateAnswersCommand extends CConsoleCommand
{
	const ROWS = 80;

	public function run($args)
	{
		for($i=0;$i<self::ROWS;$i++)
		{
			printf("Entering %d of %d\n",$i+1,self::ROWS);

			$r = new QuestionResponse();
			$r->questionID = $this->getRandomUnansweredQuestion();
			$r->userId = $this->getRandomUserId();
			$r->content = $this->getRandomText();
			$r->rate = mt_rand(1,5);
			$r->save(false);
		}
	}

	protected function getRandomUnansweredQuestion()
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand('SELECT t1.id FROM Questions t1
LEFT JOIN QuestionResponses t2 ON t1.id = t2.questionID
WHERE t2.id IS NULL');
		$command->execute();
		return $command->queryColumn()[0];
	}

	protected function getRandomText()
	{
		static $lines = array();
		do {
			if(!count($lines)) {
				$content = file_get_contents('http://loripsum.net/api/10/long/plaintext');
				$lines = preg_split('/[\n]+/', $content);
				unset($lines[0]);
			}
			$text = trim(array_pop($lines));
		} while(!strlen($text));

		return $text;
	}

	protected function getRandomUserId()
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand('select id from Users order by rand() limit 1');
		$command->execute();
		return $command->queryColumn()[0];
	}

}