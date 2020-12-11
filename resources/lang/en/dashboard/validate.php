<?php

return [
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'required' => 'The :attribute field is required.',
    'active_url' => 'The :attribute is not a valid URL.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'image' => 'The :attribute must be an image.',
    'unique' => 'The :attribute has already been taken.',
    'same' => 'The :attribute and :other must match.',

    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',

    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],

];
