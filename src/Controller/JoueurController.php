<?php

namespace App\Controller;

use App\Form\VoteType;
use App\Repository\JoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    #[Route('/joueur', name: 'app_joueur')]
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }


    public function getSommeVotebyJoueur($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT SUM (v.noteVote) AS somme FROM App\Entity\Vote v JOIN v.joueur j where j.id=:id")
            ->setParameter('id', $id);
        return $query->getSingleScalarResult();
    }


    #[Route('/joueur', name: 'app_joueur')]
    public function listJoueur(JoueurRepository $joueurRepository)
{
$joueurs = $joueurRepository->findBy(array(),array('nom'=>'ASC'));
return $this->render('joueur/index.html.twig', ['joueurs' =>$joueurs]);
}

    #[Route('/joueur/show', name: 'app_show')]
    public function showJoueurs(JoueurRepository $joueurRepository): Response
    {
        $query = $joueurRepository->createQueryBuilder('j')
            ->where('j.equipe = :val')
            ->setParameter('val', 'Tunisie')
            ->orderBy('j.nom', 'ASC')
            ->setMaxResults(10)
            ->getQuery();

        $joueurs = $query->getResult();

        return $this->render('Joueur/list.html.twig', [
            'joueurs' => $joueurs,
        ]);

    }

}

