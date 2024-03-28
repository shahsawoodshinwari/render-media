<?php

namespace App\PHPMD\Rule\CleanCode;

use Illuminate\Database\Eloquent\Model;
use PHPMD\Rule\CleanCode\StaticAccess as CleanCodeStaticAccess;

class StaticAccess extends CleanCodeStaticAccess
{
  protected function isExcludedFromAnalysis($className, $exceptions)
  {
    $trimmedClassName = trim($className, " \t\n\r\0\x0B\\");

    return (
      in_array($trimmedClassName, $exceptions)
      || $this->isEnum($trimmedClassName)
      || $this->isEloquentModel($trimmedClassName)
      || $this->isResource($trimmedClassName)
      || $this->isComingFromIlluminateNamespace($className)
    );
  }

  private function isEnum($className)
  {
    return strpos($className, 'Enum') !== false;
  }

  private function isEloquentModel($className)
  {
    return in_array(Model::class, class_parents($className));
  }

  private function isResource($className)
  {
    return strpos($className, 'Resource') !== false;
  }

  private function isComingFromIlluminateNamespace($className)
  {
    return strpos($className, 'Illuminate\\') !== false;
  }
}
