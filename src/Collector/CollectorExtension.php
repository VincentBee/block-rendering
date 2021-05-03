<?php

declare(strict_types=1);

namespace App\Collector;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class CollectorExtension
 *
 * @package App\Renderer
 */
class CollectorExtension extends AbstractExtension
{
    /**
     * @var Collector
     */
    private $scriptCollector;

    /**
     * Constructor.
     *
     * @param Collector $collector
     */
    public function __construct(
        Collector $collector
    ) {
        $this->scriptCollector = $collector;
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('collect_script', [$this, 'collect'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_script', [$this, 'render'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param string $script
     * @param string $scriptId
     * @return string
     */
    public function collect(string $script, string $scriptId): string
    {
        return $this->scriptCollector->collect($scriptId, $script);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->scriptCollector->render();
    }
}