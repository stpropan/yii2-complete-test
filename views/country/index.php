<?php

use app\models\Country;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\CountrySearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Страны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-6">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    [
                        'label' => 'name',
                        'content' => function (Country $country) {
                            return '<button class="btn btn-primary" data-country-id="' . $country->id . '">'
                                . $country->name
                                . '</button>';
                        },
                    ],
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, Country $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //      }
                    // ],
                ],
            ]); ?>
        </div>
        <div class="d-none col-6" id="cities">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Города
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!--
                    Пример того, что будет по итогу
                    <tr>
                        <td>Москва</td>
                    </tr>
                    <tr>
                        <td>Санкт-Петербург</td>
                    </tr>
                    -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="/dist/js/countries.js"></script>