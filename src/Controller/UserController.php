<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/users', name: 'app_admin_users_')]
class UserController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager){}

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $em = $this->entityManager;
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('admin/user/index.html.twig', compact('users'));
    }
}
