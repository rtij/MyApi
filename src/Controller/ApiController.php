<?php

namespace App\Controller;

// Entity
use App\Entity\Task;
use App\Entity\Modep;
use App\Entity\Unite;
use App\Repository\TaskRepository;
use App\Repository\AchatRepository;
use App\Repository\ModePRepository;
use App\Repository\UniteRepository;
// Repository
use App\Repository\GroupeRepository;
use App\DBAL\MultiDbConnectionWrapper;
use App\Repository\AuthTokenRepository;
use App\Repository\AjoutStockRepository;
use Doctrine\ORM\EntityManagerInterface;

//Controllers
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ApprovisionnementRepository;
use App\Repository\ContactRepository;
use App\Repository\VenteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  @Route("/api", name="api")
 */



class ApiController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     *  @Route("/unite/liste", name="listeUnite", methods={"GET"})
     */
    public function listeUnite(UniteRepository $uniteRepository)
    {
        return $this->json(['data' => $uniteRepository->findAll()], 200);
    }

    /**
     *  @Route("/unite/addUnite", name="addUnite", methods={"POST"})
     */
    public  function AddUnite(Request $req, UniteRepository $liste)
    {
        $donnes = json_decode($req->getContent());
        $unite = new Unite();
        $unite->setDesunit($donnes->data->desunit);          //sauvegarde
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($unite);
        $sauv->flush();
        return $this->json(['data' => $liste->findAll()], 200);
    }
    /**
     *  @Route("/unite/EditUnite/{idu}", name="editUnite", methods={"PUT"})
     */
    public function EditUnite(?Unite $Unite, Request $req, UniteRepository $liste)
    {
        $donnes = json_decode($req->getContent());
        $Unite->setDesunit($donnes->data->desunit);          //sauvegarde
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($Unite);
        $sauv->flush();
        return $this->json(['data' => $liste->findAll()], 200);
    }

    /**
     *  @Route("/modep/addModeP", name="addModeP", methods={"POST"})
     */
    public  function AddModep(Request $req, ModePRepository $liste)
    {
        $donnes = json_decode($req->getContent());
        $modep = new Modep();
        $modep->setDesmp($donnes->data->desmp);
        $modep->setModepSup(0);
        //sauvegarde
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($modep);
        $sauv->flush();
        return $this->json(['data' => $liste->FindNonSup()], 200);
    }

    /**
     *  @Route("/achat/liste", name="addliste", methods={"GET"})
     */
    public function achatListe(AchatRepository $achatRepository)
    {
        return $this->json(['data' => $achatRepository->OrderByDate()], 200);
    }

    /**
     *  @Route("/groupe/liste", name="groupeliste", methods={"GET"})
     */
    public function Groupe(Request $request, AuthTokenRepository $authTokenRepository, GroupeRepository $groupeRepository)
    {
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $authToken = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        $user = $authToken->getIduser();
        return $this->json(['data' => $groupeRepository->FindGroupe($user->getIdgroup())], 200);
    }

    /**
     *  @Route("/task/liste", name="taskliste", methods={"GET"})
     */
    public function TaskListe(VenteRepository $contactRepository)
    {
        $id = $contactRepository->findMax();
        if($id["id"]==null){
            $id = 1;
        }
        else{
            $id = $id["id"];
        }
        return $this->json(['data' => $id], 200);
    }

    /**
     *  @Route("/task/addTask", name="addTask", methods={"POST"})
     */
    public  function AddTask(Request $req, TaskRepository $taskRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $task = new Task();
        $task->setTitlet($donnes->data->titlet);
        $task->setDesct($donnes->data->desct);
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($task);
        $sauv->flush();
        return $this->json(['data' => $taskRepository->findByTaskf(1)], 200);
    }

    /**
     *  @Route("/task/editTask/{idtask}", name="editTask", methods={"PUT"})
     */
    public  function EditTask(Request $req, ?Task $task, TaskRepository $taskRepository): Response
    {
        $donnes = json_decode($req->getContent());
        $task->setTitlet($donnes->data->titlet);
        $task->setDesct($donnes->data->desct);
        $task->setTaskf($donnes->data->taskf);
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($task);
        $sauv->flush();
        return $this->json(['data' => $taskRepository->findByTaskf(1)], 200);
    }

    /**
     *  @Route("/approvisionnement/liste", name="approvisionnementliste", methods={"GET"})
     */
    public function ApprovisionnementListe(ApprovisionnementRepository $approvisionnementRepository)
    {
        return $this->json(['data' => $approvisionnementRepository->findAll()], 200);
    }

    /**
     *  @Route("/appro/liste", name="approliste", methods={"GET"})
     */
    public function ApproListe(AjoutStockRepository $approvisionnementRepository)
    {
        return $this->json(['data' => $approvisionnementRepository->findAll()], 200);
    }
}
