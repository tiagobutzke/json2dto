<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/21/14
 * Time: 3:28 PM
 */

namespace Json2Dto\Util;


abstract class Message
{
    public static $startTemplate = "
=----------------------------------------------------=\n
=                 Generator Starting                 =\n
=----------------------------------------------------=\n";

    public static $loadingTemplate = "--> Loading...\n";

    public static $writingTemplate = "--> Writing...\n";

    public static $classTemplate = " - %s\n";

    public static $thanksTemplate = "
=----------------------------------------------------=\n
=                      Success!                      =\n
=                author: @tiagobutzke                =\n
=----------------------------------------------------=\n";

    public static function write($message)
    {
        fwrite(STDOUT, $message);
    }
} 