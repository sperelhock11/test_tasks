<?php

return [
    'allInclusive' => [
        'type' => 2,
        'description' => 'All inclusive mode',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'allInclusive',
        ],
    ],
];
