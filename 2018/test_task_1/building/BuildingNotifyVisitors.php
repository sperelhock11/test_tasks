<?php
namespace building;
use SplObserver;

/**
 * Class BuildingNotifyVisitors
 * Класс реализует здание которое может уведомлять своих поситителей о чем либо.
 * Для реализации этой задачи используется паттерн наблюдатель, из стандартной библиотеки STL в PHP.
 * @package building
 */
class BuildingNotifyVisitors implements \SplSubject
{
    // поситители
    protected $visitors = [];

    /**
     * Запоминаем поситителя которому нужны уведомления.
     * @param SplObserver $observer посититель.
     * @return void
     */
    public function attach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        $this->visitors[$key] = $observer;
    }

    /**
     * Удаление поситителя из подписки.
     * @param SplObserver $observer - посититель
     * @return void
     */
    public function detach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        if(isset($this->visitors[$key])) {
            unset($this->visitors[$key]);
        }
    }

    /**
     * Метод уведомляет поситителей о новом уведомлении.
     * @return void
     */
    public function notify()
    {
        foreach($this->visitors as $visitor) {
            $visitor->update($this);
        }
    }
}