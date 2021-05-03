<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends AbstractController
{
    public function classical(Request $request): Response
    {
        return $this->render('classical.html.twig', ['blocks' => $request->get('blocks')]);
    }

    public function standalone(Request $request): Response
    {
        // Maybe some logic here ?

        return $this->render('standalone.html.twig', ['blocks' => $request->get('blocks')]);
    }
}