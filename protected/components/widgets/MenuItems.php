<?php
Yii::import('system.web.widgets.CWidget');

class MenuItems extends CWidget {

	public $menuItems = array();

	public function init()
  {
    $isLogged = Yii::app()->user->userModel;
    $isAdviser = $isLogged && Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER;
    $isAdmin = $isLogged && Yii::app()->user->userModel->userTypeID == User::TYPE_ADMIN;
    $regUser = $isLogged && Yii::app()->user->userModel->userTypeID == User::TYPE_USER;
    $menuItems = array();
    if($isAdviser){
      $menuItems = array_merge($menuItems, array(
          array(
            'label'=>'New Questions',
            'link'=>array('/questions/unanswered'),
            'class'=>'fa-bullhorn fa-lx',
          )
      ));
    }
    if($isAdmin){
      $menuItems = array_merge($menuItems, array(
          array(
            'label'=>'Dashboard',
            'link'=>array('/dashboard'),
            'class'=>'fa-bolt fa-lx',
          )
      ));
    }
    if($isLogged){
    $menuItems = array_merge($menuItems, array(
				array(
					'label'=>'Talk to advisers',
					'link'=>array('/adviser/talk'),
					'class'=>'fa-users fa-lx'
				),
      ));
    }


    if(!$isAdviser){
      $menuItems = array_merge($menuItems, array(
			array(
				'label'=>'Ask a Question',
				'link'=>array('/questions/ask'),
				'class'=>'fa-question-circle fa-lx',
      )));
    }
    $menuItems = array_merge($menuItems, array(
        array(
          'label'=>'Advisers',
          'link'=>array('/adviser/index'),
          'class'=>'fa-list-alt fa-lx'
        ),
        array(
          'label'=>'Answers',
          'link'=>array('/questions/answered'),
          'class'=>'fa-check-square-o fa-lx fa-lx',
        ),
        array(
          'label'=>'Support',
          'link'=>'http://financialask.freshdesk.com',
          'class'=>' fa-info fa-lx',
          'options'=>array('target'=>'_blank')
        ),
      ));

    if($isLogged)
    {
      $menuItems = array_merge($menuItems,array(
        array(
          'label'=>'Learn',
          'link'=>array('/search'),
          'class'=>'fa-book fa-lx',
        ),

      ));
    }

    if(!$isAdviser && $isLogged)
    {
      $menuItems = array_merge($menuItems, array(
        array(
          'label'=>'My Advisers',
          'link'=>array('/adviser/my'),
          'class'=>'fa-list-alt fa-lx'
        ),
				array(
					'label'=>'My Questions',
					'link'=>array('/questions/my'),
					'class'=>'fa-history fa-lx'
				),
      ));
    }
		if($isAdviser)
		{
				$menuItems = array_merge($menuItems,array(
            /*array(
              'label'=>'My Tips',
              'link'=>array('/tip/my'),
              'class'=>' fa-folder fa-lx'
            ),*/
            array(
              'label'=>'My Answers',
              'link'=>array('/questions/myanswers'),
              'class'=>' fa-check fa-lx'
            ),
						array(
							'label'=>'My Profile',
							'link'=>array('/profile/view','id'=>Yii::app()->user->userModel->id),
							'class'=>'fa-user fa-lx'
						),
				));
    }
    if($isLogged)
    {
      $menuItems = array_merge($menuItems,array(
        array(
          'label'=>'My Notifications',
          'link'=>array('/notification/index'),
          'class'=>'fa-bolt fa-lx'
        ),
        array(
          'label'=>'My Settings',
          'link'=>array('/site/settings'),
          'class'=>'fa-gears fa-lx'
        ),
				array(
					'label'=>'Logout',
					'link'=>array('/site/logout'),
					'class'=>'fa-sign-out fa-lx'
				),
      ));
    }else
    {
      $menuItems = array_merge($menuItems, array(
				array(
					'label'=>'Register',
					'link'=>array('/site/register'),
					'class'=>' fa-edit fa-lx'
        ),
				array(
					'label'=>'Log in',
					'link'=>array('/site/login'),
					'class'=>'fa-key fa-lx'
				),
      ));

    }
    $this->menuItems = $menuItems;

	}
	public function run()
	{
		$innerLinkOps = array('class' => 'linkTitle');

    foreach ($this->menuItems as $item) {
      $opts = isset($item['options']) ? $item['options'] : array();
			echo CHtml::openTag('li');
			$inner = CHtml::openTag('i', array('class' => 'fa ' . $item['class'])) . CHtml::closeTag('i') .
				CHtml::openTag('span', $innerLinkOps) . $item['label'] . CHtml::closeTag('span');
			echo CHtml::link(
				$inner,
				$item['link'], $opts
			);
			echo CHtml::closeTag('li');
		}
	}
} 
