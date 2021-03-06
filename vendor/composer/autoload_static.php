<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7753b4e3cb6ad805036fc7ebad2d8e68
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7753b4e3cb6ad805036fc7ebad2d8e68::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7753b4e3cb6ad805036fc7ebad2d8e68::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7753b4e3cb6ad805036fc7ebad2d8e68::$classMap;

        }, null, ClassLoader::class);
    }
}
