<?php
/**
 * PrivateBin
 *
 * a zero-knowledge paste bin
 *
 * @link      https://github.com/PrivateBin/PrivateBin
 * @copyright 2012 Sébastien SAUVAGE (sebsauvage.net)
 * @license   https://www.opensource.org/licenses/zlib-license.php The zlib/libpng License
 * @version   1.5.1
 */

namespace PrivateBin;

use Exception;

/**
 * Filter
 *
 * Provides data filtering functions.
 */
class Filter
{
    /**
     * Supported time units
     *
     * @const array
     */
    const SUPPORTED_TIME_UNITS = array(
        'sec',
        'min',
        'h',
        'd',
        'w',
        'month',
        'y',
    );

    /**
     * format a given time value into a human readable, pluralized, and localized label
     *
     * @access public
     * @static
     * @param  int    $value - The numeric time value
     * @param  string $unit  - The time unit (e.g., 'sec', 'min', 'h', 'd', 'w', 'month', 'y')
     * @throws Exception
     * @return string
     */
    public static function formatHumanReadableTime($value, $unit)
    {
        // Validate the input value
        if (!is_int($value) || $value < 0) {
            throw new Exception('Time value must be a non-negative integer', 30);
        }

        // Validate the unit
        $unit = strtolower(trim($unit));
        if (!in_array($unit, self::SUPPORTED_TIME_UNITS)) {
            throw new Exception("Unsupported time unit: '{$unit}'", 30);
        }

        // Map short units to long form for localization
        $unitMap = array(
            'sec'   => 'second',
            'min'   => 'minute',
            'h'     => 'hour',
            'd'     => 'day',
            'w'     => 'week',
            'month' => 'month',
            'y'     => 'year',
        );

        $longForm = $unitMap[$unit];

        // Return localized plural-aware string
        return I18n::_(
            array('%d ' . $longForm, '%d ' . $longForm . 's'),
            $value
        );
    }

    /**
     * format a given number of bytes in IEC 80000-13:2008 notation (localized)
     *
     * @access public
     * @static
     * @param  int $size
     * @return string
     */
    public static function formatHumanReadableSize($size)
    {
        $iec = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $i   = 0;
        while (($size / 1024) >= 1) {
            $size = $size / 1024;
            ++$i;
        }
        return number_format($size, ($i ? 2 : 0), '.', ' ') . ' ' . I18n::_($iec[$i]);
    }
}
