<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product', name: 'app_product_')]
class ProductController extends AbstractController
{

    public function __construct(private EntityManagerInterface $entityManager){}

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $em = $this->entityManager;
        $products = $em->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', compact('products'));
    }

    #[Route('/{slug}', name: 'show')]
    public function details(Product $product): Response
    {
        return $this->render('product/details.html.twig', compact('product'));
    }
}
