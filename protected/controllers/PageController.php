<?php

class PageController extends FrontController
{
	public function actionBlog()
	{
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array('categoryId'=>Page::TYPE_BLOG));
		$dataProvider = new CActiveDataProvider('Page',array(
			'criteria'=>$criteria
		));
		$this->render('blog',compact('dataProvider'));
	}

    public function actionBlog() {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('categoryId' => Page::TYPE_BLOG));
        $dataProvider = new CActiveDataProvider('Page', array(
            'criteria' => $criteria
        ));

        $this->render('blog', compact('dataProvider'));
    }

    public function actionNews() {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('categoryId' => Page::TYPE_NEWS));
        $dataProvider = new CActiveDataProvider('Page', array(
            'criteria' => $criteria
        ));
        $this->render('news', compact('dataProvider'));
    }

    public function actionView($id) {
        $model = Page::model()->findByPk($id);
        if (!$model)
            throw new CHttpException('404', 'Page not found');
        $this->render('view', compact('model'));
    }

}
