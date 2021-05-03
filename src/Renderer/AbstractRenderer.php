<?php

declare(strict_types=1);

namespace App\Renderer;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

/**
 * Class AbstractRenderer
 *
 * You can extends this class if you want to simply render a block using a resolved payload.
 * It make the logic easier to write with a controlled set of data.
 *
 * @package App\Renderer
 */
abstract class AbstractRenderer implements RendererInterface
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var OptionsResolver
     */
    private $payloadResolver;

    /**
     * Constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->payloadResolver = new OptionsResolver();
        $this->configureOptions($this->payloadResolver);
    }

    /**
     * Resolve the payload and render the block.
     *
     * @param string $blockId
     * @param array $payload
     * @return string
     */
    public function render(string $blockId, array $payload): string
    {
        $payload['id'] = $blockId;
        $resolvedPayload = $this->payloadResolver->resolve($payload);

        return $this->renderWithResolvedPayload($resolvedPayload);
    }

    /**
     * Render the block after the payload has been resolved.
     *
     * @param array $payload
     * @return string
     */
    abstract function renderWithResolvedPayload(array $payload): string;

    /**
     * Set the configuration of the payload resolver.
     *
     * @param OptionsResolver $resolver
     */
    abstract function configureOptions(OptionsResolver $resolver): void;
}