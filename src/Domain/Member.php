<?php

declare(strict_types=1);

namespace MiniLibrary\Domain;

use InvalidArgumentException;

/**
 * Entità membro.
 * Validazione volutamente "base" (filter_var).
 */
final class Member
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email
    ) {
        if ($id === '') {
            throw new InvalidArgumentException('Member id must not be empty');
        }

        if ($name === '') {
            throw new InvalidArgumentException('Member name must not be empty');
        }

        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email is not valid');
        }
    }
}
