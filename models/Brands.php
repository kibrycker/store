<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property int $id
 * @property string $name Название бренда
 * @property string $symbolik_name Символьный код названия
 * @property string $logo Логотип бренда
 * @property string $description Описание бренда
 * @property int $status Статус
 * @property string $date_create Дата создания
 * @property string $date_update Дата редактирования
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brands';
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
            'name' => 'Название бренда',
            'symbolik_name' => 'Символьный код названия',
            'logo' => 'Логотип бренда',
            'description' => 'Описание бренда',
            'status' => 'Статус',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата редактирования',
        ];
    }
}
