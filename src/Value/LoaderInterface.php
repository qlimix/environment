<?php declare(strict_types=1);

namespace Qlimix\Environment\Value;

use Qlimix\Environment\Value\Exception\LoaderException;

interface LoaderInterface
{
    /**
     * @throws LoaderException
     */
    public function getString(string $name): string;

    /**
     * @throws LoaderException
     */
    public function getInt(string $name): int;

    /**
     * @throws LoaderException
     */
    public function getFloat(string $name): float;

    /**
     * @throws LoaderException
     */
    public function getBoolean(string $name): bool;

    /**
     * @return string[]
     *
     * @throws LoaderException
     */
    public function getArray(string $name, string $delimiter): array;

    /**
     * @return mixed
     *
     * @throws LoaderException
     */
    public function getMapped(string $name, callable $map);
}
