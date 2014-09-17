<?php

class Humanize
{
    protected $magnitudes = array(
        12 => 'trillion',
        9  => 'billion',
        6  => 'million',
        3  => 'thousand',
        0  => ''
    );
    protected $abbreviations = array(
        12 => 'T',
        9  => 'B',
        6  => 'M',
        3  => 'K',
        0  => ''
    );

    public function intcomma($int)
    {
        return number_format($int, 0, null, ',');
    }

    public function intword($int, $decimal_places = 0, $type = 'word')
    {
        if($type == 'compact')
        {
            $array = $this->abbreviations;
            $spacer = null;
        }
        else
        {
            $array = $this->magnitudes;
            $spacer = ' ';
        }

        foreach($array as $exponent => $suffix)
        {
            if($int >= pow(10, $exponent))
            {
                return round(floatval($int / pow(10, $exponent)), $decimal_places) . $spacer . $suffix;
            }
        }

        return $int;
    }

    public function apnumber($int)
    {
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
        );

        return isset($dictionary[$int]) ? $dictionary[$int] : $int;
    }

    public function naturalday($date, $format = 'm/d/Y')
    {
        $date = date($format, strtotime($date));

        if($date == $this->yesterday($format)) return 'yesterday';

        if($date == $this->tomorrow($format)) return 'tomorrow';

        if($date == $this->today($format)) return 'today';

        return $date;
    }

    public function yesterday($format = 'm/d/Y')
    {
        return date($format, strtotime('-1 day'));
    }

    public function tomorrow($format = 'm/d/Y')
    {
        return date($format, strtotime('+1 day'));
    }

    public function today($format = 'm/d/Y')
    {
        return date($format);
    }

    public function ordinal($number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        $mod100 = $number % 100;

        return $number . ($mod100 >= 11 && $mod100 <= 13 ? 'th' :  $ends[$number % 10]);
    }

    public function formatnumbers($number)
    {
        return number_format($number, 2, '.', ',');
    }

    public function compactinteger($int, $decimal_places = 0)
    {
        return $this->intword($int, $decimal_places, 'compact');
    }

    public function boundednumber($value, $max)
    {
        if($value > $max) return $max . '+';

        return $value;
    }

}
