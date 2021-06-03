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

class ServicioController extends AbstractController
{
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
 * @Route("/serviciosall", name="get_all_servicios", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $servicios = $this->ServicioRepository->findAll();
    $data = [];

    foreach ($servicios as $servicios) {
        $data[] = [
            'id' => $servicios->getId(),
            'nombre' => $servicios->getNombre(),
            'precio' => $servicios->getPrecio(),
            'estado' => $servicios->getEstado(),
            'fichero' => $servicios->getFichero(),
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