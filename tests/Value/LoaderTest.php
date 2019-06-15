<?php declare(strict_types=1);

namespace Qlimix\Tests\Environment\Value;

use PHPUnit\Framework\TestCase;
use Qlimix\Environment\Value\Exception\LoaderException;
use Qlimix\Environment\Value\Loader;

final class LoaderTest extends TestCase
{
    /** @var Loader */
    private $loader;

    public function setUp(): void
    {
        $this->loader = new Loader();
    }

    /**
     * @test
     */
    public function shouldGetStringValue(): void
    {
        putenv('FOO=bar');

        $foo = $this->loader->getString('FOO');

        $this->assertSame('bar', $foo);
    }

    /**
     * @test
     */
    public function shouldThrowOnGetStringValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getString('RANDOM_XYZ');
    }

    /**
     * @test
     */
    public function shouldGetIntValue(): void
    {
        putenv('FOO=1');

        $foo = $this->loader->getInt('FOO');

        $this->assertSame(1, $foo);
    }

    /**
     * @test
     */
    public function shouldThrowOnGetIntValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getInt('RANDOM_XYZ');
    }

    /**
     * @test
     */
    public function shouldThrowOnNoneNumericIntValue(): void
    {
        putenv('FOO=A');

        $this->expectException(LoaderException::class);

        $this->loader->getInt('FOO');
    }

    /**
     * @test
     */
    public function shouldGetFloatValue(): void
    {
        putenv('FOO=1.2');

        $foo = $this->loader->getFloat('FOO');

        $this->assertSame(1.2, $foo);
    }

    /**
     * @test
     */
    public function shouldThrowOnGetFloatValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getFloat('RANDOM_XYZ');
    }

    /**
     * @test
     */
    public function shouldThrowOnNoneNumericFloatValue(): void
    {
        putenv('FOO=A');

        $this->expectException(LoaderException::class);

        $this->loader->getFloat('FOO');
    }

    /**
     * @test
     */
    public function shouldGetArrayValue(): void
    {
        putenv('FOO=foo,bar,foobar');

        $foo = $this->loader->getArray('FOO', ',');

        $this->assertSame(['foo', 'bar', 'foobar'], $foo);
    }

    /**
     * @test
     */
    public function shouldThrowOnGetArrayValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getArray('RANDOM_XYZ', ',');
    }

    /**
     * @test
     */
    public function shouldThrowOnEmptyValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getArray('FOO', '');
    }

    /**
     * @test
     */
    public function shouldThrowOnFalseExplodeValue(): void
    {
        putenv('FOO=,');

        $this->expectException(LoaderException::class);

        $this->loader->getArray('FOO', '');
    }

    /**
     * @test
     */
    public function shouldGetBooleanValue(): void
    {
        putenv('FOO=true');
        putenv('BAR=1');
        putenv('FOOZ=false');
        putenv('BARZ=0');

        $foo = $this->loader->getBoolean('FOO');
        $bar = $this->loader->getBoolean('BAR');
        $fooz = $this->loader->getBoolean('FOOZ');
        $barz = $this->loader->getBoolean('BARZ');

        $this->assertTrue($foo);
        $this->assertTrue($bar);
        $this->assertFalse($fooz);
        $this->assertFalse($barz);
    }

    /**
     * @test
     */
    public function shouldThrowOnGetBooleanValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getBoolean('RANDOM_XYZ');
    }

    /**
     * @test
     */
    public function shouldThrowOnNoneBooleanValue(): void
    {
        putenv('FOO=A');

        $this->expectException(LoaderException::class);

        $this->loader->getBoolean('FOO');
    }

    /**
     * @test
     */
    public function shouldGetMappedValue(): void
    {
        $envFoo = 'test_foo_1234567890=.[]';
        putenv('FOO='.base64_encode($envFoo));

        $foo = $this->loader->getMapped('FOO', static function ($value): string {
            return base64_decode($value);
        });

        $this->assertSame($foo, $envFoo);
    }

    /**
     * @test
     */
    public function shouldThrowOnGetMappedValue(): void
    {
        $this->expectException(LoaderException::class);

        $this->loader->getMapped('RANDOM_XYZ', static function ($value): string {
            return base64_decode($value);
        });
    }
}
