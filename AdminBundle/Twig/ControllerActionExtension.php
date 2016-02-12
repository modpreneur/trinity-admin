<?php
namespace Trinity\AdminBundle\Twig;

use Symfony\Component\HttpFoundation\Request;


/**
 * Class ControllerActionExtension
 * @package Trinity\AdminBundle\Twig
 */
class ControllerActionExtension extends \Twig_Extension
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var \Twig_Environment
     */
    protected $environment;


    /**
     * @param Request|null $request
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;
    }


    /**
     * @param \Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }


    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'get_controller_name' => new \Twig_SimpleFunction($this, 'getControllerName'),
            'get_action_name' => new \Twig_SimpleFunction($this, 'getActionName'),
        );
    }


    /**
     * Get current controller name
     * @return string
     */
    public function getControllerName()
    {
        if (null !== $this->request) {
            $pattern = "#Controller\\\([a-zA-Z]*)Controller#";
            $matches = array();
            preg_match($pattern, $this->request->get('_controller'), $matches);

            return strtolower($matches[1]);
        }
    }


    /**
     * Get current action name
     * @return string
     */
    public function getActionName()
    {
        if (null !== $this->request) {
            $pattern = "#::([a-zA-Z]*)Action#";
            $matches = array();
            preg_match($pattern, $this->request->get('_controller'), $matches);

            return $matches[1];
        }
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'your_own_controller_action_twig_extension';
    }
}