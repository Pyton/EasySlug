<?php namespace tests\EasySlug;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EasySlugSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EasySlug\EasySlug');
    }

    function it_should_return_empty_slug()
    {
        $this->create('')->format()->shouldReturn('');

        $this::get('')->format()->shouldReturn('');
    }

    function it_should_return_plain_slug()
    {
        $this->create('To jest slug')->format()->shouldReturn('To-jest-slug');
        $this->create('To   jest   slug')->format()->shouldReturn('To-jest-slug');
        $this->create('To --  jest --  slug')->format()->shouldReturn('To-jest-slug');

        $this->create('To --  jest --  slug')->plain()->shouldReturn('To-jest-slug');

        $this::get('To jest slug')->__toString()->shouldReturn('To-jest-slug');
    }

    public function it_should_returns_slug_without_special_chars()
    {
        $this->create('Tó i ówdzię jeśliś Slugiem')->format()->shouldReturn('To-i-owdzie-jeslis-Slugiem');
        $this->create('To 11 jest slug.')->format()->shouldReturn('To-11-jest-slug');
        $this->create('This is slug.!@#$%^&*(*)-')->format()->shouldReturn('This-is-slug');

        $this::get('This is slug.!@#$%^&*(*)-')->__toString()->shouldReturn('This-is-slug');
    }

    function it_should_returns_formatted_slug()
    {
        $this->create('To jest slug')->format('%s-%d', [11])->shouldReturn('To-jest-slug-11');
        $this->create('To jest slug')->format('%s-%d.html', [11])->shouldReturn('To-jest-slug-11.html');

        $this::get('To jest slug')->format('%s-%d.html', [11])->shouldReturn('To-jest-slug-11.html');
    }

    function it_should_return_slug_with_custom_replacement()
    {
        $this->setReplacement('_');
        $this->create('Tó i ówdzię jeśliś Slugiem')->format()->shouldReturn('To_i_owdzie_jeslis_Slugiem');

        $this->setReplacement('~~');
        $this->create('Tó i ówdzię jeśliś Slugiem')->format()->shouldReturn('To~~i~~owdzie~~jeslis~~Slugiem');

        $this->setReplacement('+');
        $this->create('Tó i ówdzię jeśliś Slugiem')->format()->shouldReturn('To+i+owdzie+jeslis+Slugiem');

        
        $this::get('Tó i ówdzię jeśliś Slugiem', '+')->__toString()->shouldReturn('To+i+owdzie+jeslis+Slugiem');
    }

}
