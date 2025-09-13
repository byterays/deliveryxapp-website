<?php
class Template
{
    protected $title = 'Default Title';
    protected $content = '';
    protected $cssFiles = [];
    protected $jsFiles = [];

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function addCSS($cssFile)
    {
        // Check if file exists before adding
        if ($cssFile && file_exists($cssFile)) {
            $this->cssFiles[] = $cssFile;
        }
    }

    public function addJS($jsFile)
    {
        // Check if file exists before adding
        if ($jsFile && file_exists($jsFile)) {
            $this->jsFiles[] = $jsFile;
        }
    }

    public function setContent($filePath, $vars = [])
    {
        if (!file_exists($filePath)) {
            throw new Exception("Content file not found: $filePath");
        }
        extract($vars);
        ob_start();
        include $filePath;  // executes PHP code inside content file
        $this->content = ob_get_clean();
    }

    public function render($templateFile = 'templates/template.php')
    {
        $title = $this->title;
        $content = $this->content;
        $cssFiles = $this->cssFiles;
        $jsFiles = $this->jsFiles;

        ob_start();
        include $templateFile;
        return ob_get_clean();
    }

    public function display($templateFile = 'templates/layout.php')
    {
        echo $this->render($templateFile);
    }
}
