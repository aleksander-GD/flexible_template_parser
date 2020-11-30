<?php

/**
 * Template parser for recieving html template and replacing placeholder values with real values
 * the placeholder name must be placed within brackets {*placeholder name*} 
 * @author Aleksander G. Duszkiewicz
 */
class Parser
{
    private $placeholderData;
    private $templateFile;

    /**
     * @param mixed $templateFile the template file to be parsed with data.
     */
    public function __construct($templateFile)
    {
        if ($this->checkTemplateFile($templateFile)) {
            $this->templateFile = file_get_contents($templateFile);
            $this->placeholderData = array();
        } else {
            echo 'File ' . $templateFile . ' was not found';
        }
    }

    /**
     * This method checks for the placeholders to replace with the values and removes the
     * placeholder brackets after values have been replaced. 
     * @return string the parsed template file with the placeholder data.
     */
    public function parseTemplate()
    {
        if (sizeof($this->placeholderData) > 0) {
            $data = $this->placeholderData;
            $this->templateFile = preg_replace_callback('/\{(.*?)\}/is', function ($match) use ($data) {
                return $data[trim($match[1])]; 
            }, $this->templateFile);
            return $this->templateFile;
        }
        return 'No parsed data';
    }

    /**
     * Add value to the placeholder
     * 
     * @param mixed $placeholderKey the placeholder key that will be replaced.
     * @param mixed $placeholderValue the placeholder value that will replace the specific key in the template.
     */
    public function addValueToPlaceholder($placeholderKey, $placeholderValue): void
    {
        $this->placeholderData[strtolower(trim($placeholderKey))] = $placeholderValue;
    }

    /**
     * Method is used to check whether the file exists and that the attribute is set with a path.
     * 
     * @param mixed $templateFile file to be checked
     * @return boolean If template variable is empty and the file does not exist return false, otherwise return true;
     */
    private function checkTemplateFile($templateFile)
    {
        return $templateFile !== '' && file_exists($templateFile);
    }
}