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

        $this->text = preg_replace('/[^a-z0-9]/i', $this->replacement, $this->text);
        $this->text = preg_replace("/[{$this->replacing}]+/", $this->replacement, $this->text);
        $this->text = preg_replace('/(' . $this->getSecureReplacement() . ')+/', $this->replacement, $this->text);

        $this->text = trim($this->text, " $this->replacement");

        return $this;
    }

    protected function getSecureReplacement()
    {
        return addcslashes($this->replacement, '\^$.[]|()?*+{}');
    }

    /**
     * Returns plain slug
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


}