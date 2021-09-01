<?php

namespace App\Controller;

use App\Entity\Charge;
use App\Repository\ChargeRepository;
use App\Repository\DepotRepository;
use App\Repository\DetailstockRepository;
use App\Repository\ProduitRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
*/


class ChargeController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }

    
    /**
     *  @Route("/charge/liste", name="chargeliste", methods={"GET"})
     */
    public function ChargeListe(ChargeRepository $chargeRepository){
        return $this->json(['data'=>$chargeRepository->findCharge()],200); 
    }
    
    /**
     *  @Route("/charge/addCharge", name="addCharge", methods={"POST"})
     */
    public  function AddCharge(Request $req,DepotRepository $depotRepository,ProduitRepository $produitRepository,DetailstockRepository $detailStockRepository , ChargeRepository $chargeRepository):Response
    {    
        $donnes=json_decode($req->getContent());
        $depot = $depotRepository->findOneByCodedepot($donnes->data->coded->coded);
        $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
        $details= $detailStockRepository->findByIdprodAndCodeD($produit,$depot);    
        $sauv=$this->getDoctrine()->getManager();
        $charge = new Charge();
        $charge->setCoded($depot);
        $charge->setDatec(new DateTime( $donnes->data->datec));
        $charge->setIdprod($produit);
        $charge->setQtep($donnes->data->qtep);
        $charge->setPrixp($donnes->data->prixp);
        $sauv->persist($charge);
        $sauv->flush();  
        $details->setQtep($details->getQtep()-$donnes->data->qtep);
        $sauv->persist($details);
        $sauv->flush();  
        return $this->json(['data'=>$chargeRepository->findCharge()],200); 
    }

    /**
     *  @Route("/charge/updateCharge/{idcharge}", name="updateCharge", methods={"PUT"})
     */
    public  function UpdateCharge(Request $req,?Charge $charge,DepotRepository $depotRepository,ProduitRepository $produitRepository,DetailstockRepository $detailStockRepository , ChargeRepository $chargeRepository):Response
    {    
        $donnes=json_decode($req->getContent());
        $depot = $depotRepository->findOneByCodedepot($donnes->data->coded->coded);
        $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
        $details= $detailStockRepository->findByIdprodAndCodeD($produit,$depot);    
        $sauv=$this->getDoctrine()->getManager();
        $charge->setCoded($depot);
        $charge->setIdprod($produit);
        $charge->setDatec(new DateTime($donnes->data->datec));
        if($charge->getQtep()<$donnes->data->qtep){
            $details->setQtep($details->getQtep()-($charge->getQtep()-$donnes->data->qtep));
        }
        else{
            $details->setQtep($details->getQtep()+($donnes->data->qtep-$charge->getQtep()));
        }
        $charge->setQtep($donnes->data->qtep);
        $charge->setPrixp($donnes->data->prixp);
        $sauv->persist($charge);
        $sauv->flush();  
        $sauv->persist($details);
        $sauv->flush();  
        return $this->json(['data'=>$chargeRepository->findCharge()],200); 
    }

    /**
     *  @Route("/charge/delete/{idcharge}", name="deleteCharge", methods={"PUT"})
     */
     public  function DeleteCharge(Request $req,?Charge $charge,DepotRepository $depotRepository,ProduitRepository $produitRepository,DetailstockRepository $detailStockRepository , ChargeRepository $chargeRepository):Response
     {    
         $donnes=json_decode($req->getContent());
         $depot = $depotRepository->findOneByCodedepot($donnes->data->coded->coded);
         $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
         $details= $detailStockRepository->findByIdprodAndCodeD($produit,$depot);    
         $sauv=$this->getDoctrine()->getManager();
         $details->setQtep($details->getQtep()+$charge->getQtep());
         $sauv->remove($charge);
         $sauv->flush();  
         $sauv->persist($details);
         $sauv->flush();  
         return $this->json(['data'=>$chargeRepository->findCharge()],200); 
     }

}