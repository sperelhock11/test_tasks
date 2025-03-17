<?php

use yii\db\Migration;

class m250310_163406_new_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'book',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(255)->notNull(),
                'year' => $this->integer()->notNull(),
                'isbn' => $this->string(17)->notNull(),
                'img' => $this->string(255)->notNull()
            ]
        );

        $this->createTable(
            'subscription',
            [
                'id' => $this->primaryKey(),
                'phone'=> $this->bigInteger()->notNull(),
                'book_id' => $this->integer(),
                'is_send'=> $this->boolean()->defaultValue(false),
            ]
        );

        $this->createIndex(
            'idx-subscription-book_id',
            'subscription',
            'book_id'
        );

        $this->addForeignKey(
            'fk-subscription-book_id',
            'subscription',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->createTable(
            'storage',
            [
                'id' => $this->primaryKey(),
                'book_id' => $this->integer(),
                'quantity'=> $this->integer()->notNull()->defaultValue(0),
                'price'=> $this->integer(),
            ]
        );

        $this->createIndex(
            'idx-storage-book_id',
            'storage',
            'book_id'
        );

        $this->addForeignKey(
            'fk-storage-book_id',
            'storage',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->createTable(
            'author',
            [
                'id' => $this->primaryKey(),
                'fio' => $this->string(255),
            ]
        );

        $this->createTable(
            'author_book',
            [
                'author_id' => $this->integer(),
                'book_id' => $this->integer(),
                'PRIMARY KEY(author_id, book_id)',
            ]
        );

        $this->createIndex(
            'idx-author_book-author_id',
            'author_book',
            'author_id'
        );

        $this->createIndex(
            'idx-author_book-book_id',
            'author_book',
            'book_id'
        );

        $this->addForeignKey(
            'fk-author_book-author_id',
            'author_book',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-author_book-book_id',
            'author_book',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-storage-book_id', 'storage');
        $this->dropForeignKey('fk-author_book-author_id', 'author_book');
        $this->dropForeignKey('fk-author_book-book_id', 'author_book');
        $this->dropForeignKey('fk-subscription-book_id', 'subscription');
       
        $this->dropIndex('idx-storage-book_id', 'storage');
        $this->dropIndex('idx-author_book-author_id', 'author_book');
        $this->dropIndex('idx-author_book-book_id', 'author_book');
        $this->dropIndex('idx-subscription-book_id', 'subscription');
        
        $this->dropTable('author_book');
        $this->dropTable('book');
        $this->dropTable('author');
        $this->dropTable('subscription');
        $this->dropTable('storage');
    }
}
