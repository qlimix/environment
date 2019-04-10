<?php declare(strict_types=1);

namespace Qlimix\Tests\Environment;

use PHPUnit\Framework\TestCase;
use Qlimix\Environment\Environment;

final class EnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function shouldEqualDevelopmentEnvironment(): void
    {
        $env = Environment::createDevelopment();

        $this->assertTrue($env->equals(Environment::createDevelopment()));
    }

    /**
     * @test
     */
    public function shouldNotEqualDevelopmentEnvironment(): void
    {
        $env = Environment::createDevelopment();

        $this->assertFalse($env->equals(Environment::createProduction()));
    }

    /**
     * @test
     */
    public function shouldEqualProductionEnvironment(): void
    {
        $env = Environment::createProduction();

        $this->assertTrue($env->equals(Environment::createProduction()));
    }

    /**
     * @test
     */
    public function shouldNotEqualProductionEnvironment(): void
    {
        $env = Environment::createProduction();

        $this->assertFalse($env->equals(Environment::createDevelopment()));
    }

    /**
     * @test
     */
    public function shouldEqualRandomEnvironment(): void
    {
        $env = new Environment('random');
        $env2 = new Environment('random');

        $this->assertTrue($env->equals($env2));
    }

    /**
     * @test
     */
    public function shouldNotEqualRandomEnvironment(): void
    {
        $env = new Environment('random');

        $this->assertFalse($env->equals(Environment::createDevelopment()));
    }
}
