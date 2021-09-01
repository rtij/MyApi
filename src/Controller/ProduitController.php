<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\FamilleRepository;
use App\Repository\ProduitRepository;
use App\Repository\UniteRepository;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
*/


class ProduitController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }

    
    /**
     *  @Route("/produit/addProduit", name="addProduit", methods={"POST"})
     */
    public function AddProduit(Request $req,UniteRepository $unite,FamilleRepository $familleRepository, ProduitRepository $liste):Response
    {       
        $donnes=json_decode($req->getContent());
        $produit = new Produit();
        $produit->setDesproduit($donnes->data->desproduit);
        $produitResult=$liste->findOneByRefproduit($donnes->data->refproduit);
        if($produitResult)
        {
            return new Response("Référence déja utilisé",401);
        }
        else{
            $produit->setRefproduit($donnes->data->refproduit);
        }
        
        $produit->setSeuilap($donnes->data->seuilap);
        $produit->setPrixvp($donnes->data->prixv);
        $produit->setPrixap($donnes->data->prixap);
        $produit->setProdSup(0);
        $produit->setIdfamille($familleRepository->findOneByIdfamille($donnes->data->idfamille));
        $produit->setIdu($unite->findOneByIdu($donnes->data->idu));
        //sauvegarde
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($produit);
        $sauv->flush();  
        return $this->json(['data'=>$liste->FindPro()],200);    
    } 
    
     /**
     *  @Route("/produit/liste", name="listeProduit", methods={"GET"})
     */
    public function listeProduit(ProduitRepository $liste):Response{
        return $this->json(['data'=>$liste->FindPro()],200);    
    }
    
     /**
     *  @Route("/produit/EditProduit/{idprod}", name="editProduit", methods={"PUT"})
     */
    public function EditProduit(?Produit $produit,Request $req,UniteRepository $unite,FamilleRepository $familleRepository, ProduitRepository $liste):Response
   {
        $donnes=json_decode($req->getContent());
        $produit->setDesproduit($donnes->data->desproduit);
        $produitResult=$liste->findOneByRefproduit($donnes->data->refproduit);
        if($produitResult &&($produitResult!=$produit))
        {
            return new Response("Référence déja utilisé",401);
        }
        else{
            $produit->setRefproduit($donnes->data->refproduit);
        }
        $produit->setSeuilap($donnes->data->seuilap);
        $produit->setPrixvp($donnes->data->prixvp);
        $produit->setPrixap($donnes->data->prixap);
        $produit->setIdfamille($familleRepository->findOneByFamille($donnes->data->idfamille->famille));
        $produit->setIdu($unite->findOneByDesunit($donnes->data->idu->desunit));
        $produit->setProdSup($donnes->data->prodSup);
        //sauvegarde
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($produit);
        $sauv->flush();  
        return $this->json(['data'=>$liste->FindPro()],200);  
    }
}

