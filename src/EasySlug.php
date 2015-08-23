<?php namespace EasySlug;

class EasySlug
{

    /**
     * Default slug char replacement
     * @var string
     */
    protected $replacement = '-';

    /**
     * Default char which would be replaced
     * @var string
     */
    protected $replacing = ' ';

    /**
     * Output text
     * @var
     */
    protected $text = '';

    /**
     * List of allowed characters in slug saved in Preg_replace notation
     *
     * @var string
     */
    protected $allowedCharacters = 'A-Za-z0-9';

    /**
     * Rule Manager Object
     * @var RuleManager|null
     */
    protected $ruleManager = null;

    /**
     * Construct class with RuleManager
     */
    function __construct()
    {
        $this->ruleManager = new RuleManager();
    }

    /**
     * Create slug based on standard rules
     *
     * @param $text string Base text
     *
     * @return $this
     */
    public function create($text)
    {
        $this->text = $this->ruleManager->applyRules($text);
        $pregReplacePatterns = array(
            "/[^{$this->allowedCharacters}]/",
            "/[{$this->replacing}]+/",
            '/(' . $this->getSecureReplacement() . ')+/'
        );
        foreach($pregReplacePatterns as $pattern)
        {
            $this->text = preg_replace($pattern, $this->replacement, $this->text);
        }

        $this->text = trim($this->text, " $this->replacement");
        
        return $this;
    }

    protected function getSecureReplacement()
    {
        return addcslashes($this->replacement, '\^$.[]|()?*+{}');
    }

    /**
     * Returns plain slug
     *
     * @return mixed
     */
    public function plain()
    {
        return $this->text;
    }

    /**
     * Output created slug in sprintf format
     *
     * @param string $format
     * @param array  $arguments
     *
     * @return string
     */
    public function format($format = '%s', $arguments = array())
    {
        array_unshift($arguments, $this->text);

        return vsprintf($format, $arguments);
    }

    /**
     * Set replacement character eg: _ or -
     *
     * @param string $replacement
     */
    public function setReplacement($replacement)
    {
        $this->replacement = $replacement;
    }

    /**
     * Construct class by static method
     * 
     * @param $text string Base text
     * @param $prel string Replacement character eg: _ or -
     * 
     * @return $this
     */
    public static function get($text, $repl = null)
    {
    	$get = new static();
    	if($repl !== null) $new->setReplacement($repl);
    	return $get->create($text);
    }


    public function __toString()
    {
    	return $this->plain();
    }
}