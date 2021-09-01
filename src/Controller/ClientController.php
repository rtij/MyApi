<?php

namespace App\Controller;

use App\Entity\Cifclient;
use App\Entity\Client;
use App\Entity\Nifclient;
use App\Entity\Rcsclient;
use App\Entity\Statclient;
use App\Repository\CifclientRepository;
use App\Repository\ClientRepository;
use App\Repository\NifclientRepository;
use App\Repository\RcsclientRepository;
use App\Repository\StatclientRepository;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
*/


class ClientController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;    
    }

    
    /**
     *  @Route("/client/liste", name="listeClient", methods={"GET"})
     */
    public function listeClient(ClientRepository $clientRepository)
    {
        return $this->json(['data'=>$clientRepository->FindNonSup()],200);
    }

    /**
     *  @Route("/client/addClient", name="addClient", methods={"POST"})
     */
    public  function AddClient(Request $req,RcsclientRepository $rcsclientRepository,StatclientRepository $statclientRepository,NifclientRepository $nifclientRepository,CifclientRepository $cifclientRepository, ClientRepository $liste):Response
    {
        $donnes=json_decode($req->getContent());
        $client = new Client();
        $nifClient = new Nifclient();
        $CifClient = new Cifclient();
        $StatClient = new Statclient();
        $RcsClient = new Rcsclient();
        if($liste->findOneByNomcl($donnes->data->nomcl)){
            return new Response("Cette Nom éxiste déja",500);    
        }
        $client->setNomcl($donnes->data->nomcl);
        $client->setAdrcl($donnes->data->adrcl);
        $client->setEmailcl($donnes->data->emailcl);
        $client->setClientSup(0);
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($client);
        $sauv->flush();      
        $idCl=$liste->findOneByNomcl($donnes->data->nomcl);
        if(($nifclientRepository->findOneByNifcl($donnes->data->nifcl))){
            return new Response("Cette Nif éxiste déja",500);    
        }
        elseif($donnes->data->nifcl!=""){
            $nifClient->setNifcl($donnes->data->nifcl);
            $nifClient->setIdcl($idCl);
            $sauv->persist($nifClient);
            $sauv->flush();
        }
        if($cifclientRepository->findOneByCifcl($donnes->data->cifcl) ){
            return new Response("Cette Cif éxiste déja",500);   
        }
        elseif($donnes->data->cifcl!=""){
            $CifClient->setCifCl($donnes->data->cifcl);
            $CifClient->setIdcl($idCl);
            $sauv->persist($CifClient);
            $sauv->flush();
        }
        if($statclientRepository->findOneByStatcl($donnes->data->statcl)){
            return new Response("Cette Cif éxiste déja",500);   
        }
        elseif($donnes->data->statcl!="")
        {
            $StatClient->setStatcl($donnes->data->statcl);
            $StatClient->setIdcl($idCl);
            $sauv->persist($StatClient);
            $sauv->flush();
        }
        if($rcsclientRepository->findOneByRcscl($donnes->data->rcscl)){
            return new Response("Cette Cif éxiste déja",500);
        }
        elseif($donnes->data->rcscl!="")
        {
            $RcsClient->setRcscl($donnes->data->rcscl);
            $RcsClient->setIdcl($idCl);
            $sauv->persist($RcsClient);
            $sauv->flush();
        }
        return $this->json(['data'=>$liste->FindNonSup()],200);
    }

     /**
     *  @Route("/client/EditClient/{idcl}", name="editClient", methods={"PUT"})
     */
    public function EditClient(RcsclientRepository $rcsclientRepository,StatclientRepository $statclientRepository,NifclientRepository $nifclientRepository,CifclientRepository $cifclientRepository,?Client $client,?Rcsclient $RcsClient,?Statclient $StatClient,?Nifclient $nifClient,?Cifclient $CifClient,Request $req, ClientRepository $liste):Response
    {
        $donnes=json_decode($req->getContent());
        $client->setNomcl($donnes->data->nomcl);
        $client->setAdrcl($donnes->data->adrcl);
        $client->setEmailcl($donnes->data->emailcl);
        $client->setClientSup($donnes->data->clientSup);
        $sauv=$this->getDoctrine()->getManager();
        $sauv->persist($client);
        $sauv->flush();
        
        $nif =$nifclientRepository->findOneByNifcl($donnes->data->nifcl);       
        if($nifClient)
        {
            if($nif && ($nif->getIdCl()!= $nifClient->getIdcl()) ){
                return new Response("Cette nif est déja utilisé",400);    
            }
            else
            {
                $nifClient->setNifcl($donnes->data->nifcl);
                $sauv->persist($nifClient);
                $sauv->flush();
            }
        }
        elseif($donnes->data->nifcl!=null)
        {
            $NifClient = new Nifclient();
            $NifClient->setIdcl($client);
            $NifClient->setNifCl($donnes->data->nifcl);
            $sauv->persist($NifClient);
            $sauv->flush();
        }
        $cif = $cifclientRepository->findOneByCifcl($donnes->data->cifcl);
        if($CifClient){
            if($cif && ($cif->getIdcl()!=$CifClient->getIdcl())){
                return new Response("Cette cif est déja utilisé",400);
            }
            else{
                $CifClient->setCifCl($donnes->data->cifcl);
                $sauv->persist($CifClient);
                $sauv->flush();
            }
        }
        elseif($donnes->data->cifcl!=null)
        {
            $CifClient = new Cifclient();
            $CifClient->setIdcl($client);
            $CifClient->setCifCl($donnes->data->cifcl);
            $sauv->persist($CifClient);
            $sauv->flush();
        }
        $Stat = $statclientRepository->findOneByStatcl($donnes->data->statcl);
        if($StatClient){
            if($Stat && ($Stat->getIdCl()!=$StatClient->getIdcl())){
                return new Response("Cette Stat est déja utilisé",400);    
            }
            else{
                $StatClient->setStatcl($donnes->data->statcl);
                $sauv->persist($StatClient);
                $sauv->flush();
            }    
        }
        elseif($donnes->data->statcl!=null)
        {
            $StatClient = new Statclient();
            $StatClient->setIdcl($client);
            $StatClient->setStatCl($donnes->data->statcl);
            $sauv->persist($StatClient);
            $sauv->flush();
        }
        $Rcs = $rcsclientRepository->findOneByRcscl($donnes->data->rcscl);
        if($RcsClient)
        {
            if($Rcs && ($Rcs->getIdCl()!=$RcsClient->getIdcl())){
                return new Response("Cette Rcs est déja utilisé",400);    
            }
            else
            {
                $RcsClient->setRcscl($donnes->data->rcscl);
                $sauv->persist($RcsClient);
                $sauv->flush();
            }
        }
        elseif($donnes->data->rcscl!=null)
        {
            $RcsClient = new Rcsclient();
            $RcsClient->setIdcl($client);
            $RcsClient->setRcsCl($donnes->data->rcscl);
            $sauv->persist($RcsClient);
            $sauv->flush();
        }
        return $this->json(['data'=>$liste->FindNonSup()],200);
    }
}