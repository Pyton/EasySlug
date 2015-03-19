<?php

class EasySlug
{
    /**
     * Set of replacements
     *
     * @var array
     */
    protected $rules = array(
        // Polish
        'Ą' => 'A',
        'Ć' => 'C',
        'Ę' => 'E',
        'Ł' => 'L',
        'Ń' => 'N',
        'Ó' => 'O',
        'Ś' => 'S',
        'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a',
        'ć' => 'c',
        'ę' => 'e',
        'ł' => 'l',
        'ń' => 'n',
        'ó' => 'o',
        'ś' => 's',
        'ź' => 'z',
        'ż' => 'z',
    );

    protected $replacement = '-';

    protected $replacing = ' ';

    /**
     * Output text
     *
     * @var
     */
    protected $text = '';

    /**
     * Create slug based on standard rules
     *
     * @param $text string Base text
     *
     * @return $this
     */
    public function create($text)
    {
        $this->text = strtolower(strtr($text, $this->rules));

        $this->text = preg_replace('/[^a-z0-9]/', $this->replacement, $this->text);
        $this->text = preg_replace("/[{$this->replacing}]+/", $this->replacement, $this->text);
        $this->text = preg_replace('/('.$this->getSecureReplacement().')+/', $this->replacement, $this->text);

        $this->text = trim($this->text, " $this->replacement");

        return $this;
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

    public function getSecureReplacement()
    {
        return addcslashes($this->replacement, '\^$.[]|()?*+{}');
    }
}