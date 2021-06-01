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

    private $ServicioRepository;

    public function __construct(ServicioRepository $ServicioRepository)
    {
        $this->ServicioRepository = $ServicioRepository;
    }

    /**
     * @Route("/servicio", name="add_servicios", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nombre = $data['nombre'];
        $precio = $data['precio'];
      

        if (empty($nombre) || empty($precio)) {
            throw new NotFoundHttpException('campo nombre y precio son obligatorios');
        }

        $this->ServicioRepository->saveCustomer($nombre, $precio);

        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);
    }



    /**
 * @Route("/serviciosall", name="get_all_customers", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $servicios = $this->ServicioRepository->findAll();
    $data = [];

    foreach ($servicios as $servicios) {
        $data[] = [
            'id' => $servicios->getId(),
            'firstName' => $servicios->getNombre(),
            'lastName' => $servicios->getPrecio(),
            'email' => $servicios->getEstado(),
            'phoneNumber' => $servicios->getFichero(),
        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}



/**
 * @Route("/servicio/{id}", name="update_servicios", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $servicio = $this->ServicioRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

    empty($data['nombre']) ? true : $servicio->setNombre($data['nombre']);
    empty($data['precio']) ? true : $servicio->setPrecio($data['precio']);
    empty($data['estado']) ? true : $servicio->setEstado($data['estado']);
    empty($data['fichero']) ? true : $servicio->setFichero($data['fichero']);

    $updatedServicio = $this->ServicioRepository->updateservicio($servicio);

    return new JsonResponse('ok',Response::HTTP_OK);
}

/**
 * @Route("/serviciodel/{id}", name="delete_servicio", methods={"DELETE"})
 */
public function delete($id): JsonResponse
{
    $servicio = $this->ServicioRepository->findOneBy(['id' => $id]);

    $this->ServicioRepository->removeServicio($servicio);

    return new JsonResponse(['status' => 'Eliminado correctamente'], Response::HTTP_NO_CONTENT);
}



}
