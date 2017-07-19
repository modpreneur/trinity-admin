<?php

namespace Trinity\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 *
 * Class AdminCssController
 * @package Trinity\AdminBundle\Controller
 */
class AdminCssController extends Controller
{

    /**
     * @Route("/", name="admin-css")
     *
     * @return Response
     */
    public function indexAction() : Response
    {
        return $this->render('@TrinityAdmin/css.html.twig');
    }

    /**
     * @Route("/link", name="admin-css-link")
     *
     * @return Response
     */
    public function adminAction() : Response
    {
        return new Response('Tu nic nima');
    }
}
