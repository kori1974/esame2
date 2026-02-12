<?php

declare(strict_types=1);

namespace MiniLibrary\Domain;

use DateTimeImmutable;

final class Loan
{
    private ?DateTimeImmutable $returnedAt = null;

    public function __construct(
        public readonly string $id,
        public readonly Book $book,
        public readonly Member $member,
        public readonly DateTimeImmutable $loanedAt,
        public readonly DateTimeImmutable $dueAt
    ) {
    }

    public function returnedAt(): ?DateTimeImmutable
    {
        return $this->returnedAt;
    }

    public function markReturned(DateTimeImmutable $returnedAt): void
    {
        // Non permettiamo "ritorni nel passato" rispetto al loanedAt: regola semplice.
        if ($returnedAt < $this->loanedAt) {
            throw new \DomainException('Return date cannot be before loan date');
        }

        $this->returnedAt = $returnedAt;
    }

    public function isActive(): bool
    {
        return $this->returnedAt === null;
    }

    public function isOverdue(DateTimeImmutable $today): bool
    {
        if (!$this->isActive()) {
            return false;
        }

        return $today > $this->dueAt;
    }
}
