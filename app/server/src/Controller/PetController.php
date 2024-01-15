<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pet;
 
#[Route('/api', name: 'api_')]
class PetController extends AbstractController
{
    #[Route('/pets', name: 'pet_index', methods:['get'] )]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $products = $doctrine
            ->getRepository(Pet::class)
            ->findAll();
   
        $data = [];
   
        foreach ($products as $product) {
           $data[] = [
               'id' => $product->getId(),
               'name' => $product->getName(),
               'type' => $product->getType(),
               'breed' => $product->getBreed(),
               'gender' => $product->getGender(),
           ];
        }
   
        return $this->json($data);
    }
 
 
    #[Route('/pets', name: 'pet_create', methods:['post'] )]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
   
        $pet = new Pet();
        $pet->setName($request->request->get('name'));
        $pet->setType($request->request->get('type'));
        $pet->setBreed($request->request->get('breed'));
        $pet->setGender($request->request->get('gender'));
   
        $entityManager->persist($pet);
        $entityManager->flush();
   
        $data =  [
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'type' => $pet->getType(),
            'breed' => $pet->getBreed(),
            'gender' => $pet->getGender(),
        ];
           
        return $this->json($data);
    }
 
 
    #[Route('/pets/{id}', name: 'pet_show', methods:['get'] )]
    public function show(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $pet = $doctrine->getRepository(Pet::class)->find($id);
   
        if (!$pet) {
   
            return $this->json('No pet found for id ' . $id, 404);
        }
   
        $data =  [
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'type' => $pet->getType(),
            'breed' => $pet->getBreed(),
            'gender' => $pet->getGender(),
        ];
           
        return $this->json($data);
    }
 
    #[Route('/pets/{id}', name: 'pet_update', methods:['put', 'patch'] )]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $pet = $entityManager->getRepository(Pet::class)->find($id);
   
        if (!$pet) {
            return $this->json('No pet found for id' . $id, 404);
        }
   
        $pet->setName($request->request->get('name'));
        $pet->setType($request->request->get('type'));
        $pet->setBreed($request->request->get('breed'));
        $pet->setGender($request->request->get('gender'));
        $entityManager->flush();
   
        $data =  [
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'type' => $pet->getType(),
            'description' => $pet->getDescription(),
            'gender' => $pet->getGender(),
        ];
           
        return $this->json($data);
    }
 
    #[Route('/pets/{id}', name: 'pet_delete', methods:['delete'] )]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $pet = $entityManager->getRepository(Pet::class)->find($id);
   
        if (!$pet) {
            return $this->json('No pet found for id' . $id, 404);
        }
   
        $entityManager->remove($pet);
        $entityManager->flush();
   
        return $this->json('Deleted a pet successfully with id ' . $id);
    }
}