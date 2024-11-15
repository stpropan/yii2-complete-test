<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cities}}`.
 * Создание таблицы городов
 */
class m241115_195939_create_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(511)->notNull(),
            'country_id' => $this->integer()->notNull(),
        ]);

        // Добавление вторичного ключа
        $this->addForeignKey(
            'fk-cities_countries',
            '{{%cities}}',
            'country_id',
            '{{%countries}}',
            'id',
            // при удалении
            'CASCADE',
            // при обновлении
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }
}
