<?php

declare(strict_types=1);

namespace App\Renderer;

interface RendererInterface
{
    function render(array $payload): string;

    function getType(): string;
}
