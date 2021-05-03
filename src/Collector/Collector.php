<?php

declare(strict_types=1);

namespace App\Collector;

/**
 * Class Collector
 *
 * Services used to collect script across blocks.
 * Once all desired scripts are collected, we can render them.
 *
 * @package App\Collector
 */
class Collector
{
    /**
     * @var array
     */
    private $scripts;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->scripts = [];
    }

    /**
     * Collect a script identified by its id.
     *
     * @param string $scriptId
     * @param string $script
     * @param boolean $override
     * @return string
     */
    public function collect(string $scriptId, string $script, $override = false): string
    {
        if (isset($this->scripts[$scriptId]) && !$override) {
            return '<!-- script already collected -->';
        }

        $this->scripts[$scriptId] = [
            'printed' => false,
            'script' => $script,
        ];

        return '<!-- script collected successfully -->';
    }

    /**
     * Ensure the script is not already printed and print it otherwise.
     *
     * @return string
     */
    public function render(): string
    {
        $readyToPrint = [];

        foreach ($this->scripts as &$script) {
            if ($script['printed']) {
                continue;
            }

            $readyToPrint[] = $script['script'];
            $script['printed'] = true;
        }

        return join('', array_values($readyToPrint));
    }
}