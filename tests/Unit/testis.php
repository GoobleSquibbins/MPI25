<?php

namespace Tests\Unit;

test('sum', function () {
   $result = sum(1, 2);
 
   expect($result)->toBe(3);
});