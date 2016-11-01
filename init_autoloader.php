<?php

/**
 * This autoloading setup is really more complicated than it needs to be for most
 * applications. The added complexity is simply to reduce the time it takes for
 * new developers to be productive with a fresh skeleton. It allows autoloading
 * to be correctly configured, regardless of the installation method and keeps
 * the use of composer completely optional. This setup should work fine for
 * most users, however, feel free to configure autoloading however you'd like.
 */

// Composer autoloading
if (file_exists('vendor/autoload.php')) {
    $loader = include 'vendor/autoload.php';
}

if (class_exists('Zend\Loader\AutoloaderFactory')) {
    return;
}

$zf3Path = false;

if (is_dir('vendor/ZF2/library')) {
    $zf3Path = 'vendor/ZF2/library';
} elseif (getenv('ZF3_PATH')) {      // Support for ZF2_PATH environment variable or git submodule
    $zf3Path = getenv('ZF3_PATH');
} elseif (get_cfg_var('zf3_path')) { // Support for zf2_path directive value
    $zf3Path = get_cfg_var('zf3_path');
}

if ($zf3Path) {
    if (isset($loader)) {
        $loader->add('Zend', $zf3Path);
        $loader->add('ZendXml', $zf3Path);
    } else {
        include $zf3Path . '/Zend/Loader/AutoloaderFactory.php';
        Zend\Loader\AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true
            )
        ));
    }
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF3. Run `php composer.phar install` or define a ZF3_PATH environment variable.');
}
