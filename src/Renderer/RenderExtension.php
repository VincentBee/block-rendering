<?php

declare(strict_types=1);

namespace App\Renderer;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RenderExtension extends AbstractExtension
{
    private $rendererProvider;

    public function __construct(
        RendererProvider $rendererProvider
    ) {
        $this->rendererProvider = $rendererProvider;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('render_block', [$this, 'render'], ['is_safe' => ['html']]),
        ];
    }

    public function render($block)
    {
        return $this->rendererProvider->get($block['type'])->render(array_merge($block['data'], [
            'id' => $block['id']
        ]));
    }
}