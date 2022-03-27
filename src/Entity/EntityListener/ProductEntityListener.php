<?php


namespace App\Entity\EntityListener;


use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductEntityListener
{

    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Product $product , LifecycleEventArgs $event)
    {
        $product->computeSlug($this->slugger, $product);
    }

    public function preUpdate(Product $product , LifecycleEventArgs $event)
    {
        $product->computeSlug($this->slugger, $product);
    }

}