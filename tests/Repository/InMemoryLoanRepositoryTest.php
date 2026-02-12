<?php

declare(strict_types=1);

namespace MiniLibrary\Tests\Repository;

use DateTimeImmutable;
use MiniLibrary\Domain\Book;
use MiniLibrary\Domain\Loan;
use MiniLibrary\Domain\Member;
use MiniLibrary\Repository\InMemoryLoanRepository;
use PHPUnit\Framework\TestCase;

/**
 * TODO (ESAME):
 * Scrivi test per i metodi del repository.
 */
final class InMemoryLoanRepositoryTest extends TestCase
{
    private function book(string $id): Book
    {
        return new Book($id, 'Title '.$id, '9780132350884');
    }

    private function member(string $id): Member
    {
        return new Member($id, 'Name '.$id, $id.'@example.test');
    }

    private function loan(string $id, Book $book, Member $member, string $loanedAt = '2026-02-01'): Loan
    {
        $loaned = new DateTimeImmutable($loanedAt.' 10:00:00');
        $due = $loaned->modify('+14 days');

        return new Loan($id, $book, $member, $loaned, $due);
    }

    public function test_todo_write_repository_tests(): void
    {
        $this->markTestIncomplete('Testa save(), activeLoanForBook(), activeLoansForMember().');
    }
}
