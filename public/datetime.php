<?php

/**
 * Calculate the difference in months between two dates
 *
 * @param DateTime $from
 * @param DateTime $to
 * @return int
 */
function diffInMonths(DateTime $from, DateTime $to)
{
    // Count months from year and month diff
    $diff = $to->diff($from)->format('%y') * 12 + $to->diff($from)->format('%m');

    // If there is some day leftover, count it as the full month
    if ($to->diff($from)->format('%d') > 0) $diff++;

    // The month count isn't still right in some cases. This covers it.
    if ($from->format('d') >= $to->format('d')) $diff++;
    
    return $diff;
}