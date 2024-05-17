<?php

namespace App\Enums;

use App\Traits\EnumFormatTrait;

enum FileTypeEnum: string
{
  use EnumFormatTrait;

  case IMAGE_JPEG = 'image/jpeg';
  case IMAGE_JPG  = 'image/jpg';
  case IMAGE_BMP  = 'image/bmp';
  case IMAGE_PNG  = 'image/png';
  case IMAGE_WEBP = 'image/webp';

  /**
   * Get all image types
   */
  public static function imageTypes(): array
  {
    return [
      self::IMAGE_JPEG->value,
      self::IMAGE_JPG->value,
      self::IMAGE_BMP->value,
      self::IMAGE_PNG->value,
      self::IMAGE_WEBP->value,
    ];
  }
}
