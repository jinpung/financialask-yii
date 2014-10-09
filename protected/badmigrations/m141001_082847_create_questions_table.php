<?php

class m141001_082847_create_questions_table extends CDbMigration
{
	public function up()
	{
        
        $this->insert('Questions',array(
                'id' => 50,
                'userId' => 61,
                'title' => '',
                'content' => 'Would I be better off increasing my repayments to $2000 a month and owing nothing in five years, or keep the payment at interest only?',
                'datetime' => '2014-10-01 12:00:00',
                'categoryId' => 0,
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/loans-20140926-3gnvi.html#ixzz3ElQFRzUQ',
                 ));

		$this->insert('Questions',array(
                'id' => 51,
                'userId' => 61,
                'title' => '',
                'content' => 'Do you think it is a good idea to continue with Dividend Reinvestment Plans in the current market?',
                'datetime' => '2014-10-01 12:00:00',
                'categoryId' => 0,
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/loans-20140926-3gnvi.html#ixzz3ElQFRzUQ',
                 ));
                 
		$this->insert('Questions',array(
                'id' => 52,
                'userId' => 61,
                'title' => '',
                'content' => 'How do I buy my first home without having a high salary?',
                'datetime' => '2014-10-01 12:00:00',
                'categoryId' => 0,
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/loans-20140926-3gnvi.html#ixzz3ElQFRzUQ'
                 ));
                 
		$this->insert('Questions',array(
                'id' => 53,
                'userId' => 61,
                'title' => '',
                'content' => 'Should I rent or buy a property?',
                'datetime' => '2014-10-01 12:00:00',
                'categoryId' => 0,
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/loans-20140926-3gnvi.html#ixzz3ElQFRzUQ'
                 ));
                
		$this->insert('Questions',array(
                'id' => 54,
                'userId' => 61,
                'title' => '',
                'content' => 'What is the best way to plan for retirement?',
                'datetime' => '2014-10-01 12:00:00',
                'categoryId' => 0,
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/loans-20140926-3gnvi.html#ixzz3ElQFRzUQ'
                 ));
                 

	}

	public function down()
	{
		return true;
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
