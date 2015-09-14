<?php

namespace Trinity\AdminBundle\Handler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class LogoutSuccessHandler
 * @package Necktie\AppBundle\Handler
 */
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    public function onLogoutSuccess(Request $request)
    {
        $referer_url = $request->headers->get('referer') ? $request->headers->get('referer') : 'http://'.$request->headers->get('host');
        //echo $referer_url;

        $response = new RedirectResponse($referer_url);
        return $response;
    }
}
