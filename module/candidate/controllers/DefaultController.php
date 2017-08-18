<?php

namespace app\module\candidate\controllers;

use yii\web\Controller;

/**
 * Default controller for the `candidate` module
 */
class DefaultController extends Controller
{
	public function behaviors()
{
	return [
		'ghost-access'=> [
			'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
		],
	];
}
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
