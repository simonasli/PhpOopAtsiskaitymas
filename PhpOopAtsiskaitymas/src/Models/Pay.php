<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Models;

use SimonasLinkis\PhpOopAtsiskaitymas\Exceptions\InputValidationException;
use SimonasLinkis\PhpOopAtsiskaitymas\Framework\DIContainer;
use SimonasLinkis\PhpOopAtsiskaitymas\Interfaces\PayInterface;

class Pay implements PayInterface
{
    public function __construct(private DIContainer $di)
    {
    }

    public function pay(): float
    {
        $count = $this->di->get(CalcAll::class);
        $sums = $count->calc();
        $pay = 0;
        if (sizeof($sums) > 0) {
            $sumArr = $this->di->get(CalcAll::class);
            $sums = $sumArr->calc();
            $pay = $sums['suma'];
            $dataArray = [];
            $serializedData[] = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $serializedData);
        } else throw new InputValidationException
        ("Prieš mokėdami turite suskaičiuoti bendrą kainą");

        return $pay;
    }
}
