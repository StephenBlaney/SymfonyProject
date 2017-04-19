<?php
/**
 * Created by PhpStorm.
 * User: Stephen
 * Date: 19/04/2017
 * Time: 13:22
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\BibRepository;

class BibController extends Controller
{
    /**
     * @Route("/bibs/list")
     */

    public function listAction(Request $request)
    {
        $bibRepository = new BibRepository();
        $bibs = $bibRepository->getAll();
        $argsArray = [
            'bibs' => $bibs
        ];
        $templateName = 'bib/list';
        return $this->render($templateName . '.html.twig', $argsArray);
    }
}