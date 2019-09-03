<?php
namespace visitor;
use visitor\behavior\Behavior;

/**
 * Class VisitorBehavior
 * Абстрактный класс, который позволяет реализовывать поведение поситителей.
 * @package visitor
 */
abstract class VisitorBehavior
{
    private $behavior = null;
    protected $context = null;

    /**
     * Задать алгоритм поведения.
     * @param Behavior $behavior - поведение
     */
    public function setBehavior(Behavior $behavior) {
        $this->behavior = $behavior;
    }

    /**
     * Выполнить действие которое предпологает алгоритм поведения.
     * @return mixed
     */
    public function executeBehavior() {
        return $this->behavior->execute($this->context);
    }

    /**
     * Абстрактный метод, создан для того, чтобы класс потомок
     * мог по разному реализовывать алгоритм выбора поведения.
     * @param $param - входящий параметр
     * @return mixed
     */
    protected abstract function choiceBehavior($param);
}