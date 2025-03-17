<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "storage".
 *
 * @property int $id
 * @property int|null $book_id
 * @property int $quantity
 * @property int|null $price
 *
 * @property Book $book
 */
class Storage extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'storage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'price'], 'default', 'value' => null],
            [['quantity'], 'default', 'value' => 0],
            [['book_id', 'quantity', 'price'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Идентификатор книги',
            'quantity' => 'Количество',
            'price' => 'Цена',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

}
