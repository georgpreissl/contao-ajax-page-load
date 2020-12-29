<?php

namespace GeorgPreissl\ContaoAjaxPageLoad\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\ArticleModel;
use Contao\PageModel;

class AjaxPageLoad extends Controller
{
 
	
	/**
     * @return JsonResponse
     */
    public function pageSearchAction($action = 0, Request $request)
    {
	
		$objPages = PageModel::findByIdOrAlias($action );	
        $objArticles = ArticleModel::findPublishedByPidAndColumn($objPages->id, "main");
        // dump($objArticles);

        if ($objArticles === null)
        {
            return '';
        }

        $html = '';

        while ($objArticles->next())
        {
            $objArticle = $objArticles->current();
            $html .= \Controller::getArticle( $objArticle->id, false, false);
        }

        return new JsonResponse(array(
			'data' => $html,
            'status' => 'OK',
            'message' => ['returntest', 'testarray']),
        200);
		
    }
}
?>
