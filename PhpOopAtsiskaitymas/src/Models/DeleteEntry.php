<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Models;

use SimonasLinkis\PhpOopAtsiskaitymas\Framework\DIContainer;
use SimonasLinkis\PhpOopAtsiskaitymas\Interfaces\DeleteEntryInterface;

class DeleteEntry implements DeleteEntryInterface
{
    public function __construct(private DIContainer $di)
    {
    }

    public function deleteEntry(): void
    {
        $data = $this->di->get(DataFromFile::class);
        $dataArray = $data->fromFile();
        $myID = $_POST['delete'];
        if (key_exists($myID, $dataArray)) {
            unset($dataArray[$myID]);
            $serializedData[] = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $serializedData);
        }
    }
}
