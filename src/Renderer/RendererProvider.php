<?php

declare(strict_types=1);

namespace App\Renderer;

class RendererProvider
{
    private $renderers;

    public function __construct(iterable $renderers)
    {
        foreach ($renderers as $renderer) {
            $this->renderers[$renderer->getType()] = $renderer;
        }
    }

    public function get(string $name): RendererInterface
    {
        return $this->renderers[$name];
    }
}