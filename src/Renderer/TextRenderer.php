<?php

declare(strict_types=1);

namespace App\Renderer;

use Twig\Environment;

class TextRenderer implements RendererInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(array $payload): string
    {
        return $this->twig->render('blocks/text.html.twig', $payload);
    }

    public function getType(): string
    {
        return 'text';
    }
}