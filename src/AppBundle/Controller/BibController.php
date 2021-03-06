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

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

        return $this->redirectToRoute('bibs_list');
    }

    /**
     * @Route("/bibs/delete/{id}", name="bibs_delete")
     */
    public function deleteAction($id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();
        $bibRepository = $em->getRepository('AppBundle:Bib');
        // find thge student with this ID
        $bib = $bibRepository->find($id);
        if (!$bib) {
            throw $this->createNotFoundException(
                'No bib found for id '.$id
            );
        }
        // tells Doctrine you want to (eventually) delete the Student (no queries yet)
        $em->remove($bib);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        return new Response('Delete bib with id '.$id);
    }

    /**
     * @Route("/bibs/update/{id}/{newName}")
     */

    public function updateAction($id, $newName)
    {
        $em = $this->getDoctrine()->getManager();
        $bib = $em->getRepository('AppBundle:Bib')->find($id);
    if (!$bib) {
        throw $this->createNotFoundException(
            'No student found for id '.$id );
    }
    $bib->setName($newName);
    $em->flush();

    return $this->redirectToRoute('bibs_list');
}

    /**
     * @Route("/bibs/processNewForm", name="bibs_process_new_form")
     */
    public function processNewFormAction(Request $request)
    {
        // extract 'name' parameter from POST data
        $name = $request->request->get('name');
        if(empty($name)){
            $this->addFlash(
                'error',
                'student name cannot be an empty string'
            );
            // forward this to the createAction() method
            return $this->newFormAction($request);
        }
        // forward this to the createAction() method
        return $this->createAction($name);
    }

    /**
     * @Route("/bibs/show/{id}", name="bibs_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $bib = $em->getRepository('AppBundle:Bib')->find($id);
        if (!$bib) {
            throw $this->createNotFoundException(
                'No student found for id '.$id
            );
        }
        $argsArray = [
            'bib' => $bib
        ];
        $templateName = 'bib/show';
        return $this->render($templateName . '.html.twig', $argsArray);
    }


    /**
     * @Route("/bibs/new", name="bibs_new_form")
     */
    public function newFormAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $bib = new Bib();
        $form = $this->createFormBuilder($bib)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Bib'))
            ->getForm();


        /// ---- start processing POST submission of form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bib = $form->getData();
            $name = $bib->getName();
            return $this->createAction($name);
        }
        $argsArray = [
            'form' => $form->createView(),
        ];

        $templateName = 'bib/new';
        return $this->render($templateName . '.html.twig', $argsArray);
    }
}