<?php

declare(strict_types=1);

namespace App\Renderer;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class YoutubeRenderer
 *
 * Render an embedded youtube video.
 *
 * @package App\Renderer
 */
class YoutubeRenderer extends AbstractRenderer
{
    /**
     * @inheritDoc
     */
    public function renderWithResolvedPayload(array $payload): string
    {
        try {
            return $this->twig->render('blocks/youtube.html.twig', $payload);
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'youtube';
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired([
            'id',
            'videoId'
        ]);

        $resolver->setDefaults([
            'title' => 'default title',
            'background' => 'pink',
            'blockStyles' => null,
        ]);

        $resolver->setNormalizer('blockStyles', function(Options $options) {
            return "background: ${options['background']}";
        });
    }
}