<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Interfaces;

interface DataToFileInterface
{
    public function toFile(array $validatedData): void;
}