<?php

namespace App\Controller;

use App\Repository\JoueurRepository;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoteController extends AbstractController
{
    #[Route('/vote', name: 'app_vote')]
    public function index(): Response
    {
        return $this->render('vote/index.html.twig', [
            'controller_name' => 'VoteController',
        ]);
    }

    #[Route('/joueur', name: 'app_joueur')]
    public function listJoueur(JoueurRepository $joueurRepository)
    {
        $joueurs = $joueurRepository->findBy(array(),array('nom'=>'ASC'));
        return $this->render('joueur/list.html.twig', ['joueurs' =>$joueurs]);
    $vote = new Vote();
    $form = $this->createForm(VoteType::class, $vote);
    $form->handleRequest($request);
    $em = $doctrine->getManager();
    if ($form->isSubmitted()) {
        $vote->setDate(new \DateTime());
        $noteVote = $vote->getNoteVote();
        $joueurVote = $vote->getJoueur();
        $em->persist($vote);
        $em->flush();
        $joueurVote->setMoyenneVote ($vr->getSommeVotebyJoueur($votejoueur->getId())/($joueurVote ->getVotes()->count()));
        $em->flush();
       return $this->redirectToRoute('app_joueur');
}
        return $this->renderForm('joueur/list.html.twig', [
       'form'=>$form
    ]);
}

    #[Route('/joueur/listvote', name: 'app_vote_byjoueur')]
    public function detailVotesParJoueur(VoteRepository $repository,$id,JoueurRepository $repo)
    {
        $votes = $repository->getVotesByJoueur($id);
        $joueur = $repo->find($id);
        return $this->render('vote/votesByJoueur.html.twig', [
            ...$votes,
            ...$joueur
        ]);
    }
}
