<?php

namespace Trinity\AdminBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

//@todo @TomasJancar Je to k něčemu? Plus to vyřvává chyby.
trait Ajax
{
//    public static $AjaxSuccess = 200;
//    public static $AjaxError = 500;
//
//    function renderAjax($view,array $viewParameters = array(),$block)
//    {
//        $templateContent = $this->get("twig")->loadTemplate($view);
//
//        return $templateContent->renderBlock($block,$viewParameters);
//    }
//
//    function renderFormTrinity(Form $form)
//    {
//        /** @var Controller $this */
//        return $this->get("twig")->getExtension('form')->renderer->searchAndRenderBlock($form->createView(),"widget");
//    }
//
//    function renderJsonTrinity($view, array $viewParameters = array(),array $block = array(), $hashValue = null, $statusCode = 200)
//    {
//        /** @var Controller|Ajax $this */
//        /** @var \Twig_Template $templateContent */
//        $templateContent = $this->get("twig")->loadTemplate($view);
//
//        $jsonParameters = array();
//        $jsonParameters["method"] = "view";
////        $jsonParameters["flashMessages"] = $this->generateFlashMessages();
//
//        if(!is_null($hashValue))
//            $jsonParameters["hashValue"] = $hashValue;
//
//        foreach($block as $key => $part)
//        {
//            $toBlock = $part;
//            if(!is_numeric($key))
//            {
//                $toBlock = $key;
//            }
//            $jsonParameters[$toBlock] = $templateContent->renderBlock($part,$viewParameters);
//        }
//
//        $response = new JsonResponse($jsonParameters);
//
//        $response->setStatusCode($statusCode);
//
//        return $response;
//    }
//
//    function renderTrinity($view, array $viewParameters = array(),array $block = array(), $hashValue = null, $statusCode = 200)
//    {
//        /** @var Controller|Ajax $this */
//        /** @var Request $request */
//        $request = $this->get("request");
//
//        if($request->isXmlHttpRequest())
//        {
//            return $this->renderJsonTrinity($view, $viewParameters, $block, $hashValue, $statusCode);
//        }
//
//        return $this->render($view,$viewParameters);
//    }
//
//    function redirectTrinity($url, $status = 302)
//    {
//        /** @var Controller|Ajax $this */
//        /** @var Request $request */
//        $request = $this->get("request");
//
//        if($request->isXmlHttpRequest())
//        {
//            return new JsonResponse(array("method"=>"redirect", "url"=>$url));
//        }
//
//        return $this->redirect($url,$status);
//    }
//
//    function redirectToRouteTrinity($route, array $parameters = array(), $status = 302)
//    {
//        /** @var Controller|Ajax $this */
//        return $this->redirectTrinity($this->generateUrl($route, $parameters), $status);
//    }
//
//    private function generateFlashMessages()
//    {
//        /** @var Controller|Ajax $this */
//        $messages = "";
//        $templateContent = $this->get("twig")->loadTemplate(":CoreBundle/Front/default:flashMessage.html.twig");
//
//        /** @var Session $session */
//        $session = $this->get('session');
//
//        foreach($session->getFlashBag()->all() as $type => $flashMessages)
//        {
//            foreach($flashMessages as $flashMessage)
//            {
//                $messages .= $templateContent->render(array("type"=>$type,"id"=>rand(),"text"=>$flashMessage));
//            }
//        }
//
//        return $messages;
//    }

}