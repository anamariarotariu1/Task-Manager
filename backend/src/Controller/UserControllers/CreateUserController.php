<?php

namespace App\Controller\UserControllers;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Serializer\UserSerializer;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;


class CreateUserController extends AbstractController
{
    /**
     * @Route("/api/create-user", name="app_create_user", methods={"POST"})
     */
    public function index(Request $request, UserRepository $repository, UserSerializer $serializer): JsonResponse
    {
        $requestBody = $request->getContent();
        $requestBody = json_decode($requestBody, true);
        $newUser = new User();
        $newUser->setEmail($requestBody['email'])
            ->setFirstName($requestBody['firstName'])
            ->setLastName($requestBody['lastName'])
            ->setPassword(password_hash($requestBody['password'], PASSWORD_BCRYPT))
            ->setDateCreated(new DateTime())
            ->setDateModified(new DateTime());
        $validator = Validation::createValidator();
        $violations = $validator->validate($requestBody['password'], [
            new Length(['min' => 8]),
            new NotBlank()
        ]);
        if (0 !== count($violations)) {
            return new JsonResponse('Password must be 8 chars long', 406);
        }
        $repository->add($newUser, true);
        return $this->json($serializer->userToArray($newUser));
    }
}
