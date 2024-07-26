<?php

namespace App\Traits;

trait BinaryEnumTrait
{
  public function toBinary(): string
  {
    return implode('', array_map(function ($char) {
      return str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
    }, str_split($this->value)));
  }

  public static function fromBinary(string $binary): ?static
  {
    $value = implode('', array_map(function ($chunk) {
      return chr(bindec($chunk));
    }, str_split($binary, 8)));

    return self::tryFrom($value);
  }
}
