<?php

declare(strict_types=1);

namespace MiniLibrary\Service;

/**
 * Piccolo generatore di ID deterministico per testabilità.
 * - In produzione potresti usare UUID.
 * - Qui usiamo un contatore incrementale.
 */
final class IdGenerator
{
    private int $i = 0;

    public function nextId(string $prefix = 'id'): string
    {
        $this->i++;
        return sprintf('%s_%d', $prefix, $this->i);
    }
}
