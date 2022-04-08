<?php
declare(strict_types=1);

namespace BlueMedia\Hash;

use BlueMedia\Configuration;

final class HashGenerator
{
    /**
     * Generates hash.
     *
     * @param array $data
     * @param Configuration $configuration
     *
     * @return string
     */
    public static function generateHash(array $data, Configuration $configuration): string
    {
        $result = '';

        foreach ($data as $name => $value) {
            if (mb_strtolower($name) === 'hash') {
                unset($data[$name]);
                continue;
            }

            if (is_array($value)) {
                $value = self::arrayValuesRecursive($value);
                $value = array_filter($value, 'mb_strlen');
                $value = implode($configuration->getHashSeparator(), $value);
            }

            $result .= $value . $configuration->getHashSeparator();
        }

        $result .= $configuration->getSharedKey();

        return hash($configuration->getHashAlgo(), $result);
    }

    private static function arrayValuesRecursive($value)
    {
        $flat = [];
        foreach ($value as $item) {
            if (is_array($item)) {
                $flat = array_merge($flat, self::arrayValuesRecursive($item));
            } else {
                $flat[] = $item;
            }
        }
        return $flat;
    }
}
