<?php

namespace app\controllers;

use app\models\City;
use app\models\CitySearch;
use app\models\Country;
use app\models\CountrySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                // 'verbs' => [
                //     'class' => VerbFilter::className(),
                //     'actions' => [
                //         'delete' => ['POST'],
                //     ],
                // ],
            ]
        );
    }

    /**
     * Lists all Country models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Страны
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCities($id)
    {
        // получение всех городов заданной страны
        $cities = Country::findOne($id)->getCities()->all();
        
        // приведение к однотипному массиву
        $data = ArrayHelper::toArray($cities, [
            City::class => [
                'id',
                'name'
            ]
        ]);

        // Установка заголовков на json формат
        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;

        // Отправление без шаблона
        // Кодировка строки происходит внутри шаблона
        return $this->renderPartial('ajaxResponse', [
            'data' => $data,
        ]);
    }
}
