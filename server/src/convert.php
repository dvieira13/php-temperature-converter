<?php
// convert.php

function convertTemperature(float $value, string $from, string $to): float {
    // Convert input to Celsius
    switch ($from) {
      case 'F':
        $celsius = ($value - 32) * (5 / 9);
        break;
      case 'K':
        $celsius = $value - 273.15;
        break;
      case 'C':
      default:
        $celsius = $value;
        break;
    }

    // Convert from Celsius to target
    switch ($to) {
      case 'F':
        return $celsius * (9 / 5) + 32;
      case 'K':
        return $celsius + 273.15;
      case 'C':
      default:
        return $celsius;
    }
}
