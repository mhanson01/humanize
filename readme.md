# PHP Humanize

Helps to convert PHP data into human readable information. Dates, strings, file sizes, pluralization, arrays, ordinals, number formatting, etc.

## API Methods

##### intcomma

Converts an integer to a string containing commas every three digits.

##### intword

Converts a large integer to a friendly text representation.

##### apnumber

Return AP (Associated Press) formatted numbers, use words for numbers less than 10.

##### naturalday

Return humanized date for yesterday, today, and tomorrow, else return date.

##### yesterday (helper method)

Get yesterdays date

##### tomorrow (helper method)

Get tomorrows date

##### today (helper method)

Get todays date

##### ordinal

Converts an integer to its ordinal as a string.

##### formatnumber

Formats a number to a human-readable number.

##### compactinteger

Converts an integer into a compact representation.

##### boundednumber

Bounds a value from above.

##### times

Interprets numbers as occurrences. Also accepts an optional array/map of overrides.

##### pluralize

Returns the plural version of a given word if the value is not 1. The default suffix is 's'.

##### pace

Matches a pace (value and interval) with a logical time frame.

##### filesize

Formats the value like a 'human-readable' file size (i.e. '13 KB', '4.1 MB', '102 bytes', etc).

##### truncate

Truncates a string if it is longer than the specified number of characters. Truncated strings will end with a translatable ellipsis sequence ("…").

##### truncatewords

Truncates a string after a certain number of words.

##### br2nl

Conversion of <br/> tags to newlines.

##### capitalize

Capitalizes the first letter in a string, optionally lowercase the tail.

##### capitalizeall

Captializes the first letter of every word in a string.

##### titlecase

Intelligently capitalizes eligible words in a string and normalizes internal whitespace.

##### strip_whitespace

Normalizes internal whitespace.

##### oxford

Converts a list of items to a human readable string with an optional limit.

##### frequency

Describes how many times an action item appears in a list.

##### isWeekend

Check if a date is on the weekend.

##### isWeekday

Check if a date is a weekday, utilizes the isWeekend function.

## Credit

* Inspiration from [HubSpot Humanize](https://github.com/HubSpot/humanize)

### License

PHP Humanize is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)