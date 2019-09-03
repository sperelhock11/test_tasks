<?php

namespace visitor\behavior;
/**
 * Class OrderMusic
 * Конкретная реализация поведения посетителя.
 * Посититель заказывает музыку в баре.
 * @package visitor\behavior
 */
class OrderMusic implements Behavior
{
    public function execute($context)
    {
        print_r($context['name'] . ": ");
        $key = rand(0, (count($context['genres']) - 1));
        $currentGenre = $context['genres'][$key];
        print_r("Я заказываю музыку жанра " . $currentGenre . ".\n");
        return $currentGenre;
    }
}