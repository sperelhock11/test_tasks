<?php

namespace visitor\behavior;

/**
 * Interface Behavior
 * Служит для описания поведения поситителей.
 * @package visitor\behavior
 */
interface Behavior
{
    public function execute($context);
}