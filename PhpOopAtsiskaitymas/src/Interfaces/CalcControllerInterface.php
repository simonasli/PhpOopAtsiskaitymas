<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Interfaces;

interface CalcControllerInterface
{

    public function enterData(): void;

    public function deleteEntry(): void;

    public function showData(): void;

    public function countAll(): void;

    public function finalPay(): void;
}
