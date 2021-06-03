<?php

namespace App\Controller;

use App\Entity\Servicio;
use App\Repository\MesRepository;
use App\Repository\ServicioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PruebaController extends AbstractController
{
    /**
     * @Route("/prueba", name="prueba", methods={"get"})
     */
    public function index(): Response
    {
       return new JsonResponse([
           'id'     => 1,
           'nombre' => 'Oscar'

       ]);
    }


    //  /**
    //  * @Route("/infocards", name="pagado", methods={"get"})
    //  */
    // public function getPagado(MesRepository $mesRepository): Response
    // {   
    //     $meses = $mesRepository->findAll();
    //     $data=[];
    //     foreach($meses as $mes){
            
    //         $data[]= [
    //             'id'=>$mes->getId(),
    //             'nombre'=>$mes->getNombre()
    
    //         ];
    //     }
       
    //     return new JsonResponse( $data, Response::HTTP_OK);
    // }

    // private $ServicioRepository;
    
    // public function __construct(ServicioRepository $ServicioRepository)
    // {   
     
    //   $this->ServicioRepository = $ServicioRepository; 
    // }

    //    /**
    //  * @Route("/createse", name="serviciopost", methods={"post"})
    //  */
    // public function postServicio(Request $request): JsonResponse
    // {   

    //     $data = json_decode($request->getContent(), true);


    //     $nombre= $data['nombre'];
    //     $nombre= $data['precio'];

    //     if (empty($nombre) || empty($data)) {
    //         throw new NotFoundHttpException('El nombre y precio son obligatorios');
    //     }
        
    //     return new JsonResponse(['status'=>'Creado!'],Response::HTTP_CREATED);
       
    // }

  

    


}
