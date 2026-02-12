<?php

declare(strict_types=1);

namespace MiniLibrary\Tests\Domain;

use MiniLibrary\Domain\Book;
use PHPUnit\Framework\TestCase;

final class BookTest extends TestCase
{
    public function test_it_accepts_a_13_digit_isbn(): void
    {
        $book = new Book('b1', 'Clean Code', '9780132350884');
        self::assertSame('9780132350884', $book->isbn);
    }

    /**
     * @dataProvider invalidIsbnProvider
     */
    public function test_it_rejects_invalid_isbn(string $isbn): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Book('b1', 'Some title', $isbn);
    }

    public static function invalidIsbnProvider(): array
    {
        return [
            'empty' => [''],
            'too short' => ['123'],
            'letters' => ['ABCDEFGHIJKLM'],
            'mixed' => ['9780ABC350884'],
            '14 digits' => ['12345678901234'],
        ];
    }
}
