<?php

/**
 * Get theme asset path
 *
 * @param string  $file
 */
function theme($file): string
{
  return asset("theme/$file");
}
