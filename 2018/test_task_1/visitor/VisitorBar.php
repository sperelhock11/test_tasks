<?php
namespace visitor;

use visitor\behavior\{Dance, Drink, OrderMusic};
use SplSubject;

/**
 * Class VisitorBar
 * Конкректная реализация поситителя бара.
 * Бар уведомляет поситителя о том какая музыка играет, просто посититель слышит её.
 * Посититель может реализовывать различные алгоритмы поведения в зависимости от того,
 * какую музыку он услышит. (что сообщит ему бар)
 * @package visitor
 */
class VisitorBar extends VisitorBehavior implements \SplObserver
{
    // у поситителя есть любимые жанры
    const MAX_COUNT_GENRES = 10;
    const MIN_COUNT_GENRES = 1;

    /**
     * Установка имени поситителю, для простоты идентификации его действий и его самого.
     * @param $name
     */
    public function setName($name) {
        $this->context['name'] = $name;
    }

    /**
     * Установка предпочитаемых музыкальных жанров поситителя.
     * @param $genres
     */
    public function setGenres($genres) {
        $this->context['genres'] = $genres;
    }

    /**
     * Уведомление поситителя о том музыка какого жанра сейчас играет.
     * @param SplSubject $bar - бар, избыточно но observer в SPL PHP трактует так.
     * @return void
     */
    public function update(SplSubject $bar)
    {
        $this->choiceBehavior($bar->selectedGenre);
        return $this->executeBehavior();
    }

    /**
     * Метод реализует алгоритм выбора поведения посетителя.
     * @param $param - входящий параметр.
     * @return bool|mixed
     */
    protected function choiceBehavior($param) {
        if ($param == "") {
            $this->setBehavior(new OrderMusic());
            return true;
        }

        if (in_array($param, $this->context['genres'])) {
            $this->setBehavior(new Dance());
        } else {
            $this->setBehavior(new Drink());
        }
        return true;
    }
}