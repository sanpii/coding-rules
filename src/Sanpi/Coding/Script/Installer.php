<?php

namespace Sanpi\Coding\Script;

use Composer\Script\Event;

class Installer
{
    public static function postUpdate(Event $event)
    {
        $rootDir = __DIR__ . '/../../../../';
        $bootstrapDir = "$rootDir/vendor/bsrykt/twitter-bootstrap/";

        if (!is_dir("$bootstrapDir/css")) {
            mkdir("$bootstrapDir/css");
        }

        require "$rootDir/vendor/leafo/lessphp/lessc.inc.php";
        $lessc = new \lessc();
        $css = $lessc->compileFile("$bootstrapDir/less/bootstrap.less");
        file_put_contents("$bootstrapDir/css/bootstrap.css", $css);
    }
}
