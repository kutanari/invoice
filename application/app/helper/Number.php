<?php

declare(strict_types=1);

class Number
{
    /**
     * Convert number to readable rupiah
     *
     * @param float $number
     * @return string
     */
    public static function formatRupiah(float $number): string
    {
        $string_number = explode('.', (string) $number);
        $str_split = preg_split('~\B(?=(...)+$)~', $string_number[0]);
        return 'Rp' . implode('.', $str_split) . (isset($string_number[1]) ? ',' . $string_number[1] : ',-');
    }
}
