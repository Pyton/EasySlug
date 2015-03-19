<?php

namespace tests;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EasySlugSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EasySlug');
    }

    function it_should_return_empty_slug()
    {
        $this->create('')->format()->shouldReturn('');
    }

    function it_should_return_plain_slug()
    {
        $this->create('To jest slug')->format()->shouldReturn('to-jest-slug');
        $this->create('To   jest   slug')->format()->shouldReturn('to-jest-slug');
        $this->create('To --  jest --  slug')->format()->shouldReturn('to-jest-slug');
        $this->it_should_returns_slug_without_special_chars();
    }

    public function it_should_returns_slug_without_special_chars()
    {
        $this->create('Tó i ówdzię jeśliś Slugiem')->format()->shouldReturn('to-i-owdzie-jeslis-slugiem');
        $this->create('To 11 jest slug.')->format()->shouldReturn('to-11-jest-slug');
        $this->create('This is slug.!@#$%^&*(*)-')->format()->shouldReturn('this-is-slug');
    }

    function it_should_returns_formatted_slug()
    {
        $this->create('To jest slug')->format('%s-%d', [11])->shouldReturn('to-jest-slug-11');
        $this->create('To jest slug')->format('%s-%d.html', [11])->shouldReturn('to-jest-slug-11.html');
    }


}
