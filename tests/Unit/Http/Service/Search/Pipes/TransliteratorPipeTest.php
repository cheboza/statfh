<?php

namespace Http\Service\Search\Pipes;

use App\Http\Service\Search\Pipes\TransliteratorPipe;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class TransliteratorPipeTest extends TestCase
{
    public function testSwitching()
    {
        $class = new ReflectionClass('App\Http\Service\Search\Pipes\TransliteratorPipe');
        $method = $class->getMethod('switching');
        $method->setAccessible(true);
        $transliteral = new TransliteratorPipe();
        $sherlock = $method->invokeArgs($transliteral, ['шерлок', function (){}]);
        self::assertEquals('sherlock', $sherlock);
    }
}
