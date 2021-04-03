<?php

namespace App\Controller;


use App\Entity\ForumPost;
use App\Form\FormPostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ForumPostRepository;
use App\Repository\ForumTopicRepository;

class PostViewController extends AbstractController
{
    /**
     * @Route("/topic/{id}", name="topic")
     */
    public function index(int $id,ForumPostRepository $forumPostRepository,Request $request,ForumTopicRepository $forumTopicRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $post = new ForumPost();
        $form = $this->createForm(FormPostType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setPost($form->get('post')->getData());


            $post->setTopic($forumTopicRepository->findOneBy(['id'=>$id]));
            $date= new \DateTime('now');
            $post->setDate($date);
            $post->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

        }


        return $this->render('post_view/index.html.twig', [
            'topics'=>$forumPostRepository->findBy(['Topic'=>$id]),
            'addpost'=>$form->createView(),
        ]);
    }
}
