<?php

namespace App\Controller\UserControllers;

use App\Repository\UserRepository;
use App\Serializer\UserSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetSingleUserController extends AbstractController
{
    /**
     * @Route("/api/retrieve-user\{user_id}", requirements={"user_id"="\d+"}, name="app_get_single_user"), methods={"GET"}
     */
    public function index(
        UserRepository $repository,
        UserSerializer $serializer,
        int $user_id
    ): JsonResponse {
        $user = $repository->find($user_id);
        if (!$user) {
            return $this->json('User not registered', 404);
        }
        return $this->json($serializer->userToArray($user));
    }
}
