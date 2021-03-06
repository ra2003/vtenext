<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit36f9c7ca51cc4a507dc68896c459d667
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '0f9ae4c5ed91070dc4daf2e298e58f42' => __DIR__ . '/..' . '/hubspot/hubspot-php/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stevenmaguire\\OAuth2\\Client\\' => 28,
            'SevenShores\\Hubspot\\' => 20,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'M' => 
        array (
            'Mrjoops\\OAuth2\\Client\\' => 22,
        ),
        'L' => 
        array (
            'League\\OAuth2\\Client\\' => 21,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'F' => 
        array (
            'Flipbox\\OAuth2\\Client\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stevenmaguire\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/stevenmaguire/oauth2-salesforce/src',
        ),
        'SevenShores\\Hubspot\\' => 
        array (
            0 => __DIR__ . '/..' . '/hubspot/hubspot-php/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Mrjoops\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/mrjoops/oauth2-jira/src',
        ),
        'League\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/oauth2-client/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Flipbox\\OAuth2\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/flipboxdigital/oauth2-hubspot/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit36f9c7ca51cc4a507dc68896c459d667::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit36f9c7ca51cc4a507dc68896c459d667::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
