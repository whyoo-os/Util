<?php

namespace WhyooOs\Util;




/**
 *
 */
class UtilAssert
{


    /**
     * @param $bAssertion
     * @param string $errorMessage
     * @throws \Exception
     */
    public static function assertTrue($bAssertion, $errorMessage = "")
    {
        if ($bAssertion != true) {
            throw new \Exception("Assertion failed: " . $errorMessage);
        }
    }

    /**
     * @param $subject
     * @param string $errorMessage
     * @throws \Exception
     */
    public static function assertNotNull($subject, $errorMessage = "")
    {
        if (is_null($subject)) {
            throw new \Exception("Assertion 'Not Null' failed: " . $errorMessage);
        }
    }


    /**
     * @param $subject
     * @param string $errorMessage
     * @throws \Exception
     */
    public static function assertNotEmpty($subject, $errorMessage = "")
    {
        if (empty($subject)) {
            throw new \Exception("Assertion 'Not Empty' failed: " . $errorMessage);
        }
    }

    /**
     * @param $bAssertion
     * @param string $errorMessage
     * @throws \Exception
     */
    public static function assertEqual($v1, $v2, $errorMessage = "")
    {
        if ($v1 != $v2) {
            throw new \Exception("Assertion failed ($v1 != $v2):" . $errorMessage);
        }
    }

    /**
     * @param $bAssertion
     * @param string $errorMessage
     * @throws \Exception
     */
    public static function assertFalse($bAssertion, $errorMessage = "")
    {
        if ($bAssertion != false) {
            throw new \Exception("Assertion failed: " . $errorMessage);
        }
    }

    /**
     * @param mixed $needle
     * @param array $haystack
     * @param string $errorMessage
     * @throws \Exception
     */
    public static function assertInArray($needle, array $haystack, $errorMessage='')
    {
        if (!in_array($needle, $haystack)) {
            throw new \Exception("InArray Assertion failed - '$needle' not in array'" . $errorMessage);
        }
    }

    public static function assertClass($object, string $neededClass, $errorMessage = 'class mismatch')
    {
        $actualClass = get_class($object);
        if ($actualClass != $neededClass) {
            throw new \Exception("is class assertion failed $actualClass != $neededClass " . $errorMessage);
        }
    }

    public static function assertFileExists($pathFile, $errorMessage = '')
    {
        if (!file_exists($pathFile)) {
            throw new \Exception("file exists assertion failed for file $pathFile." . $errorMessage);
        }
    }

}
