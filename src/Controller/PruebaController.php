<?php

namespace App\Controller;

use App\Repository\MesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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


     /**
     * @Route("/infocards", name="pagado", methods={"get"})
     */
    public function getPagado(MesRepository $mesRepository): Response
    {   
        $meses = $mesRepository->findAll();
        $data=[];
        foreach($meses as $mes){
            
            $data[]= [
                'id'=>$mes->getId(),
                'pagado'=>$mes->getPagado(),
                'nombre'=>$mes->getNombre()
    
            ];
        }
       
        return new JsonResponse( $data, Response::HTTP_OK);
    }
}
