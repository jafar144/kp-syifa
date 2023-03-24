<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NikDateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tanggal = (int) substr($value, 6, 2);
        $bulan = (int) substr($value, 8, 2);
        return (($tanggal > 0 && $tanggal <= 31) || ($tanggal > 40 && $tanggal <= 71)) && $bulan <= 12;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'NIK tidak valid. Kemungkinan ada kesalahan (typo)';
    }
}
