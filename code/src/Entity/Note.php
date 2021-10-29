<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_time;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    public function __construct(string $title, \DateTimeInterface $createdTime, string $text)
    {
        $this->title = $title;
        $this->created_time = $createdTime;
        $this->text = $text;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCreatedTime(): ?\DateTimeInterface
    {
        return $this->created_time;
    }

    public function setCreatedTime(\DateTimeInterface $created_time): void
    {
        $this->created_time = $created_time;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "created_time" => $this->getCreatedTime(),
            "text" => $this->getText()
        ];
    }
}
