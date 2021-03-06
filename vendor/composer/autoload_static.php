<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5def55572952b8ba0d0a80783df8d769
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5def55572952b8ba0d0a80783df8d769::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5def55572952b8ba0d0a80783df8d769::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5def55572952b8ba0d0a80783df8d769::$classMap;

        }, null, ClassLoader::class);
    }
}
