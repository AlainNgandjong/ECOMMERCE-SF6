<?php

namespace App\Entity\Trait;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait TimeStampTrait {

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $updatedAt = null;


    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps()
    {
        if ($this->getCreatedAt() == null) {
            $this->createdAt = new DateTimeImmutable();
        }
        $this->updatedAt = new DateTime();
    }

}