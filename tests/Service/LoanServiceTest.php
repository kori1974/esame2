<?php

declare(strict_types=1);

namespace MiniLibrary\Tests\Service;

use DateTimeImmutable;
use MiniLibrary\Domain\Book;
use MiniLibrary\Domain\Member;
use MiniLibrary\Repository\InMemoryLoanRepository;
use MiniLibrary\Service\IdGenerator;
use MiniLibrary\Service\LoanService;
use PHPUnit\Framework\TestCase;

/**
 * TODO (ESAME):
 * Completa questa classe con test significativi per LoanService.
 *
 * Suggerimento:
 * - In molti casi ti basta creare un nuovo InMemoryLoanRepository per test.
 * - Usa date fisse (DateTimeImmutable) per rendere i test deterministici.
 */
final class LoanServiceTest extends TestCase
{
    private function makeService(InMemoryLoanRepository $repo = null): LoanService
    {
        return new LoanService($repo ?? new InMemoryLoanRepository(), new IdGenerator());
    }

    private function book(string $id): Book
    {
        return new Book($id, 'Some title '.$id, '9780201485677'); // ISBN valido fisso
    }

    private function member(string $id): Member
    {
        return new Member($id, 'Some member '.$id, $id.'@example.test');
    }

    public function test_todo_write_tests_for_borrow_rules(): void
    {
        $this->markTestIncomplete('Scrivi i test per: libro già in prestito, max 3 prestiti, calcolo dueAt, ecc.');
    }

    public function test_todo_write_tests_for_return_book_and_overdue(): void
    {
        $this->markTestIncomplete('Scrivi i test per returnBook() e Loan::isOverdue() (se vuoi da qui).');
    }
}
