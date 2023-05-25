<?php

/*
 * This file is part of PTDF Symfony Application.
 * (c) PTDF <dev@ptdf.gov.ng>.
 */

if (!file_exists(__DIR__.'/src')) {
    exit(0);
}

$fileHeaderComment = <<<'EOF'
    VAT CALCULATOR APP.
    (c) ktarila <ktarila@gmail.com>.
    EOF;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PHP81Migration' => true,
        '@PHPUnit75Migration:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'protected_to_private' => false,
        'native_constant_invocation' => ['strict' => false],
        'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => false],
        'header_comment' => [
        'header' => $fileHeaderComment,
        'comment_type' => 'PHPDoc',
        ],
        'modernize_strpos' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'list_syntax' => ['syntax' => 'short'],
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        (new PhpCsFixer\Finder())
            ->in(__DIR__.'/src')
            ->append([__FILE__])
            ->notPath('#/Fixtures/#')
                ->exclude('tests/Fixtures')
    ->exclude('var')
    ->exclude('vendor')
    )
    ->setCacheFile('.php-cs-fixer.cache')
;
