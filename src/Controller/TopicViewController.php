<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ForumTopicRepository;

class TopicViewController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_view")
     */
    public function index(int $id,ForumTopicRepository $forumTopicRepository): Response
    {
        return $this->render('category_view/index.html.twig', [
            'topics'=>$forumTopicRepository->findBy(['category'=>$id])
        ]);
    }
}
