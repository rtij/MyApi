<?php

namespace App\Controller;

use App\Entity\Ajoutstock;
use App\Entity\Detailstock;
use App\Repository\AchatRepository;
use App\Repository\ApprovisionnementRepository;
use App\Repository\DepotRepository;
use App\Repository\DetailaRepository;
use App\Repository\DetailstockRepository;
use App\Repository\ProduitRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 *  @Route("/api", name="api")
 */


class StockController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     *  @Route("/stock/ajout", name="stockajout", methods={"POST"})
     */
    public function addProduitStock(Request $request,DetailaRepository $detailaRepository)
    {
        $donnes=json_decode($request->getContent());
        $stock = new Detailstock();
        $sauv=$this->getDoctrine()->getManager();
        $stock->setIdprod($donnes->data->idprod);
        $stock->setCoded($donnes->data->coded);
        $stock->setQtep($donnes->data->qtep);
        $sauv->persist($stock);
        $sauv->flush();  
        return $this->json(['data'=>$detailaRepository->findAll()],200); 
    }
    
    /**
     *  @Route("/stock/edit", name="stockedit", methods={"PUT"})
     */
    public function EditProduitStock(Request $request,DetailstockRepository $detailstockRepository,ProduitRepository $produitRepository,DepotRepository $depotRepository)
    {
        $donnes=json_decode($request->getContent());
        $sauv=$this->getDoctrine()->getManager();
        $detailstock = $detailstockRepository->findByIdprodAndCodeD($donnes->Prod->idprod->idprod,$donnes->Prod->coded->coded);
        $detailstock2 = $detailstockRepository->findByIdprodAndCodeD($donnes->Prod->idprod->idprod,$donnes->Depot->coded);
        if($detailstock2){
            $qte = $detailstock2->getQtep();
            if($detailstock->getQtep()<$donnes->Prod->qtep){
                $detailstock2->setQtep($qte-($donnes->Prod->qtep-$detailstock->getQtep()));
            }
            else{
                $detailstock2->setQtep($qte+($detailstock->getQtep()-$donnes->Prod->qtep));    
            }
        }
        else{
            $detailstock2 = new Detailstock();
            $detailstock2->setIdprod($produitRepository->findOneByIdprod($donnes->Prod->idprod->idprod));
            $detailstock2->setQtep($detailstock->getQtep()-$donnes->Prod->qtep);
            $detailstock2->setCoded($depotRepository->findOneByCodedepot($donnes->Depot->coded));    
            
        }
        $detailstock->setQtep($donnes->Prod->qtep);
        $sauv->persist($detailstock);
        $sauv->flush();
        $sauv->persist($detailstock2);
        $sauv->flush();  
        return $this->json(['data'=>$detailstockRepository->findAll()],200); 
    }

    /**
     *  @Route("/stock/liste", name="stockListe", methods={"GET"})
     */
    public function StockListe(DetailstockRepository $detailstockRepository)
    {
        return $this->json(['data'=>$detailstockRepository->findAll()],200); 
    }
    

    /**
     *  @Route("/ajoutstcok/ajout", name="ajoutstock", methods={"POST"})
     */
    public function AjoutStock(Request $request, AchatRepository $achatRepository, DepotRepository $depotRepository, ProduitRepository $produitRepository, DetailstockRepository $detailStockRepository, ApprovisionnementRepository $approvisionnementRepository)
    {
        $donnes = json_decode($request->getContent());
        $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
        $depot = $depotRepository->findOneByCodedepot($donnes->data->coded->codedepot);
        $stock = $detailStockRepository->findByIdprodAndCodeD($produit, $depot);
        if ($stock) {
            $ajoutstock = new Ajoutstock();
            $ajoutstock->setIdprod($produit);
            $ajoutstock->setCoded($depot);
            $ajoutstock->setNuma($achatRepository->findOneByNuma($donnes->data->numa->numa));
            $ajoutstock->setQtep($donnes->data->qtep);
            $sauv = $this->getDoctrine()->getManager();
            $sauv->persist($ajoutstock);
            $sauv->flush();
            $qtep = $stock->getQtep();
            $stock->setQtep($qtep + $donnes->data->qtep);
            $sauv->persist($stock);
            $sauv->flush();
        } else {
            $ajoutstock = new Ajoutstock();
            $ajoutstock->setIdprod($produit);
            $ajoutstock->setCoded($depot);
            $ajoutstock->setNuma($achatRepository->findOneByNuma($donnes->data->numa->numa));
            $ajoutstock->setQtep($donnes->data->qtep);
            $detailstock = new Detailstock();
            $detailstock->setIdprod($produit);
            $detailstock->setCoded($depot);
            $detailstock->setQtep($donnes->data->qtep);
            $sauv = $this->getDoctrine()->getManager();
            $sauv->persist($ajoutstock);
            $sauv->flush();
            $sauv->persist($detailstock);
            $sauv->flush();
        }
        return $this->json(['data' => $approvisionnementRepository->findAll()], 200);
    }
}
