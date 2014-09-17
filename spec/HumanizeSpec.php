<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HumanizeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Humanize');
    }

    function it_formats_numbers_with_commas()
    {
        $this->intcomma(1000)->shouldReturn('1,000');
    }

    function it_formats_large_numbers_with_commas()
    {
        $this->intcomma(1000000000)->shouldReturn('1,000,000,000');
    }

    function it_converts_number_less_than_10_to_words()
    {
        $this->apnumber(1)->shouldReturn('one');
    }

    function it_converts_2_to_two()
    {
        $this->apnumber(2)->shouldReturn('two');
    }

    function it_does_not_convert_numbers_10_or_larger_to_words()
    {
        $this->apnumber(10)->shouldReturn(10);
    }

    function it_returns_today_for_the_current_date()
    {
        $this->naturalday(date('m/d/Y'))->shouldReturn('today');
    }

    function it_returns_yesterday_for_yesterdays_date()
    {
        $this->naturalday(date('m/d/Y', strtotime('-1 day')))->shouldReturn('yesterday');
    }

    function it_returns_tomorrow_for_tomorrows_date()
    {
        $this->naturalday(date('m/d/Y', strtotime('+1 day')))->shouldReturn('tomorrow');
    }

    function it_returns_the_date_when_its_farther_than_one_day_away()
    {
        $this->naturalday('12/31/2000')->shouldReturn('12/31/2000');
    }

    function it_formats_the_date_when_supplied_with_date_format()
    {
        $this->naturalday('12/31/2000', 'Y-m-d')->shouldReturn('2000-12-31');
    }

    function it_adds_the_ordinal_suffix_to_a_number()
    {
        $this->ordinal(1)->shouldReturn('1st');
    }

    function it_adds_the_ordinal_suffix_to_2()
    {
        $this->ordinal(2)->shouldReturn('2nd');
    }

    function it_adds_the_ordinal_suffix_to_3()
    {
        $this->ordinal(3)->shouldReturn('3rd');
    }

    function it_adds_the_ordinal_suffix_to_4()
    {
        $this->ordinal(4)->shouldReturn('4th');
    }

    function it_adds_the_ordinal_suffix_to_5()
    {
        $this->ordinal(5)->shouldReturn('5th');
    }

    function it_adds_the_ordinal_suffix_to_6()
    {
        $this->ordinal(6)->shouldReturn('6th');
    }

    function it_adds_the_ordinal_suffix_to_7()
    {
        $this->ordinal(7)->shouldReturn('7th');
    }

    function it_adds_the_ordinal_suffix_to_8()
    {
        $this->ordinal(8)->shouldReturn('8th');
    }

    function it_adds_the_ordinal_suffix_to_9()
    {
        $this->ordinal(9)->shouldReturn('9th');
    }

    function it_adds_the_ordinal_suffix_to_10()
    {
        $this->ordinal(10)->shouldReturn('10th');
    }

    function it_adds_the_ordinal_suffix_to_11()
    {
        $this->ordinal(11)->shouldReturn('11th');
    }

    function it_adds_the_ordinal_suffix_to_12()
    {
        $this->ordinal(12)->shouldReturn('12th');
    }

    function it_adds_the_ordinal_suffix_to_13()
    {
        $this->ordinal(13)->shouldReturn('13th');
    }

    function it_adds_the_ordinal_suffix_to_23()
    {
        $this->ordinal(23)->shouldReturn('23rd');
    }

    function it_adds_the_ordinal_suffix_to_52()
    {
        $this->ordinal(52)->shouldReturn('52nd');
    }

    function it_convert_large_integers_to_words()
    {
        $this->intword(1000000)->shouldReturn('1 million');
    }

    function it_converts_a_billion_to_words()
    {
        $this->intword(1000000000)->shouldReturn('1 billion');
    }

    function it_converts_123456789_to_words()
    {
        $this->intword(123456789)->shouldReturn('123 million');
    }

    function it_formats_numbers_with_decimal_places_and_commas()
    {
        $this->formatnumbers(123456789, 2)->shouldReturn('123,456,789.00');
    }

    function it_formats_numbers_that_have_decimals_already()
    {
        $this->formatnumbers(123456789.12, 2)->shouldReturn('123,456,789.12');
    }

    function it_compacts_large_numbers()
    {
        $this->compactinteger(123456789, 1)->shouldReturn('123.5M');
    }

    function it_bounds_a_number_to_the_max()
    {
        $this->boundednumber(110, 100)->shouldReturn('100+');
    }

    function it_allows_a_number_within_the_bounds()
    {
        $this->boundednumber(50, 100)->shouldReturn(50);
    }

}
