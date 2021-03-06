<?php


namespace WhyooOs\Util;


/**
 * 07/2017
 */
class UtilDocument
{
    /**
     * used by cloudlister, schlegel
     * can also handle field names like inventoryItem.currentStockLevel for embedded stuff
     * 09/2020 renamed copyDataFromArrayToDocument --> copyDataFromArrayToDocumentWithWhitelist
     *
     * @param $srcArray
     * @param \stdClass (AbstractDocument) $destDocument the document with getters and setters
     * @param $whiteList
     */
    public static function copyDataFromArrayToDocumentWithWhitelist(array $srcArray, $destDocument, array $whiteList)
    {
        foreach ($whiteList as $attributeName) {
            $myDoc = $destDocument;
            $myArr = $srcArray;

            $subfields = explode('.', $attributeName);
            $lastSubfield = array_pop($subfields);
            $setterName = 'set' . ucfirst($lastSubfield);

            foreach ($subfields as $subfield) {
                $getterName = 'get' . ucfirst($subfield);
                $myDoc = $myDoc->$getterName();

                $myArr = $myArr[$subfield] ?? null;
            }
            $myDoc->$setterName($myArr[$lastSubfield] ?? null);
        }
    }


    /**
     * 07/2018
     *
     * @param $srcArray
     * @param $destObject
     * @param string[] $blacklist
     */
    public static function copyDataFromArrayToDocumentWithBlacklist($srcArray, $destObject, array $blacklist)
    {
        $whiteList = array_diff(array_keys($srcArray), $blacklist);
        self::copyDataFromArrayToDocumentWithWhitelist($srcArray, $destObject, $whiteList);
    }


    /**
     * 09/2020 created
     * used by cloudlister
     *
     * can also handle field names like inventoryItem.currentStockLevel for embedded stuff
     *
     * @param $srcArray
     * @param \stdClass (AbstractDocument) $destDocument the document with getters and setters
     */
    public static function copyDataFromArrayToDocument(array $srcArray, $destDocument)
    {
        self::copyDataFromArrayToDocumentWithWhitelist($srcArray, $destDocument, array_keys($srcArray));
    }


    /**
     * copies properties from one document to another
     * used by mcx-lister ... useful for making a clone of a document
     * 03/2020
     *
     * @param \stdClass (AbstractDocument) $srcDocument
     * @param \stdClass (AbstractDocument) $destDocument the document with getters and setters
     * @param $whiteList
     */
    public static function copyDataFromDocumentToDocument($srcDocument, $destDocument, array $whiteList)
    {
        foreach ($whiteList as $propertyName) {
            $getterName = 'get' . ucfirst($propertyName);
            $setterName = 'set' . ucfirst($propertyName);
            $destDocument->$setterName($srcDocument->$getterName());
        }
    }





//    /**
//     * not used by cloudlister
//     *
//     * @param array $src
//     * @param AbstractDocument $dest the document with getters and setters
//     * @param array $fieldNames
//     */
//    public static function copyFromArray( array $src, $dest, array $fieldNames)
//    {
//        foreach( $fieldNames as $fieldName) {
//            $setterName = "set".ucfirst($fieldName);
//            $dest->$setterName( @$src[$fieldName]);
//        }
//    }



    /**
     * 04/2019 used by cloudlister for sorting products by reorderStatus
     * 12/2019 moved to UtilDocument from UtilArray
     *
     * @param array $array
     * @param string $key
     * @param array $customOrder
     * @return array
     */
    public static function sortDocumentsByCustomOrder(array $array, string $key, array $customOrder)
    {
        $getter = 'get' . ucfirst($key);
        usort($array, function ($a, $b) use ($customOrder, $getter) {
            $pos_b = array_search($b->$getter(), $customOrder);
            $pos_a = array_search($a->$getter(), $customOrder);
            return $pos_a - $pos_b;
        });

        return $array;
    }




}
