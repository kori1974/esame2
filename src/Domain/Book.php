<?php

declare(strict_types=1);

namespace MiniLibrary\Domain;

use InvalidArgumentException;

/**
 * Entità libro estremamente semplice.
 * - Non usa DB
 * - Identità data da $id (stringa)
 * - ISBN: qui NON implementiamo lo standard ISBN completo.
 *   Per scopi didattici accettiamo esattamente 13 cifre.
 */
final class Book
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $isbn
    ) {
        if ($id === '') {
            throw new InvalidArgumentException('Book id must not be empty');
        }

        if ($title === '') {
            throw new InvalidArgumentException('Book title must not be empty');
        }

        if (!preg_match('/^\d{13}$/', $isbn)) {
            throw new InvalidArgumentException('ISBN must be exactly 13 digits');
        }
    }
}
