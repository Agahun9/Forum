<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumPost;
use App\Form\FormPostType;
use App\Repository\ForumTopicRepository;

class AddPostController extends AbstractController
{
    /**
     * @Route("/topi1c/{id}", name="add_post")
     */
    public function index(Request $request,int $id,ForumTopicRepository $forumTopicRepository): Response
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
            'addpost'=>$form->createView(),
        ]);
    }
}
