<?php

declare(strict_types=1);

namespace MiniLibrary\Service;

use DateInterval;
use DateTimeImmutable;
use DomainException;
use MiniLibrary\Domain\Book;
use MiniLibrary\Domain\Loan;
use MiniLibrary\Domain\Member;
use MiniLibrary\Repository\LoanRepository;

/**
 * Servizio applicativo con regole di business semplici.
 */
final class LoanService
{
    public function __construct(
        private readonly LoanRepository $loans,
        private readonly IdGenerator $ids
    ) {
    }

    public function borrow(Book $book, Member $member, DateTimeImmutable $loanedAt): Loan
    {
        // Regola 1: un libro può essere in un solo prestito attivo.
        if ($this->loans->activeLoanForBook($book) !== null) {
            throw new DomainException('Book is already on loan');
        }

        // Regola 2: max 3 prestiti attivi per membro.
        $activeLoans = $this->loans->activeLoansForMember($member);
        if (count($activeLoans) >= 3) {
            throw new DomainException('Member reached max active loans');
        }

        $dueAt = $loanedAt->add(new DateInterval('P14D'));
        $loan = new Loan(
            id: $this->ids->nextId('loan'),
            book: $book,
            member: $member,
            loanedAt: $loanedAt,
            dueAt: $dueAt
        );

        $this->loans->save($loan);

        return $loan;
    }

    public function returnBook(Loan $loan, DateTimeImmutable $returnedAt): void
    {
        $loan->markReturned($returnedAt);
        $this->loans->save($loan);
    }
}
