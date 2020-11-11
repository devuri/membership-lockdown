<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit78b2fc3ed8d44f0dd86ca5d881dc3ce2
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MembershipLock\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MembershipLock\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'MembershipLock\\Admin\\MembershipAdmin' => __DIR__ . '/../..' . '/src/Admin/MembershipAdmin.php',
        'MembershipLock\\LockItdown' => __DIR__ . '/../..' . '/src/LockItdown.php',
        'MembershipLock\\WPAdminPage\\AdminPage' => __DIR__ . '/../..' . '/src/WPAdminPage/AdminPage.php',
        'MembershipLock\\WPAdminPage\\FormHelper' => __DIR__ . '/../..' . '/src/WPAdminPage/FormHelper.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit78b2fc3ed8d44f0dd86ca5d881dc3ce2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit78b2fc3ed8d44f0dd86ca5d881dc3ce2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit78b2fc3ed8d44f0dd86ca5d881dc3ce2::$classMap;

        }, null, ClassLoader::class);
    }
}
