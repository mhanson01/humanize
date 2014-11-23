<?php namespace Humanize;

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
    protected $lowercase_words = array(
        'a','an','and','at','but','by','de','en','for','if','in','of','on','or','the','to','via','vs'
    );

    /**
     * Converts an integer to a string containing commas every three digits.
     *
     * @param $int
     * @return string
     */
    public function intcomma($int)
    {
        return number_format($int, 0, null, ',');
    }

    /**
     * Converts a large integer to a friendly text representation.
     *
     * @param      $int
     * @param int  $decimal_places
     * @param bool $compact
     * @return string
     */
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

    /**
     * Return AP formatted numbers, use words for numbers less than 10.
     *
     * @param $int
     * @return mixed
     */
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

    /**
     * Return humanized date for yesterday, today, and tomorrow, else return date.
     *
     * @param        $date
     * @param string $format
     * @return bool|string
     */
    public function naturalday($date, $format = 'm/d/Y')
    {
        $date = date($format, strtotime($date));

        if($date == $this->yesterday($format)) return 'yesterday';

        if($date == $this->tomorrow($format)) return 'tomorrow';

        if($date == $this->today($format)) return 'today';

        return $date;
    }

    /**
     * Get yesterdays date
     *
     * @param string $format
     * @return bool|string
     */
    public function yesterday($format = 'm/d/Y')
    {
        return date($format, strtotime('-1 day'));
    }

    /**
     * Get tomorrows date
     *
     * @param string $format
     * @return bool|string
     */
    public function tomorrow($format = 'm/d/Y')
    {
        return date($format, strtotime('+1 day'));
    }

    /**
     * Get todays date
     *
     * @param string $format
     * @return bool|string
     */
    public function today($format = 'm/d/Y')
    {
        return date($format);
    }

    /**
     * Converts an integer to its ordinal as a string.
     *
     * @param $number
     * @return string
     */
    public function ordinal($number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        $mod100 = $number % 100;

        return $number . ($mod100 >= 11 && $mod100 <= 13 ? 'th' :  $ends[$number % 10]);
    }

    /**
     * Formats a number to a human-readable number.
     *
     * @param $number
     * @return string
     */
    public function formatnumber($number)
    {
        return number_format($number, 2, '.', ',');
    }

    /**
     * Converts an integer into a compact representation.
     *
     * @param     $int
     * @param int $decimal_places
     * @return string
     */
    public function compactinteger($int, $decimal_places = 0)
    {
        return $this->intword($int, $decimal_places, true);
    }

    /**
     * Bounds a value from above.
     *
     * @param $value
     * @param $max
     * @return string
     */
    public function boundednumber($value, $max)
    {
        if($value > $max) return $max . '+';

        return $value;
    }

    /**
     * Interprets numbers as occurrences. Also accepts an optional array/map of overrides.
     *
     * @param       $value
     * @param array $overrides
     * @return string
     */
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

    /**
     * Returns the plural version of a given word if the value is not 1. The default suffix is 's'.
     *
     * @param      $count
     * @param      $word
     * @param null $plural_override
     * @return string
     */
    public function pluralize($count, $word, $plural_override = null)
    {
        if($count == 1) return $word;

        return $plural_override ?: $word . 's';
    }

    /**
     * Matches a pace (value and interval) with a logical time frame.
     *
     * @param        $value
     * @param        $interval
     * @param string $unit
     * @param null   $plural_override
     * @return string
     */
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

    /**
     * Formats the value like a 'human-readable' file size (i.e. '13 KB', '4.1 MB', '102 bytes', etc).
     *
     * @param     $bytes
     * @param int $decimal_places
     * @param int $bytes_in_kb
     * @return string
     */
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

    /**
     * Truncates a string if it is longer than the specified number of characters.
     * Truncated strings will end with a translatable ellipsis sequence ("…").
     *
     * @param        $sentence
     * @param int    $max_length
     * @param string $ending
     * @return string
     */
    public function truncate($sentence, $max_length = 100, $ending = '...')
    {
        if(strlen($sentence) <= $max_length) return $sentence;

        $ending_length = strlen($ending);

        $sentence_length = $max_length - $ending_length;

        $truncated_sentence = substr($sentence, 0, $sentence_length);

        return $truncated_sentence . $ending;
    }

    /**
     * Truncates a string after a certain number of words.
     *
     * @param $sentence
     * @param $word_count
     * @return string
     */
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

    /**
     * Conversion of <br/> tags to newlines.
     *
     * @param $html
     * @return mixed
     */
    public function br2nl($html)
    {
        return preg_replace('#<br\s*/?>#i', "\n", $html);
    }

    /**
     * Capitalizes the first letter in a string, optionally lowercase the tail.
     *
     * @param      $string
     * @param bool $lowercase_tail
     * @return string
     */
    public function capitalize($string, $lowercase_tail = false)
    {
        if($lowercase_tail)
        {
            $string = strtoupper($string);
        }
        $first_letter = strtoupper(substr($string, 0, 1));

        $tail = substr($string, 1);

        return $first_letter . $tail;
    }

    /**
     * Captializes the first letter of every word in a string.
     *
     * @param $string
     * @return string
     */
    public function capitalizeall($string)
    {
        // just a wrapper, but here to match HubSpot/Humanize
        return ucwords($string);
    }

    /**
     * Intelligently capitalizes eligible words in a string and normalizes internal whitespace.
     *
     * @param $sentence
     * @return string
     */
    public function titlecase($sentence)
    {
        $stripped_of_whitespace = $this->strip_whitespace($sentence);

        $words = explode(' ', $stripped_of_whitespace);

        foreach($words as $word)
        {
            if( ! in_array($word, $this->lowercase_words) and $word == strtolower($word) )
            {
                $formatted_words[] = ucwords($word);
            }
            else
            {
                $formatted_words[] = $word;
            }
        }
        return implode(' ', $formatted_words);
    }

    /**
     * Normalizes internal whitespace.
     *
     * @param $input
     * @return mixed
     */
    public function strip_whitespace($input)
    {
        return preg_replace('!\s+!', ' ', $input);
    }

    /**
     * Converts a list of items to a human readable string with an optional limit.
     *
     * @param      $array
     * @param null $max_count
     * @return string
     */
    public function oxford($array, $max_count = null)
    {
        $array_count = count($array);

        $list = '';
        $comma = '';
        $and = '';
        $additional_items = 0;

        for($i=0; $i<$array_count; $i++)
        {
            if( ($i+1) == $array_count )
            {
                $and = 'and ';
            }

            if( $max_count and ($i+1) > $max_count )
            {
                $additional_items += 1;
            }
            else
            {
                $list .= $comma . $and . $array[$i];
            }
            $comma = ', ';
        }

        if($additional_items)
        {
            $list .= ', and ' . $additional_items . ' ' . $this->pluralize($additional_items, 'other');
        }

        return $list;
    }

    /**
     * Describes how many times an action item appears in a list.
     *
     * @param $list
     * @param $action
     * @return string
     */
    public function frequency($list, $action)
    {
        $list_count = count($list);

        $times = $this->times($list_count);

        if( $list_count == 0)
        {
            return $times . ' ' . $action;
        }

        return $action . ' ' . $times;
    }

    /**
     * Check if a date is on the weekend.
     *
     * @param $date
     * @return bool
     */
    public function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }

    /**
     * Check if a date is a weekday, utilizes the isWeekend function.
     *
     * @param $date
     * @return bool
     */
    public function isWeekday($date)
    {
        return ! $this->isWeekend($date);
    }

}
