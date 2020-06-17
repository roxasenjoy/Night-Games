<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $questions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\Column(type="integer")
     */
    private $likes;

    /**
     * @ORM\Column(type="integer")
     */
    private $dislikes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestions(): ?string
    {
        return $this->questions;
    }

    public function setQuestions(string $questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(int $dislikes): self
    {
        $this->dislikes = $dislikes;

        return $this;
    }
}
