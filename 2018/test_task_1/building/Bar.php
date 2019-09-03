<?php
namespace building;

use visitor\VisitorBar;

/**
 * Class Bar
 * Класс является конкретной реализацией здания типа "Бар",
 * с возможностью уведомления посетителей.
 * @package building
 */
class Bar extends BuildingNotifyVisitors
{
    // выбраный жанр музыки
    public $selectedGenre = '';

    /**
     * Метод проверяет чем занеты поситители
     * в текущий момент времени.
     * @return void
     */
    public function whatDoVisitorsDo()
    {
        /** @var VisitorBar $visitor */
        foreach($this->visitors as $visitor) {
            $visitor->executeBehavior();
        }
    }

    /**
     * Метод для принулительной смены музыки
     * @param $genre
     * @return bool
     */
    public function acceptOrderMusic($genre)
    {
        $this->selectedGenre = $genre;
        if ($genre == "") {
            $this->readyAcceptMusic();
            return true;
        }
        $this->notify();
        return true;
    }

    /**
     * Бар принимает заявки на музыку
     * Выбирается случайный посититель, который закажет музыку.
     * После заказа, играет новая музыка и поситители меняют своё
     * поведение т. к. слышат её.
     * @return void
     */
    public function readyAcceptMusic()
    {
        $key = array_rand($this->visitors, 1);
        $this->selectedGenre = $this->visitors[$key]->update($this);
        $this->notify();
    }

}