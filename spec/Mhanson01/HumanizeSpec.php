<?php

namespace spec\Mhanson01;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HumanizeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Mhanson01\Humanize');
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
        $this->formatnumber(123456789, 2)->shouldReturn('123,456,789.00');
    }

    function it_formats_numbers_that_have_decimals_already()
    {
        $this->formatnumber(123456789.12, 2)->shouldReturn('123,456,789.12');
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

    function it_return_how_many_times_the_value_happened()
    {
        $this->times(0)->shouldReturn('never');
    }

    function it_return_once_for_how_many_times()
    {
        $this->times(1)->shouldReturn('once');
    }

    function it_return_twice_for_how_many_times()
    {
        $this->times(2)->shouldReturn('twice');
    }

    function it_return_3_times_for_how_many_times()
    {
        $this->times(3)->shouldReturn('3 times');
    }

    function it_accepts_overrides_for_how_many_times()
    {
        $this->times(3, [3 => 'too many'])->shouldReturn('too many times');
    }

    function it_does_not_pluralizes_a_word_when_1_is_passed()
    {
        $this->pluralize(1, 'duck')->shouldReturn('duck');
    }

    function it_does_pluralizes_a_word_when_2_is_passed()
    {
        $this->pluralize(2, 'duck')->shouldReturn('ducks');
    }

    function it_accepts_an_override_when_pluralizing_a_word_when_2_is_passed()
    {
        $this->pluralize(2, 'duck', 'duckies')->shouldReturn('duckies');
    }

    function it_sets_the_pace()
    {
        $this->pace(1.5, 'second', 'heartbeat')->shouldReturn('Approximately 2 heartbeats per second');
    }

    function it_sets_the_pace_4_week()
    {
        $this->pace(4, 'week')->shouldReturn('Approximately 4 times per week');
    }

    function it_return_a_readable_filesize()
    {
        $this->filesize(1024)->shouldReturn('1 KB');
    }

    function it_return_a_readable_filesize_in_mb()
    {
        $this->filesize(1048576)->shouldReturn('1 MB');
    }

    function it_return_a_readable_filesize_in_gb()
    {
        $this->filesize(1073741824)->shouldReturn('1 GB');
    }

    function it_return_a_readable_filesize_using_1000_as_kb_in_bytes()
    {
        $this->filesize(1000, 0, 1000)->shouldReturn('1 KB');
    }

    function it_return_a_readable_filesize_in_tb_using_1000_as_kb_in_bytes()
    {
        $this->filesize(10000000000000, 0, 1000)->shouldReturn('10 TB');
    }

    function it_truncates_a_sentence_with_ellipsis()
    {
        $this->truncate('long text is good for you', 19)->shouldReturn('long text is goo...');
    }

    function it_truncates_a_sentence_with_ending_overrided()
    {
        $this->truncate('long text is good for you', 19, '... etc')->shouldReturn('long text is... etc');
    }

    function it_truncates_by_word_count_using_spaces_to_separate_words()
    {
        $this->truncatewords('long text is good for you', 5)->shouldReturn('long text is good for...');
    }

    function it_converts_breaks_to_new_line_characters()
    {
        $this->br2nl('line 1<br>line 2')->shouldReturn("line 1\nline 2");
    }

    function it_converts_slash_breaks_to_new_line_characters()
    {
        $this->br2nl('line 1<br/>line 2')->shouldReturn("line 1\nline 2");
    }

    function it_converts_whitespace_and_slash_breaks_to_new_line_characters()
    {
        $this->br2nl('line 1<br />line 2')->shouldReturn("line 1\nline 2");
    }

    function it_capitalizes_the_first_letter_of_a_sentence()
    {
        $this->capitalize('some boring string')->shouldReturn('Some boring string');
    }

    function it_capitalizes_every_word_of_a_sentence()
    {
        $this->capitalizeall('some boring string')->shouldReturn('Some Boring String');
    }

    function it_intelligently_capitalizes_words_in_a_sentence()
    {
        $this->titlecase('some of a boring string')->shouldReturn('Some of a Boring String');
    }

    function it_intelligently_capitalizes_words_in_a_sentence_with_extra_whitespace()
    {
        $this->titlecase('cool the          iTunes cake, O\'Malley!')->shouldReturn('Cool the iTunes Cake, O\'Malley!');
    }

    function it_strips_whitespace_from_a_string()
    {
        $this->strip_whitespace('Get           over     here!')->shouldReturn('Get over here!');
    }

    public $items = ['apple', 'orange', 'banana', 'pear', 'pineapple'];

    function it_returns_a_formatted_array_list()
    {
        $this->oxford($this->items)->shouldReturn('apple, orange, banana, pear, and pineapple');
    }

    function it_returns_a_limited_formatted_array_list()
    {
        $this->oxford($this->items, 3)->shouldReturn('apple, orange, banana, and 2 others');
    }

    public $pictures = ['breakfast', 'lunch', 'dinner'];

    function it_structures_a_sentence_properly_for_frequency()
    {
        $this->frequency($this->pictures, 'took pictures of food')->shouldReturn('took pictures of food 3 times');
    }

    public $selfies = [];

    function it_structures_a_sentence_properly_for_an_empty_frequency()
    {
        $this->frequency($this->selfies, 'took selfies')->shouldReturn('never took selfies');
    }

}
