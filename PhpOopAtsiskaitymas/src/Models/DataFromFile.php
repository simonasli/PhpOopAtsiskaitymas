<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Models;

use SimonasLinkis\PhpOopAtsiskaitymas\Interfaces\DataFromFileInterface;

class DataFromFile implements DataFromFileInterface
{
    public function fromFile(): array
    {
        $data = file_get_contents('./data.json');
        $dataArray = json_decode($data, true);
        if (is_array($dataArray) && sizeof($dataArray) > 0) {
            $output = $dataArray;
        } else {
            $output = [];
        }

        return $output;
    }
}
