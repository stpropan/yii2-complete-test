<?php

use yii\db\Migration;

/**
 * Class m241115_205030_seed_database
 */
class m241115_205030_seed_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // данные со странами и их городами
        $countries_data = [
            1 => [
                'name' => 'Россия',
                'cities' => [
                    'Москва',
                    'Санкт-Петербург',
                    'Волгоград',
                    'Краснодар',
                    'Иваново',
                ],
            ],
            2 => [
                'name' => 'США',
                'cities' => [
                    'Вашингтон',
                    'Нью-Йорк',
                    'Калифорния',
                    'Алабама',
                    'Флорида',
                ],
            ],
            3 => [
                'name' => 'ЮАР',
                'cities' => [
                    'Кейптаун',
                    'Йоханнесбург',
                    'Дурбан',
                ],
            ],
            4 => [
                'name' => 'Австралия',
                'cities' => [
                    'Канберра',
                    'Сидней',
                    'Брисбен',
                ],
            ],
            5 => [
                'name' => 'Финляндия',
                'cities' => [
                    'Хельсинки',
                    'Турку',
                    'Лахти',
                ],
            ],
        ];

        // Перебирает массив стран
        foreach ($countries_data as $id => $country) {

            // Создает новую страну
            $this->insert('{{%countries}}', [
                'id' => $id, // id задается явно, чтобы не было ошибок с внешним ключом
                'name' => $country['name'],
            ]);
            
            // Перебирает массив городов
            foreach ($country['cities'] as $city) {

                // Создает новый город
                $this->insert('{{%cities}}', [
                    'name' => $city,
                    'country_id' => $id,
                ]);
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление данных из таблиц стран и городов
        $this->delete('{{%countries}}');
        $this->delete('{{%cities}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241115_205030_seed_database cannot be reverted.\n";

        return false;
    }
    */
}
