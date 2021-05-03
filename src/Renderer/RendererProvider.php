<?php

declare(strict_types=1);

namespace App\Renderer;

/**
 * Class RendererProvider
 *
 * @package App\Renderer
 */
class RendererProvider
{
    /**
     * @var RendererInterface[] The list of known renderers.
     */
    private $renderers;

    /**
     * Constructor.
     *
     * @param iterable $renderers
     */
    public function __construct(iterable $renderers)
    {
        foreach ($renderers as $renderer) {
            $this->renderers[$renderer->getType()] = $renderer;
        }
    }

    /**
     * Return a renderer by it's name.
     *
     * @param string $name
     * @return RendererInterface
     */
    public function get(string $name): RendererInterface
    {
        if (!isset($this->renderers[$name])) {
            throw new \RuntimeException("The renderer $name does not exits.");
        }

        return $this->renderers[$name];
    }
}