<?php

namespace App\Controller;

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
}
