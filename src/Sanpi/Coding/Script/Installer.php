<?php

namespace Sanpi\Coding\Script;

use Composer\Script\Event;

class Installer
{
    public static function postUpdate(Event $event)
    {
        $rootDir = __DIR__ . '/../../../../';
        $webDir = "$rootDir/web";
        $bootstrapDir = "$rootDir/vendor/twitter/bootstrap/";

        self::createDirectory("$webDir/css");
        self::createDirectory("$webDir/img");
        self::createDirectory("$webDir/js");

        require "$rootDir/vendor/leafo/lessphp/lessc.inc.php";
        $lessc = new \lessc();
        $css = $lessc->compileFile("$bootstrapDir/less/bootstrap.less");
        file_put_contents("$webDir/css/bootstrap.css", $css);

        copy("$bootstrapDir/js/bootstrap-modal.js", "$webDir/js/bootstrap-modal.js");
        copy("$bootstrapDir/img/glyphicons-halflings.png", "$webDir/img/glyphicons-halflings.png");
    }

    static private function createDirectory($name)
    {
        if (!is_dir($name)) {
            mkdir($name);
        }
    }
}
