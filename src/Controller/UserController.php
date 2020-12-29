<?php

#declare(strict_types=1);

namespace GeorgPreissl\ContaoAjaxPageLoad\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Contao\System;
use Contao\CoreBundle\Framework\FrameworkAwareInterface;
use Contao\CoreBundle\Framework\FrameworkAwareTrait;
use Contao\CoreBundle\Routing\UrlGenerator;
use Contao\CoreBundle\Security\User\UserChecker;



class UserController extends Controller
{

    /**
     * an example with __invoke
     */
    public function __invoke($action = 1, Request $request)
    {     
        /*
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array(
                'status' => 'Error',
                'message' => 'Error'),
            400);
        }
        */
        
        $objUser = \Contao\FrontendUser::getInstance();

        if ($objUser->id != null)
        {
            return new JsonResponse(array(
                'data' => $objUser->row(),
                'status' => 'OK',
                'message' => ['returntest', 'testarray']),
            200);

        }

        return new JsonResponse(array(
			'data' => 'not logged in',
            'status' => 'OK',
            'message' => ['returntest', 'testarray']),
        200);
    }

}

?>