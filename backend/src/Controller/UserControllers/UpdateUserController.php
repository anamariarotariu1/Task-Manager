<?php

namespace App\Controller;

use DateTime;
use App\Repository\UserRepository;
use App\Serializer\UserSerializer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateUserController extends AbstractController
{
    /**
     * @Route("/api/update-user/{user_id}", requirements={"user_id"="\d+"}, name="app_update_user"), methods={"PATCH"}
     */
    public function index(
        Request $request,
        UserRepository $repository,
        UserSerializer $serializer,
        ManagerRegistry $doctrine,
        int $user_id
    ): JsonResponse {
        $requestBody = $request->getContent();
        $requestBody = json_decode($requestBody, true);
        $entityManager = $doctrine->getManager();
        $updatedUser = $repository->find($user_id);
        if (!$updatedUser) {
            return $this->json('User not registered', 404);
        }

        if (isset($reqBody['firstName'])) {
            $updatedUser->setFirstName($reqBody['firstName']);
        }
        if (isset($reqBody['lastName'])) {
            $updatedUser->setLastName($reqBody['lastName']);
        }
        if (isset($reqBody['email'])) {
            $updatedUser->setEmail($reqBody['email']);
        }
        if (isset($requestBody['password'])) {
            $updatedUser->setPassword(password_hash($requestBody['password'], PASSWORD_BCRYPT));
        }
        $updatedUser->setDateModified((new DateTime()));

        $entityManager->persist($updatedUser);
        $entityManager->flush();
        return $this->json($serializer->userToArray($updatedUser));
    }
}
