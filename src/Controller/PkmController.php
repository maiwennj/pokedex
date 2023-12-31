<?php

namespace App\Controller;


use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Clock\now;

#[Route('/pkm', name: 'pkm_')]
class PkmController extends AbstractController
{
    #[Route(['/','/home','accueil'], name: 'list')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        $pokedex = $pokemonRepository->findAll();
        return $this->render('pkm/index.html.twig', [
            'pokedex'=>$pokedex
        ]);
    }

    #[Route('/random', name: 'random')]
    public function random(PokemonRepository $pokemonRepository): Response
    {
        $pokedex = $pokemonRepository->findAll();
        $pokemon = $pokedex[array_rand($pokedex,1)];
        return $this->redirect($this->generateUrl('pkm_details',['id'=>$pokemon->getId()]));
    }

    #[Route('/{id}', name: 'details',requirements: ['id'=>'\d+'])]
    public function details(PokemonRepository $pokemonRepository,$id): Response
    {
        $pokemon = $pokemonRepository->find($id);
        return $this->render('pkm/details.html.twig', [
            'pokemon'=>$pokemon
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request,EntityManagerInterface $manager): Response
    {

        // création du formulaire
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class,$pokemon);

        // traitement du formulaire
        $form->handleRequest($request);
        // vérifications de soumission et de validité
        if ($form->isSubmitted() && $form->isValid()){
            try {
                $pokemon->setCatchDate(now());
                $manager->persist($pokemon);
                $manager->flush();
                $this->addFlash('success',"Your pokemon has been added to your Pokedex.");
                return $this->redirect($this->generateUrl('pkm_details',['id'=>$pokemon->getId()]),);
            }catch (Exception $exception){
                $this->addFlash('danger','Your Pokemon has been lost in the abyss. Do NOT try to retrieve it. It\'s dead and eaten. ');
            }
        }

        // afficher la page pkm/create
        return $this->render('pkm/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete',requirements: ['id'=>'\d+'])]
    public function delete(EntityManagerInterface $PokemonManager,PokemonRepository $pokemonRepository,$id): Response
    {
        $pokemon = $pokemonRepository->find($id);
        $PokemonManager->remove($pokemon);
        $PokemonManager->flush();
        if (!$pokemonRepository->find($id)){
            return $this->redirectToRoute('pkm_list');
        }else {
            $pokemon = $pokemonRepository->find($id);
            return $this->render('pkm/details.html.twig', [
                'pokemon'=>$pokemon
            ]);
        }
    }
}
