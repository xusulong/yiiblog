<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/2
 * Time: 22:18
 */
namespace  frontend\controllers\base;
use yii\web\Controller;
class BaseController extends  Controller
{
    function beforeAction($action)
    {
         if(!parent::beforeAction($action))
         {
             return false ;
         }
         return true;
    }
}