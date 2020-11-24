<?php

if (! function_exists('generateStrongPassword')) {
    /**
     * Generates a strong password of N length containing at least one lower case letter,
     * one uppercase letter, one digit, and one special character. The remaining characters
     * in the password are chosen at random from those four sets.
     *
     * The available characters in each set are user friendly - there are no ambiguous
     * characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
     * makes it much easier for users to manually type or speak their passwords.
     *
     * Note: the $add_dashes option will increase the length of the password by
     * floor(sqrt(N)) characters.
     */
    function generateStrongPassword(int $length = 9, bool $add_dashes = false, string $available_sets = 'luds'): string
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';

        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if(!$add_dashes)
            return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}

if (! function_exists('listTimezones')) {
    /**
     * Returns a list of all valid timezones, where the key is
     * the timezone identifier and the value is a human friendly timezone label.
     *
     * @return array
     */
    function listTimezones(): array
    {
        return collect(\DateTimeZone::listIdentifiers())
            ->mapWithKeys(fn ($tz) => [$tz => str_replace('_', ' ', $tz)])
            ->toArray();
    }
}

if (! function_exists('googleMapsPlaceUrlByCoordinates')) {
    function googleMapsPlaceUrlByCoordinates(float $latitude, float $longitude): string
    {
        return 'http://www.google.com/maps/place/' . $latitude . ',' . $longitude;
    }
}

if (! function_exists('tel_url')) {
    function telUrl(string $value): string
    {
        return 'tel:' . preg_replace('/[^+0-9]/', '', $value);
    }
}
