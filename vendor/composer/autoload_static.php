<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd53eccce07e58bb3a4f3a2d82d0321cc
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MathPHP\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MathPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/markrogoyski/math-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd53eccce07e58bb3a4f3a2d82d0321cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd53eccce07e58bb3a4f3a2d82d0321cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd53eccce07e58bb3a4f3a2d82d0321cc::$classMap;

        }, null, ClassLoader::class);
    }
}
