<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Repository\FamilleRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
*/


class FamilleController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }
    
    /**
     *  @Route("/famille/liste", name="listeFamille", methods={"GET"})
     */
    public function list(FamilleRepository $familleRepository)
    {
        return $this->json(['data'=>$familleRepository->FindNonSup()],200);
    }
    
    /**
     *  @Route("/famille/addFamille", name="addFamille", methods={"POST"})
     */
    public  function AddFamille(Request $req, FamilleRepository $liste)
    {     
        $donnes=json_decode($req->getContent());
        $famille = new Famille();
        $famille->setFamille($donnes->data->famille);
        $famille->setFamilleSup(0);
        //sauvegarde
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($famille);
        $sauv->flush();
        return $this->json(['data'=>$liste->FindNonSup()],200);
    }
    /**
     *  @Route("/famille/updateFam/{idfamille}", name="updateFam", methods={"PUT"})
     */
    public function UpdateFamille(Request $req, ?Famille $famille,FamilleRepository $liste){
        $donnes=json_decode($req->getContent());
        $famille->setFamille($donnes->data->famille);
        $famille->setFamilleSup($donnes->data->familleSup);
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($famille);
        $sauv->flush();       
        return $this->json(['data'=>$liste->FindNonSup()],200);    
    }
}