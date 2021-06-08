<?php

namespace WhyooOs\Util;

use Gettext\Loader\PoLoader;

/**
 * 06/2021 created
 */
class UtilGettext
{

    /**
     * this one can be used to transform a .po file (on-the-fly) to a json dict
     *
     * composer require gettext/gettext
     *
     * 06/2021 created
     *
     * @param string $pathPoFile eg "/app/lang/de.po"
     * @return array
     */
    public static function getPoFileAsDict(string $pathPoFile): array
    {
        $loader = new PoLoader();
        $translations = $loader->loadFile($pathPoFile);

        $dict = [];
        /** @var \Gettext\Translation $translation */
        foreach ($translations->getIterator() as $translation) {
            $dict[$translation->getOriginal()] = $translation->getTranslation();
        }

        return $dict;
    }
}
