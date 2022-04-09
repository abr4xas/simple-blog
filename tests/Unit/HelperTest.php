<?php

test('it can get an array of suggestion from google', function () {
    $array = suggestKeyword('php');
    expect($array)->toBeArray();
});
