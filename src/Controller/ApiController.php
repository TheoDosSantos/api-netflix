<?php

namespace App\Controller;

use App\Entity\Audiovisual;
use App\Repository\AudiovisualRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/', name: 'api')]
    public function index(AudiovisualRepository $audioRepo): Response
    {
        $audio = $audioRepo->findAll();
        return $this->render('api/index.html.twig', [
            'audiovisual'     => $audio
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $jsonRecu = $request->getContent();

        try {

            $audiovisual = $serializer->deserialize($jsonRecu, Audiovisual::class, 'json');

            $errors = $validator->validate($audiovisual);

            if(count($errors) > 0){
                return $this->json($errors, 400);
            }

            $entityManager = $doctrine->getManager();
            $entityManager->persist($audiovisual);
            $entityManager->flush();
            return $this->json($audiovisual, 201);

        }
        catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    #[Route('/getall', name: 'getall')]
    public function getAll(AudiovisualRepository $audioRepo): Response
    {
        return $this->json($audioRepo->findAll(), 200);
    }

    #[Route('/get/{id}', name: 'getid')]
    public function getId(AudiovisualRepository $audioRepo, int $id): Response
    {
        return $this->json($audioRepo->find($id), 200);
    }
}
