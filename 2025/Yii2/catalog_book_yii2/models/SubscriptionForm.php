<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SubscriptionForm extends Model
{
    public $telNumber;
    public $bookId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['telNumber', 'bookId'], 'required'],
            [['telNumber', 'bookId'], 'integer'],
            // упрощаем валидацию
            [['telNumber'], 'integer', 'min' => 10000],
            [['telNumber'], 'integer', 'max' => 999999999]
        ];
    }

     
    public function attributeLabels()
    {
        return [
            'telNumber' => 'Номер телефона',
            'bookId' => 'ID Книги',
        ];
    }
}
