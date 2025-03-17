<?php

use yii\db\Migration;

class m250310_173305_add_data extends Migration
{
    /**
     * Генерируем случайные данные
     */
    public function safeUp()
    {
        for ($i=1; $i<=15; $i++) {
            $this->insert('author', ['id' => $i, 'fio' => 'author ' . $i]);
        }

        for ($i=1; $i<=100; $i++) {
            $this->insert(
                'book',
                [
                    'id' => $i,
                    'name' => 'book #' . $i,
                    'year' => ($i % 2 === 0) ? 2010 : 2020,
                    'isbn' => rand(1000000000, 9999999999999),
                    'img' => 'image' . rand(10000, 9999999) . '.jpg'
                ]
            );
            $this->insert(
                'storage',
                [
                    'book_id' => $i,
                    'quantity'=> ($i % 2 === 0) ? 0 : rand(1, 10),
                    'price'=> rand(500, 5000),
                ]
            );
        }

        for ($i=1; $i<=15; $i++) {
            $books = rand(1, 100);
            for ($j=1; $j<=$books; $j++) {
                $this->insert(
                    'author_book',
                    [
                        'author_id' => $i,
                        'book_id' => $j,
                    ]
                );
            }
        }


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo 'Удаление невозможно!';
        return false;
    }
}
