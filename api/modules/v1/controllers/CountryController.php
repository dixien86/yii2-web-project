<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

/**
 * Country Controller API
 *
 * @author admin
 */
class CountryController extends ActiveController
{
  public function behaviors()
  {
    $behaviors = parent::behaviors();
    // remove authentication filter
    $auth = $behaviors['authenticator'];
    unset($behaviors['authenticator']);
    // add CORS filter
    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
        'cors' => [
          // restrict access to
          'Origin' => ['http://www.myserver.com', 'https://www.myserver.com'],
          'Access-Control-Request-Method' => ['POST', 'PUT'],
          // Allow only POST and PUT methods
          'Access-Control-Request-Headers' => ['X-Wsse'],
          // Allow only headers 'X-Wsse'
          'Access-Control-Allow-Credentials' => true,
          // Allow OPTIONS caching
          'Access-Control-Max-Age' => 3600,
          // Allow the X-Pagination-Current-Page header to be exposed to the browser.
          'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
        ]
    ];
	
	 $behaviors['contentNegotiator'] = [
        'class' => 'yii\filters\ContentNegotiator',
        'formats' => [
            'application/json' => Response::FORMAT_JSON,
        ]
    ];

    // re-add authentication filter
    $behaviors['authenticator'] = $auth;
    // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
    $behaviors['authenticator']['except'] = ['options'];
    return $behaviors;
  }

  public function actions()
  {
      $actions = parent::actions();
      // disable the "delete" action
      unset($actions['delete']);
      return $actions;
  }

  public $modelClass = 'api\modules\v1\models\Country';
  public $session = Yii::$app->session;


  public function actionPrepend($input){

      if (!isset($session['queue']) || count($session['queue'])==0)
      {
          $session['queue'] = array($input);
      }
      else {
         $myarray = $session['queue'];
         array_unshift($myarray, $input);
         $session['queue'] = $myarray;
      }
      return  $session['queue']; 
  }
  public function actionPop(){
     if(!isset($session['queue']) || count($session['queue'])==0){
         $myarray = $session['queue'];
         array_shift($myarray);
         $session['queue'] = $myarray; 
     }
     return  $session['queue'];
}

  public function actionAppend($input){
     if(!isset($session['queue']) || count($session['queue'])==0) {
         $myarray = $session['queue'];
         array_push($myarray,$input);
         $session['queue'] = $myarray;
     }

     return  $session['queue'];
  }

  public function actionEject(){
      if(!isset($session['queue']) || count($session['queue'])==0) {
          $myarray = $session['queue'];
          array_pop($myarray);
          $session['queue'] = $myarray;
      }
  }

  public function actionShow($order){
     return (!isset($session['queue']) || count($session['queue'])==0)  ? $session['queue'] : [];
  }


}
