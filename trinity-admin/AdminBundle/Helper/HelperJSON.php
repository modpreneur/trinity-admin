<?php

namespace Trinity\AdminBundle\Helper;

use Nette\Utils\DateTime;

/**
 * Class HelperJSON.
 *
 * @deprecated
 */
class HelperJSON
{
    /**
     * Returns object encoded in json
     * Encode only first level (FK are expressed as ID strings).
     *
     * @param $data object
     * @param $secret
     *
     * @return string
     *
     * @internal param string $hash
     */
    public static function json_encode_object($data, $secret)
    {
        $className = get_class($data);
        $result = array();

        if ($className == 'Necktie\ProductBundle\Entity\Product') {
            $result['productId'] = (new \ReflectionMethod($className, 'getId'))->invoke($data);
            $result['name'] = (new \ReflectionMethod($className, 'getName'))->invoke($data);
            $result['description'] = (new \ReflectionMethod($className, 'getDescription'))->invoke($data);
            $result['type'] = (new \ReflectionMethod($className, 'getType'))->invoke($data);
            $result['price'] = (new \ReflectionMethod($className, 'getPrice'))->invoke($data);
        } else {
            $class_methods = get_class_methods($data);

            foreach ($class_methods as $method) {
                if (substr($method, 0, 3) == 'get' and $method != 'getUrlPostfix') {
                    $reflectionMethod = new \ReflectionMethod($className, $method);
                    $data_param = $reflectionMethod->invoke($data);

                    if (is_object($data_param) and $data_param instanceof \DateTime) {
                        $data_param = $data_param->format('Y-m-d H:i:s');
                    } elseif (is_object($data_param)) {
                        $data_param = $data_param->getId();
                    }

                    $result[lcfirst(substr($method, 3))] = $data_param;
                }
            }
        }

        $result['timestamp'] = (new DateTime())->getTimestamp();

        $result['hash'] = hash('sha256', $secret.(implode(',', $result)));

        return json_encode($result);
    }
}
