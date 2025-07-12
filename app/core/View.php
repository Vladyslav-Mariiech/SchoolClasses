<?php


namespace app\core;


class View
{
    /**
     * @var string
     */
    protected $template = 'default';

    /**
     * View constructor
     * @param string|null $template
     */
    public function __construct(string $template = null)
    {
        if(!is_null($template)){
            $this->template = $template;
        }
    }

    /**
     * Rendering
     * @param string $viewName
     * @param array $params
     * @return void
     */
    public function render(string $viewName, array $params = []) : void
    {
        extract($params);
        if (isset($title)){
            $title = SITE_NAME . ' | ' . $title;
        }
        include_once $this->getTemplatePath();
    }

    /**
     * Returns the base path to the views directory
     * @return string
     */
    protected function getViewsDir() : string
    {
        return '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
    }

    /**
     * Returns the full path to the layout template file
     * @return string
     */
    protected function getTemplatePath() : string
    {
        return $this->getViewsDir() . 'templates' . DIRECTORY_SEPARATOR . $this->template . '.php';
    }

    /**
     * Returns the full path to a specific view file
     * @param string $view
     * @return string
     */
    protected function getViewPath(string $view) : string
    {
        return $this->getViewsDir() . 'pages' . DIRECTORY_SEPARATOR . $view . '_page.php';
    }
}