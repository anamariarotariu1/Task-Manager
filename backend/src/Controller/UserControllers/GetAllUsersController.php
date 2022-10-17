<?php

namespace App\Controller\UserControllers;

use App\Repository\UserRepository;
use App\Serializer\UserSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetAllUsersController extends AbstractController
{
    /**
     * @Route("/api/retrieve-users", name="app_get_all_users", methods={"GET"})
     */
    public function index(UserRepository $repository, UserSerializer $serializer): JsonResponse
    {
        $users = $repository->findAll();
        $results = [];
        foreach ($users as $user) {
            $results[] = $serializer->userToArray($user);
        }
        return $this->json($results);
    }
}
