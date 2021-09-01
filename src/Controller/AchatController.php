<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Detaila;
use App\Repository\AchatpaiementRepository;
use App\Repository\AchatRepository;
use App\Repository\AjoutStockRepository;
use App\Repository\DetailaRepository;
use App\Repository\DetailstockRepository;
use App\Repository\FrsRepository;
use App\Repository\PaeimentARepository;
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


class AchatController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     *  @Route("/achat/lastAchat", name="lastachat", methods={"GET"})
     */
    public function LastAchat(AchatRepository $achatRepository): Response
    {
        $id = $achatRepository->findMax();
        if ($id["id"] == null) {
            $id = 1;
        } else {
            $id = $id["id"] +1;
        }
        return $this->json(['data' => $id], 200);
    }

    /**
     *  @Route("/achat/addAchat", name="addachat", methods={"POST"})
     */
    public function Achat(Request $req, ProduitRepository $produitRepository, AchatRepository $achatRepository, FrsRepository $frsRepository, detailaRepository $detailaRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $achat = $achatRepository->findOneByNuma($donnes->data->numa->numa);
        if ($achat) {
            $detailA = $detailaRepository->findByIdProdAndNumA($achat, $produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
            if ($detailA) {
                $detailA->setNuma($achat);
                $detailA->setQtea($donnes->data->qtea);
                $detailA->setPrixa($donnes->data->prixa);
                $detailA->setIdprod($produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
                $sauv->persist($detailA);
                $sauv->flush();
            } else {
                $detailA = new Detaila();
                $detailA->setNuma($achat);
                $detailA->setQtea($donnes->data->qtea);
                $detailA->setPrixa($donnes->data->prixa);
                $detailA->setIdprod($produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
                $sauv->persist($detailA);
                $sauv->flush();
            }
        } else {
            $achat = new Achat();
            $date = new DateTime($donnes->data->numa->datea);
            $achat->setDatea($date);
            $achat->setIdf($frsRepository->findOneByIdf($donnes->data->numa->idf->idf));
            $achat->setTvaa($donnes->data->numa->tvaa);
            $sauv->persist($achat);
            $sauv->flush();
            $detailA = new Detaila();
            $numA = $achatRepository->findOneByNuma($donnes->data->numa->numa);
            $detailA->setNuma($numA);
            $detailA->setQtea($donnes->data->qtea);
            $detailA->setPrixa($donnes->data->prixa);
            $detailA->setIdprod($produitRepository->findOneByIdprod($donnes->data->idprod->idprod));
            $sauv->persist($detailA);
            $sauv->flush();
        }
        return $this->json(['data' => $detailaRepository->findByNuma($achatRepository->findOneByNuma($donnes->data->numa->numa))], 200);
    }

    /**
     *  @Route("/achat/vueAchat", name="vueAchat", methods={"POST"})
     */
    public function VueAchat(Request $req, detailaRepository $detailaRepository): Response
    {
        $donnes = json_decode($req->getContent());
        return $this->json(['data' => $detailaRepository->findByNuma($donnes->a)], 200);
    }

    /**
     *  @Route("/achat/montAchat", name="montAchat", methods={"GET"})
     */
    public function MontAchat(AchatpaiementRepository $achatpaiementRepository): Response
    {
        return $this->json([$achatpaiementRepository->findAll()], 200);
    }

    /**
     *  @Route("/achat/delete", name="DeleteAchat", methods={"POST"})
     */
    public function DeleteDetailAchat(Request $req, DetailstockRepository $detailStockRepository, AjoutStockRepository $ajoutStockRepository, detailaRepository $detailaRepository, ProduitRepository $produitRepository, AchatRepository $achatRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $achat = $achatRepository->findOneByNuma($donnes->data->numa->numa);
        $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
        $result = $detailaRepository->findByIdProdAndNumA($achat, $produit);
        if ($result) {
            $sauv = $this->getDoctrine()->getManager();
            $ajout = $ajoutStockRepository->findByNumaAndIdprod($produit, $achat);
            if ($ajout) {
                foreach ($ajout as $it) {
                    $stock = $detailStockRepository->findByIdprodAndCodeD($it->getIdprod(), $it->getCoded());
                    $stock->setQtep($stock->getQtep() - $it->getQtep());
                    $sauv->persist($stock);
                    $sauv->flush();
                    $sauv->remove($it);
                    $sauv->flush();
                }
            }
            $sauv->remove($result);
            $sauv->flush();
        }
        return $this->json(['data' => $detailaRepository->findByNuma($donnes->data->numa->numa)], 200);
    }

    /**
     *  @Route("/achat/sup", name="SupAchat", methods={"POST"})
     */
    public function DeleteAchat(Request $req, PaeimentARepository $paeimentARepository, DetailaRepository $detailaRepository, ProduitRepository $produitRepository, AchatRepository $achatRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $achat = $achatRepository->findOneByNuma($donnes->data->numa->numa);
        $produit = $produitRepository->findOneByIdprod($donnes->data->idprod->idprod);
        $result = $detailaRepository->findByIdProdAndNumA($achat, $produit);
        if (!$detailaRepository->findByNuma($donnes->data->numa->numa)) {
            $paiement = $paeimentARepository->findOneByNuma($achat);
            if ($paiement) {
                foreach ($paiement as $paie) {
                    $sauv->remove($paie);
                    $sauv->flush();
                }
            }
            $sauv->remove($achat);
            $sauv->flush();
        }
        return new Response("");
    }
}
