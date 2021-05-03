<?php

declare(strict_types=1);

namespace App\Renderer;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class RenderExtension
 * @package App\Renderer
 */
class RenderExtension extends AbstractExtension
{
    /**
     * @var RendererProvider
     */
    private $rendererProvider;

    /**
     * Constructor.
     *
     * @param RendererProvider $rendererProvider
     */
    public function __construct(
        RendererProvider $rendererProvider
    ) {
        $this->rendererProvider = $rendererProvider;
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('render_block', [$this, 'render'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param $block
     * @return string
     */
    public function render($block): string
    {
        return $this->rendererProvider->get($block['type'])->render($block['id'], $block['data']);
    }
}