<?php

declare(strict_types=1);

namespace MiniLibrary\Repository;

use MiniLibrary\Domain\Book;
use MiniLibrary\Domain\Loan;
use MiniLibrary\Domain\Member;

interface LoanRepository
{
    public function save(Loan $loan): void;

    public function activeLoanForBook(Book $book): ?Loan;

    /**
     * @return list<Loan>
     */
    public function activeLoansForMember(Member $member): array;
}
