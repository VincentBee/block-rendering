<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends AbstractController
{
    public function index(Request $request): Response
    {
        return $this->render('index.html.twig', ['blocks' => $request->get('blocks')]);
    }
}