<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Models;

use SimonasLinkis\PhpOopAtsiskaitymas\Framework\DIContainer;
use SimonasLinkis\PhpOopAtsiskaitymas\Interfaces\CalcAllInterface;

class CalcAll implements CalcAllInterface
{
    public function __construct(private DIContainer $di)
    {
    }

    public function calc(): array
    {
        $output = ['diena' => 0,
            'naktis' => 0,
            'suma' => 0];
        $data = $this->di->get(DataFromFile::class);
        $dataArray = $data->fromFile();
        foreach ($dataArray as $value) {
            if ($value['period'] === 'diena') {
                $output['diena'] += $value['amount'] * $value['price'];
            }
            if ($value['period'] === 'naktis') {
                $output['naktis'] += $value['amount'] * $value['price'];
            }
        }
        $output['suma'] = $output['naktis'] + $output['diena'];

        return $output;
    }
}
