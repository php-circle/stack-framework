<?php
declare(strict_types=1);

namespace Test;

use App\Http\Handlers\UserHandler;
use App\Http\Handlers\UserShowHandler;

class ExampleTest extends AbstractTestCase
{
    /**
     * Description here
     *
     * @return void
     */
    public function test(): void
    {
        $stack = new \SplStack();

        $class1 = new UserHandler();
        $class2 = new UserShowHandler();

        $stack->push($class1);
        $stack->push($class2);

        $stack->rewind();
        while($stack->valid()) {
            dump($stack->current());
            $stack->next();
        }

        dd();
    }
}
