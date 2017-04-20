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
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Bib;

class BibController extends Controller
{
    /**
     * @Route("/bibs/list", name="bibs_list")
     */

    public function listAction(Request $request)
    {
        $bibRepository = $this->getDoctrine()->getRepository('AppBundle:Bib');
        $bibs = $bibRepository->findAll();

        $argsArray = [
            'bibs' => $bibs
        ];
        $templateName = 'bib/list';
        return $this->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @Route("/bibs/create/{name}", name="bib_create")
     */
    public function createAction($name)
    {
        $bib = new Bib();
        $bib->setName($name);

        // entity manager
        $em = $this->getDoctrine()->getManager();
        // tells Doctrine you want to (eventually) save the Student (no queries yet)
        $em->persist($bib);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        return new Response('Created new student with id '.$bib->getId());
    }
}