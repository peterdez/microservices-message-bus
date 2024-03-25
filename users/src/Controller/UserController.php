<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Message\UserCreate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

#[Route('/api', name: 'api_')]
class UserController extends AbstractController
{
    /*#[Route('/user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }*/

    #[Route('/users', name: 'user_index', methods:['get'] )]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $users = $doctrine
            ->getRepository(User::class)
            ->findAll();
   
        $data = [];
   
        foreach ($users as $user) {
           $data[] = [
               'id' => $user->getId(),
               'email' => $user->getEmail(),
               'firstName' => $user->getfirstName(),
               'lastName' => $user->getlastName(),
           ];
        }
   
        return $this->json($data);
    }
 
 
    #[Route('/users', name: 'user_create', methods:['post'] )]
    public function create(ManagerRegistry $doctrine, Request $request, MessageBusInterface $bus): JsonResponse
    {
        $entityManager = $doctrine->getManager();
   
        $user = new User();
        $user->setEmail($request->request->get('email'));
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
   
        $entityManager->persist($user);
        $entityManager->flush();
   
        $data =  [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstName' => $user->getfirstName(),
            'lastName' => $user->getlastName(),
        ];

        $status = implode(" ", $data);
        $bus->dispatch(new UserCreate($status));
           
        return $this->json($data);
    }
}
