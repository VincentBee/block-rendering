<?php

declare(strict_types=1);

namespace App\Renderer;

/**
 * Interface RendererInterface
 *
 * If you want to create a custom block renderer, you have to implements this interface.
 *
 * @package App\Renderer
 */
interface RendererInterface
{
    /**
     * Render the block.
     *
     * @param string $blockId
     * @param array $payload
     * @return string
     */
    function render(string $blockId, array $payload): string;

    /**
     * Returns the renderer identifier.
     *
     * @return string
     */
    function getType(): string;
}
