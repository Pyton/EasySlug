<?php namespace EasySlug\Rules;

/**
 * Class RuleContract
 */
class RuleContract
{
    protected $rules = array();

    /**
     * Gets rules and merge it
     *
     * @param array $rules
     */
    public function __construct($rules = array())
    {
        $this->rules = $rules;
    }

    /**
     * Fire language char replacing
     *
     * @param $text
     *
     * @return string
     */
    public function execute($text)
    {
        return strtr($text, $this->rules);
    }

}