<?php

declare(strict_types=1);

namespace MiniLibrary\Tests\Domain;

use MiniLibrary\Domain\Member;
use PHPUnit\Framework\TestCase;

final class MemberTest extends TestCase
{
    public function test_it_accepts_a_valid_email(): void
    {
        $m = new Member('m1', 'Ada Lovelace', 'ada@example.test');
        self::assertSame('ada@example.test', $m->email);
    }

    /**
     * @dataProvider invalidEmailProvider
     */
    public function test_it_rejects_invalid_email(string $email): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Member('m1', 'Ada Lovelace', $email);
    }

    public static function invalidEmailProvider(): array
    {
        return [
            'empty' => [''],
            'missing-at' => ['ada.example.test'],
            'missing-domain' => ['ada@'],
            'spaces' => ['ada @example.test'],
        ];
    }
}
