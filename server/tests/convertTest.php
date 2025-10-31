<?php
use PHPUnit\Framework\TestCase;

// Include the function to test
require_once __DIR__ . '/../src/convert.php';

final class ConvertTest extends TestCase
{
    // Celsius → Fahrenheit
    public function testCelsiusToFahrenheit(): void
    {
        $this->assertEqualsWithDelta(32, convertTemperature(0, 'C', 'F'), 0.01);
    }

    // Celsius → Kelvin
    public function testCelsiusToKelvin(): void
    {
        $this->assertEqualsWithDelta(373.15, convertTemperature(100, 'C', 'K'), 0.01);
    }

    // Fahrenheit → Celsius
    public function testFahrenheitToCelsius(): void
    {
        $this->assertEqualsWithDelta(100, convertTemperature(212, 'F', 'C'), 0.01);
    }

    // Fahrenheit → Kelvin
    public function testFahrenheitToKelvin(): void
    {
        $this->assertEqualsWithDelta(273.15, convertTemperature(32, 'F', 'K'), 0.01);
    }

    // Kelvin → Celsius
    public function testKelvinToCelsius(): void
    {
        $this->assertEqualsWithDelta(-273.15, convertTemperature(0, 'K', 'C'), 0.01);
    }

    // Kelvin → Fahrenheit
    public function testKelvinToFahrenheit(): void
    {
        $this->assertEqualsWithDelta(32, convertTemperature(273.15, 'K', 'F'), 0.01);
    }

    // Negative Celsius → Fahrenheit
    public function testNegativeCelsiusToFahrenheit(): void
    {
        $this->assertEqualsWithDelta(-40, convertTemperature(-40, 'C', 'F'), 0.01);
    }

    // Negative Fahrenheit → Celsius
    public function testNegativeFahrenheitToCelsius(): void
    {
        $this->assertEqualsWithDelta(-40, convertTemperature(-40, 'F', 'C'), 0.01);
    }

    // Decimal conversion
    public function testDecimalConversion(): void
    {
        $this->assertEqualsWithDelta(97.88, convertTemperature(36.6, 'C', 'F'), 0.01);
    }

    // Same unit conversion
    public function testSameUnitConversion(): void
    {
        $this->assertEquals(25, convertTemperature(25, 'C', 'C'));
        $this->assertEquals(77, convertTemperature(77, 'F', 'F'));
        $this->assertEquals(300, convertTemperature(300, 'K', 'K'));
    }
}
