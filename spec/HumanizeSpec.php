<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HumanizeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Humanize');
    }
}
