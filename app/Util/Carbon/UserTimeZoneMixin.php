<?php

namespace App\Util\Carbon;

use Illuminate\Support\Facades\Auth;

class UserTimeZoneMixin
{
    public function toUserTimezone() {
        return static function () {
            $date = self::this();
            if (Auth::check() && Auth::user()->timezone !== null) {
                return $date->timezone(Auth::user()->timezone);
            }
            return $date;
        };
    }
}
