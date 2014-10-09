<?php

class SiteController extends FrontController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl'
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform these actions
                'actions' => array('index', 'error', 'login', 'trylogin', 'logout', 'register', 'imagepreview', 'test', 'registerAdviser'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform these actions
                'actions' => array('settings', 'changeemail', 'changepwd'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = 'error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
            if ($error['code'] == 404) {
                $this->layout = 'main-ng';
                $this->render('error404', array('data' => $error));
            } else
                $this->render('error', array('data' => $error));
        }
    }

    /* displaying Settings page */

    public function actionSettings() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
            exit;
        }
        $this->render('settings', array(
            'currentUser' => Yii::app()->user->userModel
        ));
    }

    //change email for current logged in user
    public function actionChangeemail() {
        $data = $_POST;
        $currentUser = Yii::app()->user->userModel;
        if (!CPasswordHelper::verifyPassword($data['password'], $currentUser->password)) {
            die('Password is not correct.');
        }
        $checkingUser = User::model()->findByAttributes(array('email' => $data['email']));
        if (isset($checkingUser) && $checkingUser->id != $currentUser->id) {
            die('This email address is being used by another user.');
        }
        $user = User::model()->findByPK($currentUser->id);
        $user->email = $data['email'];
        $user->save();
        die('TRUE');
    }

    //change password for current logged in user
    public function actionChangepwd() {
        $data = $_POST;
        $currentUser = Yii::app()->user->userModel;
        if (!CPasswordHelper::verifyPassword($data['current_password'], $currentUser->password)) {
            die('Current password is not correct.');
        }
        $user = User::model()->findByPK($currentUser->id);
        $user->password = CPasswordHelper::hashPassword($data['password']);
        $user->save();
        die('TRUE');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionTrylogin(){
        $model = new LoginForm;

        // if it is ajax validation request
        //if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
        $result = CJSON::decode(CActiveForm::validate($model));
        echo CJSON::encode(array("success"=>count($result))); 
        Yii::app()->end();
       // }
        
    }

    /**
     * Displays the login page
     */
    public function actionForgetPassword() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegister() {
        $step = isset($_POST['RegisterForm']) && isset($_POST['RegisterForm']['step']) ?
                (int) $_POST['RegisterForm']['step'] : 1;
        $model = new RegisterForm('step' . $step);

        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            $file = CUploadedFile::getInstance($model, 'file');
            if (isset($file)) {
                $avatarUrl = '/images/avatars/' . md5(time()) . '.' . $file->getExtensionName();
                $fileName = Yii::app()->basePath . '/..' . $avatarUrl;
                if ($file->saveAs($fileName))
                    $model->avatarUrl = $avatarUrl;
            }
            if ($model->validate()) {
                $step++;
                $model->scenario = 'step' . $step;
                if ($step > RegisterForm::MAX_STEP) {
                    $password = $model->password;
                    if ($model->register()) {
                        $loginForm = new LoginForm();
                        $loginForm->email = $model->email;
                        $loginForm->password = $password;
                        if ($loginForm->validate() && $loginForm->login())
                            $this->redirect(array('index'));
                    }
                }
            }
        }
        $this->render('userSteps/_step' . $step, compact('model'));
    }

    public function actionImagepreview() {
        if (sizeof($_FILES) == 0) {
            echo CJSON::encode(array('status' => 'nofiles', 'message' => 'Only images are allowed'));
            die();
        }
        $files = array_keys($_FILES);        
        $file = $_FILES[$files[0]];
        if(is_array($file)){
           $fileName = $file['name']['file'];
           $fileExtension = (($pos=strrpos($fileName,'.'))!==false)?(string)substr($fileName,$pos+1):'';
           if (in_array(strtolower($fileExtension), array('jpeg', 'jpg', 'png', 'gif'))) {
                $avatarUrl = '/images/avatars/' . md5(time()) . '.' . $fileExtension;
                $filePath = Yii::app()->basePath . '/..' . $avatarUrl;
               if(move_uploaded_file($file['tmp_name']['file'], $filePath) == true){
                    echo CJSON::encode(array('status' => 'ok', 'message' => '', 'filename' => $avatarUrl));
               }
           }else{
               echo CJSON::encode(array('status' => 'error', 'message' => 'Only images are allowed'));
           }
        }
        die();
        /*
        $file = CUploadedFile::getInstanceByName($files[0] . '[file]');        
        if (isset($file)) {
            if (in_array(strtolower($file->getExtensionName()), array('jpeg', 'jpg', 'png', 'gif'))) {
                $avatarUrl = '/images/avatars/' . md5(time()) . '.' . $file->getExtensionName();
                $fileName = Yii::app()->basePath . '/..' . $avatarUrl;
                if ($file->saveAs($fileName))
                    $model->avatarUrl = $avatarUrl;
                echo CJSON::encode(array('status' => 'ok', 'message' => '', 'filename' => $avatarUrl));
            } else {
                echo CJSON::encode(array('status' => 'error', 'message' => 'Only images are allowed'));
            }
        }*/
        //die();
    }

    public function actionRegisterAdviser() {
        $step = isset($_POST['RegisterAdviserForm']) && isset($_POST['RegisterAdviserForm']['step']) ?
                (int) $_POST['RegisterAdviserForm']['step'] : 1;
        $model = new RegisterAdviserForm('step' . $step);
        if (isset($_POST['RegisterAdviserForm'])) {
            $model->attributes = $_POST['RegisterAdviserForm'];
            $file = CUploadedFile::getInstance($model, 'file');
            if (isset($file)) {
                $avatarUrl = '/images/avatars/' . md5(time()) . '.' . $file->getExtensionName();
                $fileName = Yii::app()->basePath . '/..' . $avatarUrl;
                if ($file->saveAs($fileName))
                    $model->avatarUrl = $avatarUrl;
            }
            if ($model->validate()) {
                $step++;
                $model->scenario = 'step' . $step;
                if ($step > RegisterAdviserForm::MAX_STEP) {
                    if ($model->register()) {
                        $this->render('welcome', compact('model'));
                        Yii::app()->end();
                    } else {
                        die('errer');
                    }
                }
            }
        }
        $this->render('adviserSteps/_step' . $step, compact('model'));
    }

    public function actionTest() {
       ;
    }

}
