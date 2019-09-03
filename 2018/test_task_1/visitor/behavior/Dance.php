<?php

namespace visitor\behavior;
/**
 * Class Dance
 * Конкретная реализация поведения посетителя.
 * Посититель танцует.
 * @package visitor\behavior
 */
class Dance implements Behavior
{
    public function execute($context)
    {
        print_r($context['name'] . ": ");
        print_r("Я танцую, потому что мои любимые музыкальные жанры: "
            . implode(',', $context['genres']) . ".\n");
        return true;
    }
}