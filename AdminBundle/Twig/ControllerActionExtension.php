<?php
namespace Trinity\AdminBundle\Twig;

use Symfony\Component\HttpFoundation\Request;
use Twig_Extension_InitRuntimeInterface;


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
     * @param Request|null $request
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;
    }



    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_controller_name', [$this, 'getControllerName']),
            new \Twig_SimpleFunction('get_action_name', [$this, 'getActionName']),
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