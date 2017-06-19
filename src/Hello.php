<?php

namespace Codeception\Module;

use Codeception\Module;

class Hello extends Module
{

    public function greet($name)
    {
        $this->debug("Hello {$name}!");
    }
}
