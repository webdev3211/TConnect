<?php

$test1 = DB::table('conversation')
->where('status', 1)
->where('user_one', Auth::user()->id)
->count();

$test2 = DB::table('conversation')
->where('status', 1)
->where('user_two', Auth::user()->id)
->count();

//return array_merge($test1->toArray(), $test2->toArray());

echo $test1+$test2;




?>

