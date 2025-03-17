<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $fio
 *
 * @property AuthorBook[] $authorBooks
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio'], 'default', 'value' => null],
            [['fio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
        ];
    }

    /**
     * Gets query for [[AuthorBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBooks()
    {
        return $this->hasMany(AuthorBook::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->viaTable('author_book', ['author_id' => 'id']);
    }

    /**
     * Метод возвращает ТОП 10 авторов,
     * которые издали бюольше всего книг, за конкретный год.
     */
    public function getTopAuthors(int $year): array
    {
        return self::find()
            ->select('author.fio, COUNT(book.id) as total')
            ->leftJoin('author_book', 'author_book.author_id = author.id')
            ->leftJoin('book', 'book.id = author_book.book_id')
            ->where('year = :year', ['year' => $year])
            ->groupBy('author.id')
            ->having('COUNT(book.id) > 0')
            ->orderBy('COUNT(book.id) DESC')
            ->asArray()
            ->all();
    }

    public static function getDataToCheckbox(): array
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'fio');
    }
}
