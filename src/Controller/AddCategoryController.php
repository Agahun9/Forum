<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumCategory;
use App\Form\FormCategoryType;

class AddCategoryController extends AbstractController
{
    /**
     * @Route("/addcategory", name="addcategory")
     */
    public function index(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $category = new ForumCategory();
        $form = $this->createForm(FormCategoryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category->setName($form->get('name')->getData());
            $category->setDescription($form->get('desc')->getData());
            $date= new \DateTime('now');
            $category->setDate($date);
            $category->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

        }

        return $this->render('add_form_topic/index.html.twig', [
            'controller_name' => 'AddFormTopicController',
            'addcategory'=>$form->createView(),
        ]);
    }
}
