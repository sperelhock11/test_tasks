<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property string $isbn
 * @property string $img
 *
 * @property AuthorBook[] $authorBooks
 * @property Author[] $authors
 * @property Storage[] $storages
 */
class Book extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'year', 'isbn', 'img'], 'required'],
            [['year'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 17],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название книги',
            'year' => 'Год издания',
            'isbn' => 'ISBN',
            'img' => 'Обложка',
        ];
    }

    /**
     * Gets query for [[AuthorBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBooks()
    {
        return $this->hasMany(AuthorBook::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable('author_book', ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Storages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStorages()
    {
        return $this->hasMany(Storage::class, ['book_id' => 'id']);
    }

    public function getAvailableAuthors(): array 
    {
        $ids = [];
        foreach ($this->getAuthors()->all() as $el) {
            $ids[] = $el->id;
        }

        return $ids;
    }
}
