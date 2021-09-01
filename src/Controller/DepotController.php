<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Repository\DepotRepository;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
*/


class DepotController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }

    
     /**
     *  @Route("/depot/liste", name="listeDepot", methods={"GET"})
     */
    public function listeDepot(DepotRepository $depotRepository):Response{
        return $this->json(['data'=>$depotRepository->FindNonSup()],200);    
    }
    
    /**
     *  @Route("/depot/addDepot", name="addDepot", methods={"POST"})
     */
    public  function AddDepot(Request $req, DepotRepository $liste):Response
    {
            $donnes=json_decode($req->getContent());
            $depot = new Depot();
            $depot->setDesdep($donnes->data->desdep);
            $depot->setDepSup(0);
            //sauvegarde
            $sauv=$this->getDoctrine()->getManager();
            $sauv->persist($depot);
            $sauv->flush();  
            return $this->json(['data'=>$liste->FindNonSup()],200);    
    } 
     /**
     *  @Route("/depot/EditDepot/{coded}", name="editDepot", methods={"PUT"})
     */
    public function EditDepot(?Depot $depot,Request $req, DepotRepository $liste):Response
    {
        $donnes=json_decode($req->getContent());
        $depot->setDesdep($donnes->data->desdep);
        $depot->setDepSup($donnes->data->depSup);
        //sauvegarde
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($depot);
        $sauv->flush();
        return $this->json(['data'=>$liste->FindNonSup()],200);
    }

}