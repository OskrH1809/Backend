<?php

namespace App\Controller;

use App\Entity\DatosAdministrativos;
use app\Entity\User;
use App\Repository\DatosAdministrativosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DatosAdministrativosController extends AbstractController
{
    private $DatosAdministrativosRepository;

    public function __construct(DatosAdministrativosRepository $DatosAdministrativosRepository)
    {
        $this->DatosAdministrativosRepository = $DatosAdministrativosRepository;
    }

    /**
     * @Route("/datos_administrativos", name="add_datos_administrativos", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $cuenta_bancaria =$data['cuenta_bancaria'];
        $telefono        =$data['telefono'];
        $direccion       =$data['direccion'];
        $user            =$data['user'];

        if (empty($user) ) {
            throw new NotFoundHttpException('campo nombre y precio son obligatorios');
        }
        $user_ = $this->getDoctrine()->getRepository(User::class)->find($user);

        $this->DatosAdministrativosRepository->save_datos_administrativos($cuenta_bancaria,$telefono,$direccion,$user_);
    

        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);
    }



    /**
 * @Route("/datosall", name="get_all_datos", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $datos = $this->DatosAdministrativosRepository->findAll();
    $data = [];

    foreach ($datos as $datos) {
        $data[] = [
            'id' => $datos->getId(),
            'cuenta_bancaria' => $datos->getCuentaBancaria(),
            'telefono' => $datos->getTelefono(),
            'direccion' => $datos->getDireccion(),
            'user' => $datos->getUser()
        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}



/**
 * @Route("/datos_administrativos/{id}", name="update_datos_administrativos", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $datos = $this->DatosAdministrativosRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

    $user_ = $this->getDoctrine()->getRepository(User::class)->find( $data['user']);


    empty($data['cuenta_bancaria']) ? true : $datos->setCuentaBancaria($data['cuenta_bancaria']);
    empty($data['telefono']) ? true : $datos->setTelefono($data['telefono']);
    empty($data['direccion']) ? true : $datos->setDireccion($data['direccion']);
    empty($user_) ? true : $datos->setUser($user_);

    $updatedDatos = $this->DatosAdministrativosRepository->update_datos_administrativos($datos);

    return new JsonResponse('ok',Response::HTTP_OK);
}

/**
 * @Route("/datos_administrativos_delete/{id}", name="delete_datos_administrativos", methods={"DELETE"})
 */
public function delete($id): JsonResponse
{
    $datos = $this->DatosAdministrativosRepository->findOneBy(['id' => $id]);

    $this->DatosAdministrativosRepository->remove_datos_administrativos($datos);

    return new JsonResponse(['status' => 'Eliminado correctamente'], Response::HTTP_NO_CONTENT);
}



}