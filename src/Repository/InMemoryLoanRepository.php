<?php

declare(strict_types=1);

namespace MiniLibrary\Repository;

use MiniLibrary\Domain\Book;
use MiniLibrary\Domain\Loan;
use MiniLibrary\Domain\Member;

/**
 * Repository in memoria.
 * NB: Non ottimizzato; sufficiente per esercizio.
 */
final class InMemoryLoanRepository implements LoanRepository
{
    /** @var array<string, Loan> */
    private array $loansById = [];

    public function save(Loan $loan): void
    {
        $this->loansById[$loan->id] = $loan;
    }

    public function activeLoanForBook(Book $book): ?Loan
    {
        foreach ($this->loansById as $loan) {
            if ($loan->book->id === $book->id && $loan->isActive()) {
                return $loan;
            }
        }

        return null;
    }

    public function activeLoansForMember(Member $member): array
    {
        $active = [];

        foreach ($this->loansById as $loan) {
            if ($loan->member->id === $member->id && $loan->isActive()) {
                $active[] = $loan;
            }
        }

        return $active;
    }
}
