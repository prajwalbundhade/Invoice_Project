<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitce28be9fdeeea718ebe9244a0acdd00a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitce28be9fdeeea718ebe9244a0acdd00a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitce28be9fdeeea718ebe9244a0acdd00a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitce28be9fdeeea718ebe9244a0acdd00a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
