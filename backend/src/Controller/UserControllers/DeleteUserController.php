<?php

namespace App\Controller\UserControllers;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
    /**
     * @Route("/api/delete-user/{user_id}", requirements={"user_id"="\d+"},  name="app_delete_user", methods={"DELETE"})
     */
    public function index(
        UserRepository $repository,
        int $user_id
    ): JsonResponse {
        $user = $repository->find($user_id);
        if (!$user) {
            return $this->json('User not found', 404);
        }
        $repository->remove($user, true);
        return new JsonResponse('User deleted successfully', 200);
    }
}
