<?php

namespace App\Controller;

use App\Entity\Ciff;
use App\Entity\Frs;
use App\Entity\Niff;
use App\Entity\Rcsf;
use App\Entity\Statf;
use App\Repository\CiffRepository;
use App\Repository\FrsRepository;
use App\Repository\NiffRepository;
use App\Repository\RcsfRepository;
use App\Repository\StatfRepository;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
*/


class FrsController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }

    
    /**
     *  @Route("/frs/liste", name="listeFrs", methods={"GET"})
     */
    public function listeFrs(FrsRepository $FrsRepository)
    {
        return $this->json(['data'=>$FrsRepository->FindNonSup()],200);
    }
    /**
     *  @Route("/frs/addFrs", name="addFrs", methods={"POST"})
     */
    public  function AddFrs(Request $req,RcsfRepository $rcsfRepository, FrsRepository $liste,NiffRepository $niffRepository,CiffRepository $ciffRepository,StatfRepository $statfRepository)
    { 
        $donnes=json_decode($req->getContent());
        // Création frs
        $frs = new Frs();
        $frs->setNomf($donnes->data->nomf);
        $frs->setAdrf($donnes->data->adrf);
        $frs->setEmailf($donnes->data->emailf);
        $frs->setFrsSup(0);
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($frs);
        $sauv->flush();        
        // ajout de niff
        if(($niffRepository->findOneByNiff($donnes->data->niff))){
            return new Response('Erreur de duplication sur nif',500);
        }
        elseif($donnes->data->niff!=""){
            $niff = new Niff();
            $niff->setIdf($liste->findOneByNomf($donnes->data->nomf));
            $niff->setNiff($donnes->data->niff);
            $sauv->persist($niff);
            $sauv->flush();          
        }
        // ajout de ciff
        if($ciffRepository->findOneByCiff($donnes->data->ciff)){
            return new Response('Erreur de duplication sur cif',500);
        }
        elseif($donnes->data->ciff!=""){
            $ciff = new Ciff();
            $ciff->setIdf($liste->findOneByNomf($donnes->data->nomf));
            $ciff->setciff($donnes->data->niff);
            $sauv->persist($ciff);
            $sauv->flush();          
        }
        // ajout de statf
        if($statfRepository->findOneByStatf($donnes->data->statf)){
            return new Response('Erreur de duplication sur statf',500);
        }
        elseif($donnes->data->statf!=""){
            $Statf = new Statf();
            $Statf->setIdf($liste->findOneByNomf($donnes->data->nomf));
            $Statf->setStatf($donnes->data->statf);
            $sauv->persist($Statf);
            $sauv->flush();          
        }
        // ajout de rcsf
        if($rcsfRepository->findOneByRcsf($donnes->data->rcsf)){
            return new Response('Erreur de duplication sur statf',500);
        }
        elseif($donnes->data->rcsf!=""){
            $Rcsf = new Rcsf();
            $Rcsf->setIdf($liste->findOneByNomf($donnes->data->nomf));
            $Rcsf->setRcsf($donnes->data->rcsf);
            $sauv->persist($Rcsf);
            $sauv->flush();          
        }
        //sauvegarde
        return $this->json(['data'=>$liste->FindNonSup()],200);
    
    }
    
     /**
     *  @Route("/frs/EditFrs/{idf}", name="editFrs", methods={"PUT"})
     */
    public function EditFrs(Request $req,?Frs $frs,?Niff $niff,?Rcsf $Rcsf,?Ciff $ciff,?Statf $Statf,RcsfRepository $rcsfRepository, FrsRepository $liste,NiffRepository $niffRepository,CiffRepository $ciffRepository,StatfRepository $statfRepository){     
        $donnes=json_decode($req->getContent());
        // Création frs
        $frs->setNomf($donnes->data->nomf);
        $frs->setAdrf($donnes->data->adrf);
        $frs->setEmailf($donnes->data->emailf);
        $frs->setfrsSup($donnes->data->frsSup);
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($frs);
        $sauv->flush();
        $nifResult = $niffRepository->findOneByNiff($donnes->data->niff);         
        // ajout de niff
        if($niff)
        {
            if($nifResult && ($nifResult->getIdf()!=$niff->getIdf())){
                return new Response('Erreur de duplication sur nif',500);
            }
            else{
                $niff->setNiff($donnes->data->niff);
                $sauv->persist($niff);
                $sauv->flush();          
            }
        }
        elseif($donnes->data->niff!=null)
        {
            $niff = new Niff();
            $niff->setIdf($frs);
            $niff->setNiff($donnes->data->niff);
            $sauv->persist($niff);
            $sauv->flush();          
        }
        $cifResult = $ciffRepository->findOneByCiff($donnes->data->ciff);
        // ajout de ciff
        if($ciff)
        {
            if($cifResult && ($cifResult->getIdf()!=$ciff->getIdf())){
                return new Response('Erreur de duplication sur cif',500);
            }
            else{
                $ciff->setciff($donnes->data->ciff);
                $sauv->persist($ciff);
                $sauv->flush();          
            }
        }
        elseif($donnes->data->ciff!=null)
        {
            $ciff = new Ciff();
            $ciff->setIdf($frs);
            $ciff->setCiff($donnes->data->ciff);
            $sauv->persist($ciff);
            $sauv->flush();
        }
        // ajout de statf
        $StatResult = $statfRepository->findOneByStatf($donnes->data->statf);
        if($Statf)
        {
            if($StatResult && ($StatResult->getIdf()!=$Statf->getIdf())){
                return new Response('Erreur de duplication sur statf',500);
            }
            else{
                $Statf->setStatf($donnes->data->statf);
                $sauv->persist($Statf);
                $sauv->flush();          
            }
        }
        elseif($donnes->data->statf!=null)
        {
            $Statf = new Statf();
            $Statf->setIdf($frs);
            $Statf->setStatf($donnes->data->statf);
            $sauv->persist($Statf);
            $sauv->flush();
        }
        // ajout de rcsf
        $RcsResult = $rcsfRepository->findOneByRcsf($donnes->data->rcsf);
        if($Rcsf)
        {
            if($RcsResult && ($RcsResult->getIdf()!=$Rcsf->getIdf())){
                return new Response('Erreur de duplication sur statf',500);
            }
            else{
                $Rcsf->setRcsf($donnes->data->rcsf);
                $sauv->persist($Rcsf);
                $sauv->flush();          
            }
        }
        elseif($donnes->data->rcsf!=null)
        {
            $Rcsf = new Rcsf();
            $Rcsf->setIdf($frs);
            $Rcsf->setRcsf($donnes->data->rcsf);
            $sauv->persist($Rcsf);
            $sauv->flush();
        }
        //sauvegarde
        return $this->json(['data'=>$liste->FindNonSup()],200);
    }
    
}