<?php

declare(strict_types=1);

namespace App\Renderer;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TextRenderer
 *
 * Render a simple paragraph.
 *
 * @package App\Renderer
 */
class TextRenderer extends AbstractRenderer
{
    /**
     * @inheritDoc
     */
    public function renderWithResolvedPayload(array $payload): string
    {
        try {
            return $this->twig->render('blocks/text.html.twig', $payload);
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'text';
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired([
            'id',
            'content'
        ]);

        $resolver->setDefaults([
            'background' => 'lightblue',
            'blockStyles' => null,
        ]);

        $resolver->setNormalizer('blockStyles', function(Options $options) {
            return "background: ${options['background']}";
        });
    }
}