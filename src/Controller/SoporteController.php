<?php

namespace App\Controller;

use App\Entity\CargaAcumulada;
use App\Entity\Empleado;
use App\Entity\TipoSoporte;
use App\Repository\CargaAcumuladaRespository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SoporteController extends AbstractController
{
    #[Route('/soporte/empleado', name: 'app_empleado')]
    public function empleados(ManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        $empleados = $em->getRepository(Empleado::class)->findBy([],['nombre'=> 'ASC']);
        return $this -> render('Empleado/empleado.html.twig',['empleados' => $empleados]);
    }


    #[Route('/soporte/crear', name: 'app_tipo_soporte_crear')]
    public function create(Request $request, ManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        $tipoSoporte = new \App\Entity\TipoSoporte();
        $form_tipo_soporte = $this->createForm(\App\Form\SoporteForm::class, $tipoSoporte);
        $form_tipo_soporte->handleRequest($request);
        if($form_tipo_soporte-> isSubmitted() && $form_tipo_soporte->isValid()){
            $em ->persist($tipoSoporte);
            $em ->flush();
            return $this->redirectToRoute('app_soportes');
        }
        return $this->render('Soporte/crear.html.twig', [
            'form_tipo_soporte' => $form_tipo_soporte->createView()
        ]);
    }
    #[Route('/soporte/soportes', name: 'app_soportes')]
    public function soportes(ManagerRegistry $doctrine){
        $em = $doctrine->getManager();
        $soportes = $em->getRepository(TipoSoporte::class)->findBy([],['id'=> 'ASC']);
        return $this -> render('Soporte/soportes.html.twig',['soportes' => $soportes]);
    }


}
