<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name Название категории
 * @property string $symbolik_name Символьный код названия
 * @property string $logo Логотип категории
 * @property string $description Описание категории
 * @property int $status Статус
 * @property string $date_create Дата создания
 * @property string $date_update Дата редактирования
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['logo', 'description'], 'string'],
            [['status'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['name', 'symbolik_name'], 'string', 'max' => 150],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название категории',
            'symbolik_name' => 'Символьный код названия',
            'logo' => 'Логотип категории',
            'description' => 'Описание категории',
            'status' => 'Статус',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата редактирования',
        ];
    }
}
