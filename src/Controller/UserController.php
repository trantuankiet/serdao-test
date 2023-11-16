<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $firstname = $request->get("firstname");
        $lastname = $request->get("lastname");
        $address = $request->get("address");
        $data = "{$firstname} - {$lastname} - {$address}";

        $user = new User($firstname, $lastname, $address);
        $user->setId(time());
        $user->setData($data);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_user_index', [
            'users' => $userRepository->findAll()
        ]);
    }

    #[Route('/{id}/delete', name: 'app_user_delete', methods: ['GET'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_user_index', [
            'users' => $userRepository->findAll()
        ]);
    }
}
