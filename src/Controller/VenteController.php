<?php

namespace App\Controller;

use App\Entity\Detailv;
use App\Entity\Vente;
use App\Repository\ClientRepository;
use App\Repository\DepotRepository;
use App\Repository\DetailstockRepository;
use App\Repository\DetailvRepository;
use App\Repository\ProduitRepository;
use App\Repository\VenteRepository;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 *  @Route("/api", name="api")
*/


class VenteController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }
    
    /**
     *  @Route("/vente/lastVente", name="lastVente", methods={"GET"})
     */
    public function GetLastVente(Request $req,VenteRepository $venteRepository):Response
    {
        $id = $venteRepository->findMax();
        if($id["id"]==null){
            $id = 1;
        }
        else{
            $id = $id["id"]+1;
        }
        return $this->json(['data' => $id], 200);
    }

    /**
     *  @Route("/vente/addVente", name="addVente", methods={"POST"})
     */
    public function Vente(Request $req,DepotRepository $depotRepository,DetailstockRepository $detailStockRepository,ProduitRepository $produitRepository,ClientRepository $clientRepository,DetailvRepository $detailvRepository,VenteRepository $venteRepository):Response
   {
        $donnes=json_decode($req->getContent());
        $sauv=$this->getDoctrine()->getManager();
        $produit = $detailStockRepository->findByIdprodAndCodeD($produitRepository->findOneByIdprod($donnes->data->idprod->idprod),$depotRepository->findOneByCodedepot($donnes->data->coded->coded));
        $vente= $venteRepository->findOneByNumv($donnes->data->numv->numv);
        if($vente){
            $detailV = $detailvRepository->findByNumvAndIdprodAndCoded($vente,$produitRepository->findOneByIdprod($donnes->data->idprod->idprod),$depotRepository->findOneByCodedepot($donnes->data->coded->coded));
            if($detailV){
                $detailV->setNumv($vente);
                $qte=$detailV->getQtev();
                if($qte>$donnes->data->qtev){
                    $qte = $qte-$donnes->data->qtev;
                    $produit->setQtep($produit->getQtep()+$qte);
                }
                else
                {
                    $qte = $qte+$donnes->data->qtev;
                    $produit->setQtep($produit->getQtep()-$qte);    
                }
                $detailV->setQtev($donnes->data->qtev);
                $detailV->setPrixv($donnes->data->prixv);
                $detailV->setCoded($depotRepository->findOneByCodedepot($donnes->data->coded->coded));
                $detailV->setIdprod($produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
                $sauv->persist($detailV);
                $sauv->flush();
            }
            else
            {
                $detailV = new DetailV(); 
                $detailV->setNumv($vente);
                $detailV->setQtev($donnes->data->qtev);
                $detailV->setPrixv($donnes->data->prixv);
                $detailV->setCoded($depotRepository->findOneByCodedepot($donnes->data->coded->coded));
                $detailV->setIdprod($produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
                $sauv->persist($detailV);
                $sauv->flush();
                $produit->setQtep($produit->getQtep()-$donnes->data->qtev);
            }
              
        }
        else
        {
            $vente = new Vente();
            $date= new DateTime($donnes->data->numv->datev);
            $vente->setDatev($date);
            $vente->setIdcl($clientRepository->findOneByIdcl($donnes->data->numv->idcl->idcl));
            $vente->setTvav($donnes->data->numv->tvav);
            $sauv->persist($vente);
            $sauv->flush();
            $detailV = new Detailv();
            $numV= $venteRepository->findOneByNumv($donnes->data->numv->numv);
            $detailV->setNumv($numV);
            $detailV->setCoded($depotRepository->findOneByCodedepot($donnes->data->coded->coded));
            $detailV->setQtev($donnes->data->qtev);
            $detailV->setPrixv($donnes->data->prixv);
            $detailV->setIdprod($produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
            $sauv->persist($detailV);
            $sauv->flush();
            $produit->setQtep($produit->getQtep()-$donnes->data->qtev);
        }
        $sauv->persist($produit);
        $sauv->flush();
        return $this->json(['data'=>$detailvRepository->findByNumv($venteRepository->findOneByNumv($donnes->data->numv->numv))],200);  
    }

    /**
     *  @Route("/vente/vueVente", name="vueVente", methods={"POST"})
     */
    public function VueVente(Request $req,DetailvRepository $detailvRepository):Response
   {
        $donnes=json_decode($req->getContent());
        return $this->json(['data'=>$detailvRepository->findByNumv($donnes->a)],200);  
    }
    
    /**
     *  @Route("/vente/delete", name="DeleteVente", methods={"POST"})
     */
    public function DeleteVente(Request $req,DetailstockRepository $detailStockRepository,DepotRepository $depotRepository,DetailvRepository $detailvRepository,ProduitRepository $produitRepository,VenteRepository $venteRepository):Response
   {
        $donnes=json_decode($req->getContent());
        $vente = $venteRepository->findOneByNumv($donnes->data->numv->numv);
        $depot = $depotRepository->findOneByCodedepot($donnes->data->coded->coded);
        $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
        $result= $detailvRepository->findByNumvAndIdprodAndCoded($vente,$produit,$depot);
        if($result){
            $sauv=$this->getDoctrine()->getManager();
            $sauv->remove($result);
            $sauv->flush();
            $details= $detailStockRepository->findByIdprodAndCodeD($produit,$depot);
            $details->setQtep($details->getQtep()+$result->getQtev());
            $sauv->persist($details);
            $sauv->flush();  
        }
        return $this->json(['data'=>$detailvRepository->findByNumv($donnes->data->numv->numv)],200);  
    }
    
    /**
     *  @Route("/vente/liste", name="venteliste", methods={"GET"})
     */
    public function venteListe(VenteRepository $venteRepository)
    {
        return $this->json(['data'=>$venteRepository->OrderByDate()],200); 
    }

}