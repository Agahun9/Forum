<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormTopicType;
use App\Entity\ForumTopic;
use App\Repository\ForumCategoryRepository;

class AddTopicController extends AbstractController
{
    /**
     * @Route("/addtopic/{id}", name="add_topic")
     */
    public function index(Request $request,int $id,ForumCategoryRepository $forumCategoryRepository): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        $topic = new ForumTopic();
        $form = $this->createForm(FormTopicType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $topic->setName($form->get('name')->getData());


            $topic->setCategory($forumCategoryRepository->findOneBy(['id'=>$id]));
            $date= new \DateTime('now');
            $topic->setDate($date);
            $topic->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topic);
            $entityManager->flush();

        }

        return $this->render('add/topic.html.twig', [
            'addtopic'=>$form->createView(),
        ]);
    }
}
