<?php namespace EasySlug;

class RuleManager
{
    protected $rules = array();

    public function applyRules($text)
    {
        foreach ($this->getLanguageRules() as $ruleName => $file)
        {
            $objectName = 'EasySlug\\Rules\\' . $ruleName;
            $ruleSet = new $objectName();
            $text = $ruleSet->execute($text);

        }

        return $text;
    }

    /**
     * Returns all defined rules
     * @return array
     */
    public function getLanguageRules()
    {
        foreach (glob(__DIR__ . '/Rules/*Rule\.php') as $ruleFile)
        {
            $this->rules[basename($ruleFile, '.php')] = $ruleFile;
        }

        return $this->rules;
    }
}
