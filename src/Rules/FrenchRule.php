<?php namespace EasySlug\Rules;

class FrenchRule extends RuleContract
{

    /**
     * Set of replacements
     * @var array
     */
    protected $rules = array(
        // French
        'à' => 'a',
        'â' => 'a',
        'ç' => 'c',
        'é' => 'e',
        'è' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'î' => 'i',
        'ï' => 'i',
        'ô' => 'o',
        'û' => 'u',
        'ù' => 'u',
        'ü' => 'u',
        'ÿ' => 'y',
        'À' => 'A',
        'Â' => 'A',
        'Ç' => 'C',
        'É' => 'E',
        'È' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Î' => 'I',
        'Ï' => 'I',
        'Ô' => 'O',
        'Û' => 'U',
        'Ù' => 'U',
        'Ü' => 'U',
        'Ÿ' => 'Y',
        'œ' => 'oe',
        'æ' => 'ae',
        'Œ' => 'OE',
        'Æ' => 'AE',
    );

    /**
     * Set rules to parent class
     */
    public function __construct()
    {
        parent::__construct($this->rules);
    }
}