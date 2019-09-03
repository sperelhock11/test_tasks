<?php

namespace visitor\behavior;
/**
 * Class Drink
 * Конкретная реализация поведения посетителя.
 * Посититель пьет коктели.
 * @package visitor\behavior
 */
class Drink implements Behavior
{
    public function execute($context)
    {
        print_r($context['name'] . ": ");
        print_r("Я пью коктели, потому что музыка мне не нравиться."
                . " Мне нравиться музыка жанров: ". implode(',', $context['genres']) . ".\n");
        return true;
    }
}