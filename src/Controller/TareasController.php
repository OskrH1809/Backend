<?php

namespace App\Controller;

use App\Entity\Servicio;
use App\Repository\MesRepository;
use App\Repository\ServicioRepository;
use App\Repository\TareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TareasController extends AbstractController
{
    private $ServicioRepository;

    public function __construct(TareaRepository $TareaRepository)
    {
        $this->TareaRepository = $TareaRepository;
    }

    /**
     * @Route("/tarea", name="add_tarea", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $titulo = $data['titulo'];
        $servicio = $data['servicio'];
        $descripcion= $data['descripcion'];
        $documento= $data['documento'];

      

        if (empty($titulo) || empty($servicio) ) {
            throw new NotFoundHttpException('campo nombre y precio son obligatorios');
        }
        $servicio_ = $this->getDoctrine()->getRepository(Servicio::class)->find($servicio);


        $this->TareaRepository->saveTarea($titulo, $servicio_,$descripcion,$documento );

        return new JsonResponse(['status' => 'Tareas created!'], Response::HTTP_CREATED);
    }

    



    /**
 * @Route("/tareasall", name="get_all_tareas", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $tareas = $this->TareaRepository->findAll();
    $data = [];

    foreach ($tareas as $tareas) {
        $data[] = [
            'id' => $tareas->getId(),
            'titulo' => $tareas->getTitulo(),
            'servicio' => $tareas->getServicio(),
            'descripcion' => $tareas->getDescripcion(),
            'documento' => $tareas->getDocumento(),
        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}



/**
 * @Route("/tarea/{id}", name="update_tarea", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $tarea = $this->TareaRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

  
    // $servicio_ = $this->getDoctrine()->getRepository(Servicio::class)->find();
    // $servicio_ = $this->getDoctrine()->getRepository(Servicio::class)->find($data['servicio']);
    $servicio_id = $this->getDoctrine()->getRepository(Servicio::class)->find( $data['servicio']);



    empty($data['titulo']) ? true : $tarea->setTitulo($data['titulo']);
    empty($servicio_id) ? true : $tarea->setServicio($servicio_id);
    empty($data['descripcion']) ? true : $tarea->setDescripcion($data['descripcion']);
    empty($data['documento']) ? true : $tarea->setDocumento($data['documento']);

    $updatedtarea = $this->TareaRepository->updatetarea($tarea);

    return new JsonResponse('Actualizado',Response::HTTP_OK);
}

/**
 * @Route("/tareadel/{id}", name="delete_servicio", methods={"DELETE"})
 */
public function delete($id): JsonResponse
{
    $tarea = $this->TareaRepository->findOneBy(['id' => $id]);

    $this->TareaRepository->removeTarea($tarea);

    return new JsonResponse(['status' => 'Eliminado correctamente'], Response::HTTP_NO_CONTENT);
}



}