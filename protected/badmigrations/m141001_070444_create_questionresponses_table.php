<?php

class m141001_070444_create_questionresponses_table extends CDbMigration
{
	public function up()
	{	
           
        $this->insert('QuestionResponses',array(
                'id' => 50,
                'questionID' => 50,
                'userId' => 50,
                'imgUrl' => '/images/stockphotos/stockimage_loansshop.jpg',
                'brief' => '',
                'content' => 'There is not much tax to be saved by keeping the loan going, in view of your low income, and I have no objections to your increasing the repayments. ',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/loans-20140926-3gnvi.html#ixzz3ElQFRzUQ'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 51,
                'questionID' => 51,
                'userId' => 50,
                'imgUrl' => '/images/stockphotos/stockimage_piggyncash.jpg',
                'brief' => 'Dividend reinvestment',
                'content' => 'I’ve always been a fan of DRPs, because it maximises the compounding effect... You are the only person who can decide whether a share is overpriced, and if so, whether you should divert its dividend to an alternative area.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/dividend-reinvestment-plans-20140926-3gnvj.html#ixzz3ElTeYCWu'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 52,
                'questionID' => 52,
                'userId' => 51,
                'imgUrl' => '/images/stockphotos/stockimage_housepaperwork.jpg',
                'brief' => 'Property',
                'content' => 'Opening up a First Home Saver Account (FHSA), so you can get a 22.5 per cent return on your savings (plus, your earnings are taxed at 15 per cent, rather than your marginal rate).',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://barefootinvestor.com/first-home-buying-plan/'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 53,
                'questionID' => 53,
                'userId' => 51,
                'imgUrl' => '/images/stockphotos/stockimage_moneyhouse.jpg',
                'brief' => 'Property',
                'content' => 'I’m a strong believer in home ownership, for all the reasons I’ve already listed. But here’s the real point: I’m wary of having all my eggs in the one basket — or bucket. ',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://barefootinvestor.com/renting-vs-buying-lets-look-home-truths/'
                 ));
                 
		$this->insert('QuestionResponses',array(
                'id' => 54,
                'questionID' => 54,
                'userId' => 50,
                'imgUrl' => '/images/stockphotos/stockimage_retirementcash.jpg',
                'brief' => 'Retirement',
                'content' => 'Take advice about low-cost index funds – by definition the index can never go broke and historically it has never failed to reach a new high after a low.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/planning-for-retirement-20140715-3bz62.html'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 55,
                'questionID' => 55,
                'userId' => 50,
                'imgUrl' => '/images/stockphotos/stockimage_house_money.jpg',
                'brief' => 'Property',
                'content' => 'In my view, buying off the plan is extremely risky and in any event an investment should never be made for the tax benefits. The tax benefits, if any, should be treated as the cream on the cake.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/hecs-before-mortgage-20100528-wix3.html'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 56,
                'questionID' => 56,
                'userId' => 50,
                'imgUrl' => '/images/stockphotos/stockimage_restingongrass.jpg',
                'brief' => 'Building',
                'content' => 'I agree that paying off the HECS debt is a good investment because you are getting an immediate 10% return on your money. ',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/hecs-before-mortgage-20100528-wix3.html'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 57,
                'questionID' => 57,
                'userId' => 51,
                'imgUrl' => '/images/stockphotos/stockimage_deskworkerclock.jpg',
                'brief' => 'Tax',
                'content' => 'No, but you will earn more money. All the income you earn is scooped up into the one bucket and taxed accordingly.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://barefootinvestor.com/millionaire-hot-seat-answer-questions/'
                 ));
                 
		$this->insert('QuestionResponses',array(
                'id' => 58,
                'questionID' => 58,
                'userId' => 51,
                'imgUrl' => '/images/stockphotos/stockimage_seniorcitizensbench.jpg',
                'brief' => 'Retirement',
                'content' => 'The pension provides a couple with around $30,000 a year, but for a comfortable retirement the latest thinking says you’ll need about double that...',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://barefootinvestor.com/question-time/'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 59,
                'questionID' => 59,
                'userId' => 50,
                'imgUrl' => '/images/stockphotos/stockimage_eggsbasket2.jpg',
                'brief' => 'Investment',
                'content' => 'The easiest way is to buy an index fund. A good one is offered by State Street and its ASX code is STW.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/starting-off-20140506-37t8k.html'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 60,
                'questionID' => 60,
                'userId' => 60,
                'imgUrl' => '/images/stockphotos/stockimage_orangepiggybank.jpg',
                'brief' => 'Wealth Building',
                'content' => 'I think you should continue to save furiously, but take the time to research the market in depth so you will know a bargain when you see one',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/buy-or-save-up-20140521-38nln.html'
                 ));
		$this->insert('QuestionResponses',array(
                'id' => 61,
                'questionID' => 61,
                'userId' => 61,
                'imgUrl' => '/images/stockphotos/stockimage_savingsaheadsign.jpg',
                'brief' => 'Superannuation',
                'content' => 'A balanced comparison of super funds is not a straightforward process – and certainly not as simple as some of those superficial ads on television might lead you to believe. I urge you to talk to a good adviser to find a fund that is suitable for your own circumstances',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/industry-super-funds-20140506-37t8c.html'
                 ));
                 
		$this->insert('QuestionResponses',array(
                'id' => 62,
                'questionID' => 62,
                'userId' => 62,
                'imgUrl' => '/images/stockphotos/stockimage_stocksheet.jpg',
                'brief' => 'Investment',
                'content' => 'I much prefer investment bonds (don\'t confuse them with government bonds), which are a tax paid investment.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/investing-for-a-child-20140313-34nxh.html'
                 ));
                 
                 
		$this->insert('QuestionResponses',array(
                'id' => 63,
                'questionID' => 63,
                'userId' => 63,
                'imgUrl' => '/images/stockphotos/stockimage_taxes_cash.jpg',
                'brief' => 'Tax',
                'content' => 'Unless you are working for an overseas aid organisation, your income is taxable in Australia because your family is living there.',
                'rate' => '',
                'datetime' => '2014-10-01 12:00:00',
                'summary' => '',
                'refURL' => 'http://www.theage.com.au/money/ask-an-expert/blogs/ask-an-expert/paying-tax-when-working-overseas-20140429-37ffo.html'
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
