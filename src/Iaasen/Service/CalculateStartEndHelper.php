<?php
/**
 * User: ingvar.aasen
 * Date: 2025-08-08
 */

namespace Iaasen\Service;

class CalculateStartEndHelper
{
    /**
     * Returns an array with start and end times in unix timestamp
     * Result is based on post/query parameters: year, month, start, end
     * year and month are integers
     * start and end are unix timestamps or timedate strings
     * @return int[] Format [(int) unixTimestampStart, (int) unixTimestampEnd]
     */
    public static function calculateStartEnd(
        int|null $year = null,
        int|null $month = null,
        int|string|null $start = null,
        int|string|null $end = null
    ): array
    {
        if($start && !is_numeric($start)) $start = strtotime($start);
        if($end && !is_numeric($end)) $end = strtotime($end);

        if($start === null) { // Default is beginning of current month
            $start = mktime(0, 0, 0, $month, 1, $year);
        }

        // Calculate end of this month (actually beginning of next month)
        if($month == 12) {
            $_month = 1;
            $_year = $year + 1;
        }
        else {
            $_month = $month + 1;
            $_year = $year;
        }
        $endOfThisMonth = mktime(0, 0, 0, $_month, 1, $_year);

        if($end === null) { // Default is beginning of next month
            $end = $endOfThisMonth;
        }

        // Don't go beyond current month
        if($end > $endOfThisMonth) $end = $endOfThisMonth;

        return [(int) $start, (int) $end];
    }


    public static function isRequestForSingleMonth(int|string|null $year, int|string|null $month): bool
    {
        return is_numeric($year) && is_numeric($month);
    }


    /**
     * @return int[]|null Format [(int) year, (int) month]
     */
    public static function getRequestForSingleMonth(int|string|null $year, int|string|null $month) : array|null
    {
        if(!static::isRequestForSingleMonth($year, $month)) return null;
        return [
            (int) $year,
            (int) $month,
        ];
    }

}
