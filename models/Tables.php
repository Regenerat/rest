<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $sits
 *
 * @property Bookings[] $bookings
 */
class Tables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'sits'], 'required'],
            [['description'], 'string'],
            [['sits'], 'integer'],
            [['name'], 'string', 'max' => 511],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'sits' => 'Sits',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Bookings::class, ['table_id' => 'id']);
    }
}
