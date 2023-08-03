<?php


use App\Models\Assessment;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Get File Name From Formatted Image URL
|--------------------------------------------------------------------------
*/
if (!function_exists('getFileName')) {

    function getFileName(string $file_url)
    {
        $split_string = explode('/', $file_url);

        return $split_string[(count($split_string) - 1)];
    }
}

/*
|--------------------------------------------------------------------------
| Get all values from specific key in a multidimensional array
|--------------------------------------------------------------------------
*/
if (!function_exists('array_value_recursive')) {

    function array_value_recursive(mixed $key, array $arr)
    {
        if ($key == "") throw new InvalidArgumentException("key cannot null or be an empty string ``");

        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });

        return count($val) > 1 ? $val : array_pop($val);
    }

}

/*
|--------------------------------------------------------------------------
| Format Timestamp Based on Local Config Timezone
|--------------------------------------------------------------------------
*/
if (!function_exists('setTimestamp')) {

    function setTimestamp(string $date, bool $is_unix = false)
    {
        $carbon = Carbon::parse($date)->setTimezone(config('app.timezone', 'Asia/Bangkok'));

        return ($is_unix) ? $carbon->timestamp : $carbon->format('Y-m-d H:i:s');
    }

}

/*
|--------------------------------------------------------------------------
| Get Assessment Serial Number as a Result
|--------------------------------------------------------------------------
*/
if (!function_exists('getAsmntSerialNumber')) {

    function getAsmntSerialNumber()
    {
        $count_assessment_history = sprintf("%03s", (Assessment::count() + 1));
        $month = numberToRomanRepresentation(Carbon::now()->format('m'));
        $hour_minute = Carbon::now()->format('Hi');
        $year = Carbon::now()->format('Y');

        return "ASMNT/$count_assessment_history/$month/$hour_minute/$year";
    }

}

/*
|--------------------------------------------------------------------------
| Get Romanian Alphabet
|--------------------------------------------------------------------------
*/
if (!function_exists('numberToRomanRepresentation')) {

    function numberToRomanRepresentation($number)
    {
        $map = array(
            'M' => 1000, 'CM' => 900,
            'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90,
            'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9,
            'V' => 5, 'IV' => 4,
            'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

}

/*
|--------------------------------------------------------------------------
| Get Score From Total Correct Answers
|--------------------------------------------------------------------------
*/
if (!function_exists('getScoreFromTotalCorrectAnswer')) {
    function getScoreFromTotalCorrectAnswer(int $total_question, int $total_correct_answer, bool $with_string = true)
    {
        return ($with_string)
            ? (string)round(($total_correct_answer / $total_question) * 100)
            : round(($total_correct_answer / $total_question) * 100);
    }
}
