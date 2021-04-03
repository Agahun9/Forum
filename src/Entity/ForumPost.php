<?php

namespace App\Entity;

use App\Repository\ForumPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ForumPostRepository::class)
 */
class ForumPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="forumPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity=ForumTopic::class, inversedBy="forumPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Topic;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?user
    {
        return $this->post;
    }

    public function setPost(?user $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getTopic(): ?ForumTopic
    {
        return $this->Topic;
    }

    public function setTopic(?ForumTopic $Topic): self
    {
        $this->Topic = $Topic;

        return $this;
    }

    public function getDate(): ?\DateInterval
    {
        return $this->date;
    }

    public function setDate(\DateInterval $date): self
    {
        $this->date = $date;

        return $this;
    }
}