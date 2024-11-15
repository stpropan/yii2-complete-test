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
        <div class="col-md-6">
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
        <div class="d-none col-md-6" id="cities">
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
<script>
    // Ожидание загрузки jQuery
    window.addEventListener('load', () => {
        
        // Таблица городов
        const citiesTable = $('#cities');
        
        // Кнопки стран
        const countries = $('[data-country-id]');

        // Событие по клику на страны
        countries.click((e) => {
            e.preventDefault();

            // Получение кнопки, на которую был добавлен хендлер
            const button = $(e.currentTarget);
            
            // Удаление запрета на нажатие для всех кнопок стран
            countries.removeClass('disabled');
            countries.attr('disabled', null);

            // Запрет на нажатие текущей нажатой кнопки
            button.addClass('disabled');
            button.attr('disabled', true);

            // Получение id из дата атрибута
            const countryId = e.currentTarget.dataset.countryId;

            // Отправление запроса на сервер, чтобы узнать города
            $.ajax({
                url: '/country/cities?id=' + countryId,
                method: 'GET',
                success: function (response) {

                    // Приведение JSON строки к JS объекту
                    const data = JSON.parse(response);
                    
                    // Если дата валидно преобразовалась в массив
                    if (Array.isArray(data)) {
                        let htmlData = '';
                        
                        // Для каждого города
                        data.forEach((city) => {
                        
                            // Создание строки таблицы
                            htmlData += '<tr><td>' + city.name + '</td></tr>'
                        
                        });

                        // Добавление контента в таблицу
                        citiesTable.find('tbody').html(htmlData);

                        // Появление таблицы
                        citiesTable.removeClass('d-none');
                    }
                }
            });
        });
    })
</script>
