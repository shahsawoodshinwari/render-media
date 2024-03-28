<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait EnumFormatTrait
{
  public static function toArray(): array
  {
    $cases = [];

    foreach (self::cases() as $case) {
      $cases[] = ['name' => $case->name, 'value' => $case->value];
    }

    return $cases;
  }

  public static function values(): array
  {
    return array_column(self::toArray(), 'value');
  }

  public static function names(): array
  {
    return array_column(self::toArray(), 'name');
  }

  public static function toJson(): bool|string
  {
    return json_encode(self::toArray());
  }

  public function toTitleCase()
  {
    return Str::title(str_replace('_', ' ', $this->name));
  }
}
