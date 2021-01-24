<?php


namespace Bin\Service;


class BinService
{
    protected const EUR_CODES = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI',
        'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT',
        'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];

    /**
     * @param string $code
     * @return bool
     */
    public function isBinEur(string $code): bool
    {
        if (empty($code)) {
            return false;
        }

        return in_array($code, self::EUR_CODES);
    }
}