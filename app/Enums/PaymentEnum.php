<?php

namespace App\Enums;

enum PaymentEnum: int
{
    case THREE_DAYS = 30;
    case ONE_WEEK = 150;
    case ONE_MONTH = 300;
    case PURCHASE = 500;

    public function label(): string
    {
        return match ($this) {
            self::THREE_DAYS => '3 Days',
            self::ONE_WEEK => '1 Week',
            self::ONE_MONTH => '1 Month',
            self::PURCHASE => 'Purchase',
        };
    }

    public static function fromName(string $name): self
    {
        return match ($name) {
            'THREE_DAYS' => self::THREE_DAYS,
            'ONE_WEEK'   => self::ONE_WEEK,
            'ONE_MONTH'  => self::ONE_MONTH,
            'PURCHASE'   => self::PURCHASE,
            default      => throw new \InvalidArgumentException("Invalid payment type: $name"),
        };
    }
}
