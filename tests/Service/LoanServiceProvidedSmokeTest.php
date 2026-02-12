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
 * Test "smoke" fornito: dimostra setup e un caso positivo minimo.
 * La maggior parte dei casi di LoanService va testata dagli esaminandi.
 */
final class LoanServiceProvidedSmokeTest extends TestCase
{
    public function test_borrow_creates_a_loan_and_saves_it(): void
    {
        $repo = new InMemoryLoanRepository();
        $service = new LoanService($repo, new IdGenerator());

        $book = new Book('b1', 'Refactoring', '9780201485677');
        $member = new Member('m1', 'Martin Fowler', 'mf@example.test');
        $loanedAt = new DateTimeImmutable('2026-02-12 10:00:00');

        $loan = $service->borrow($book, $member, $loanedAt);

        self::assertSame($book->id, $loan->book->id);
        self::assertSame($member->id, $loan->member->id);
        self::assertTrue($loan->isActive());

        // Verifica minima che il repository "veda" il prestito attivo
        self::assertSame($loan->id, $repo->activeLoanForBook($book)?->id);
    }
}
