<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7848e035b1095680eeda9d47f2ed7030
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7848e035b1095680eeda9d47f2ed7030::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7848e035b1095680eeda9d47f2ed7030::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7848e035b1095680eeda9d47f2ed7030::$classMap;

        }, null, ClassLoader::class);
    }
}
