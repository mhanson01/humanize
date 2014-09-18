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

    public function intword($int, $decimal_places = 0, $compact = false)
    {
        if($compact)
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
        return $this->intword($int, $decimal_places, true);
    }

    public function boundednumber($value, $max)
    {
        if($value > $max) return $max . '+';

        return $value;
    }

    public function times($value, $overrides = [])
    {
        $return_value = isset($overrides[$value]) ? $overrides[$value] : $value;

        switch($value) {
            case 0:
                return 'never';
            case 1:
                return 'once';
            case 2:
                return 'twice';
            default:
                return $return_value . ' times';
        }

    }

    public function pluralize($count, $word, $plural_override = null)
    {
        if($count == 1) return $word;

        return $plural_override ?: $word . 's';
    }

    public function pace($value, $interval, $unit = 'time', $plural_override = null)
    {
        $rounded = round($value);

        if($rounded > 1)
        {
            $prefix = 'Approximately ';
            $unit = $this->pluralize($rounded, $unit, $plural_override);
        }
        elseif($rounded < 1)
        {
            $prefix = 'Less than ';
            $rounded = 1;
        }

        return $prefix . $rounded . ' ' . $unit . ' per ' . $interval;
    }

    public function filesize($bytes, $decimal_places = 0, $bytes_in_kb = 1024)
    {
        $bytes_in_tb = $bytes_in_kb * $bytes_in_kb * $bytes_in_kb * $bytes_in_kb;
        $bytes_in_gb = $bytes_in_kb * $bytes_in_kb * $bytes_in_kb;
        $bytes_in_mb = $bytes_in_kb * $bytes_in_kb;

        if ($bytes >= $bytes_in_tb)
        {
            $bytes = number_format($bytes / $bytes_in_tb, $decimal_places) . ' TB';
        }
        elseif ($bytes >= $bytes_in_gb)
        {
            $bytes = number_format($bytes / $bytes_in_gb, $decimal_places) . ' GB';
        }
        elseif ($bytes >= $bytes_in_mb)
        {
            $bytes = number_format($bytes / $bytes_in_mb, $decimal_places) . ' MB';
        }
        elseif ($bytes >= $bytes_in_kb)
        {
            $bytes = number_format($bytes / $bytes_in_kb, $decimal_places) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function truncate($sentence, $max_length = 100, $ending = '...')
    {
        if(strlen($sentence) <= $max_length) return $sentence;

        $ending_length = strlen($ending);

        $sentence_length = $max_length - $ending_length;

        $truncated_sentence = substr($sentence, 0, $sentence_length);

        return $truncated_sentence . $ending;
    }

    public function truncatewords($sentence, $word_count)
    {
        $words = explode(' ', $sentence);

        $truncated_sentence = '';
        $space = '';

        for($i=0; $i<$word_count; $i++)
        {
            $truncated_sentence .= $space . $words[$i];
            $space = ' ';
        }

        return $truncated_sentence . '...';
    }

    public function br2nl($html)
    {
        return preg_replace('#<br\s*/?>#i', "\n", $html);
    }

}
