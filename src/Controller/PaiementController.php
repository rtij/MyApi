<?php

namespace App\Controller;

use DateTime;
use App\Entity\Paiementa;
use App\Entity\Paiementv;
use App\Repository\AchatRepository;
use App\Repository\VenteRepository;
use App\Repository\PaeimentARepository;
use App\Repository\PaiementVRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AchatpaiementRepository;
use App\Repository\PaiementachatRepository;
use App\Repository\PaiementventeRepository;
use App\Repository\VentepaiementRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ApprovisionnementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 *  @Route("/api", name="api")
*/


class PaiementController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }
    
    /**
     *  @Route("/paiementachatt/liste", name="paiementachatliste", methods={"GET"})
     */
    public function PaiementAchat(ApprovisionnementRepository $approvisionnementRepository)
    {
        return $this->json(['data' => $approvisionnementRepository->findApprovisionnement()], 200);
    }

        /**
     *  @Route("/paiementAchat/liste", name="paiementachatliste", methods={"GET"})
     */
    public function PaiementAchatListe(PaiementachatRepository $paiementachatRepository)
    {
        return $this->json(['data' => $paiementachatRepository->findAll()], 200);
    }


    /**
     *  @Route("/paiementVente/liste", name="paiementventeliste", methods={"GET"})
     */
    public function PaiementVenteListe(PaiementventeRepository $paiementventeRepository)
    {
        return $this->json(['data' => $paiementventeRepository->findAll()], 200);
    }

    /**
     *  @Route("/Achatpaiement/liste", name="achatpaiementliste", methods={"GET"})
     */
    public function AchatpaiementListe(AchatpaiementRepository $achatpaiementRepository)
    {
        return $this->json(['data' => $achatpaiementRepository->findAll()], 200);
    }


    /**
     *  @Route("/Ventepaiement/liste", name="Ventepaiementliste", methods={"GET"})
     */
    public function VentepaiementListe(VentepaiementRepository $VentepaiementRepository)
    {
        return $this->json(['data' => $VentepaiementRepository->findAll()], 200);
    }

    /**
     *  @Route("/paiementachat/ajout", name="ajoutPaiementachat", methods={"POST"})
     */
    public  function PaiementAchatAjout(Request $req, AchatRepository $achatRepository, AchatpaiementRepository $achatpaiementRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $paiement = new Paiementa();
        $date = new DateTime($donnes->data->datep);
        $paiement->setDatep($date);
        $paiement->setMontantp($donnes->data->montantp);
        $paiement->setPiece($donnes->data->piece);
        $paiement->setNuma($achatRepository->findOneByNuma($donnes->data->numa->numa));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($paiement);
        $sauv->flush();
        return $this->json(['data' => $achatpaiementRepository->findAll()], 200);
    }

    /**
     *  @Route("/paiementachat/update/{idpaiement}", name="updatePaiementachat", methods={"PUT"})
     */
    public  function PaiementAchatModif(Request $req, Paiementa $paiement, AchatRepository $achatRepository, PaeimentARepository $paeimentARepository): Response
    {
        $donnes = json_decode($req->getContent());
        $date = new DateTime($donnes->data->datep);
        $paiement->setDatep($date);
        $paiement->setMontantp($donnes->data->montantp);
        $paiement->setPiece($donnes->data->piece);
        $paiement->setNuma($achatRepository->findOneByNuma($donnes->data->numa->numa));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($paiement);
        $sauv->flush();
        return $this->json(['data' => $paeimentARepository->findAll()], 200);
    }


    /**
     *  @Route("/paiementvente/ajout", name="ajoutPaiementvente", methods={"POST"})
     */
    public  function PaiementVenteAjout(Request $req, VenteRepository $venteRepository, VentepaiementRepository $ventepaiementRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $paiement = new Paiementv();
        $date = new DateTime($donnes->data->datep);
        $paiement->setDatep($date);
        $paiement->setMontantp($donnes->data->montantp);
        if ($donnes->data->piece) {
            $paiement->setPiece($donnes->data->piece);
        }
        $paiement->setNumv($venteRepository->findOneByNumv($donnes->data->numv->numv));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($paiement);
        $sauv->flush();
        return $this->json(['data' => $ventepaiementRepository->findAll()], 200);
    }

    /**
     *  @Route("/paiementvente/update/{idpaiementv}", name="updatePaiementvente", methods={"PUT"})
     */
    public  function PaiementVenteModif(Request $req, Paiementv $paiement, VenteRepository $venteRepository, PaiementVRepository $paiementVRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $date = new DateTime($donnes->data->datep);
        $paiement->setDatep($date);
        $paiement->setMontantp($donnes->data->montantp);
        if ($donnes->data->piece) {
            $paiement->setPiece($donnes->data->piece);
        }
        $paiement->setNumv($venteRepository->findOneByNumv($donnes->data->numv->numv));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($paiement);
        $sauv->flush();
        return $this->json(['data' => $paiementVRepository->findAll()], 200);
    }

    
    /**
     *  @Route("/paiementa/liste", name="paiementAliste", methods={"GET"})
     */
    public function PaiementListe(PaeimentARepository $paeimentARepository)
    {
        return $this->json(['data' => $paeimentARepository->findAll()], 200);
    }

    /**
     *  @Route("/paiementv/liste", name="paiementVliste", methods={"GET"})
     */
    public function PaiementVListe(PaiementVRepository $paeimentVRepository)
    {
        return $this->json(['data' => $paeimentVRepository->findAll()], 200);
    }

}