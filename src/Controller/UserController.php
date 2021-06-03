<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\User;

use App\Repository\UserRepository;
use App\Repository\PerfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $ServicioRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * @Route("/user", name="add_user", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $email     =$data['email'];
        $password  =$data['password'];
        $perfil    =$data['perfil'];
        $nombre    =$data['nombre'];

      

        if (empty($email) ) {
            throw new NotFoundHttpException('campo email obligatorio');
        }
        $perfil_ = $this->getDoctrine()->getRepository(Perfil::class)->find($perfil);


        $this->UserRepository->save_User($email, $password,$perfil_,$nombre );

        return new JsonResponse(['status' => 'Usuario creado!'], Response::HTTP_CREATED);
    }

    



    /**
 * @Route("/userall", name="get_all_users", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $users = $this->UserRepository->findAll();
    $data = [];

    foreach ($users as $users) {
        $data[] = [
            'id' => $users->getId(),
            'email' => $users->getEmail(),
            'password' => $users->getPassword(),
            'nombre' => $users->getNombre(),
            'perfil_id' => $users->getPerfil(),
            
        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}



/**
 * @Route("/user/{id}", name="update_user", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $user = $this->UserRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

  
    // $servicio_ = $this->getDoctrine()->getRepository(Servicio::class)->find();
    // $peril_id = $this->PerfilRepository->findOneBy(['id' => $data['perfil']]);
    $perfil_id = $this->getDoctrine()->getRepository(Perfil::class)->find( $data['perfil']);


    empty($data['email']) ? true : $user->setEmail($data['email']);

    empty($data['password']) ? true : $user->setPassword($data['password']);
    empty($peril_id) ? true : $user->setPerfil($perfil_id);
    empty($data['nombre']) ? true : $user->setNombre($data['nombre']);

    $updatedtarea = $this->UserRepository->update_user($user);

    return new JsonResponse('actualizado',Response::HTTP_OK);
}

/**
 * @Route("/userdele/{id}", name="delete_user", methods={"DELETE"})
 */
public function delete($id): JsonResponse
{
    $user = $this->UserRepository->findOneBy(['id' => $id]);

    $this->UserRepository->remove_user($user);

    return new JsonResponse(['status' => 'Eliminado correctamente'], Response::HTTP_NO_CONTENT);
}



}