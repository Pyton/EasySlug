<?php namespace tests\EasySlug;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RuleManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EasySlug\RuleManager');
    }

    function it_should_return_array()
    {
        $this->getLanguageRules()->shouldBeArray();
    }

    function it_returns_rules_array()
    {
        $this->getLanguageRules()->shouldHaveKey('PolishRule');
    }

    function it_applies_found_rules_to_text()
    {
        $this->applyRules('To są Slugi.')->shouldReturn('To sa Slugi.');
    }

    public function getMatchers()
    {
        return [
            'beArray' => function ($subject) {
                return is_array($subject);
            },
        ];
    }
}
