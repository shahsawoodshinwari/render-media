<?php

$finder = (new PhpCsFixer\Finder())
  ->exclude([
    'storage/framework',
    'bootstrap/cache',
  ])
  ->in(__DIR__);

return (new PhpCsFixer\Config())
  ->setRules([
    '@PER-CS'           => true,
    '@PHP82Migration'   => true,
    'indentation_type'  => true,
    'ordered_imports'   => [
      'imports_order'   => ['class', 'function', 'const'],
      'sort_algorithm'  => 'length',
    ],
    'yoda_style' => false,
    'no_unused_imports' => true,
  ])
  ->setIndent('  ')
  ->setFinder($finder);
