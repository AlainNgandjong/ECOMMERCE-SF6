<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\SluggerInterface;

trait SlugTrait {

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $slug;

    public function getSlug(): ?string
    {
        return $this->slug;
    }


    public function setSlug(SluggerInterface $slugger, string $name)
    {
        if(!$this->slug || '-' === $this->slug) {
            $this->slug = (string) $slugger->slug((string) $name)->lower();
        }
    }

}