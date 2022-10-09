<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Controllers;

use SimonasLinkis\PhpOopAtsiskaitymas\Exceptions\InputValidationException;
use SimonasLinkis\PhpOopAtsiskaitymas\Framework\DIContainer;
use SimonasLinkis\PhpOopAtsiskaitymas\Interfaces\CalcControllerInterface;
use SimonasLinkis\PhpOopAtsiskaitymas\Models\CalcAll;
use SimonasLinkis\PhpOopAtsiskaitymas\Models\DataFromFile;
use SimonasLinkis\PhpOopAtsiskaitymas\Models\DataToFile;
use SimonasLinkis\PhpOopAtsiskaitymas\Models\DeleteEntry;
use SimonasLinkis\PhpOopAtsiskaitymas\Models\Pay;
use SimonasLinkis\PhpOopAtsiskaitymas\Models\ValidateData;

class CalcController implements CalcControllerInterface
{
    public function __construct(private DIContainer $di)
    {
    }

    public function enterData(): void
    {
        $enterData = $this->di->get(DataToFile::class);
        $validateData = $this->di->get(ValidateData::class);
        try {
            $dataToWrite = $validateData->validate();
            $enterData->toFile($dataToWrite);
        } catch (InputValidationException $exception) {
            $exception->getMessage();
        }
        $getData = $this->di->get(DataFromFile::class);
        $data = $getData->fromFile();

        require 'view/Calculator/index.php';
    }

    public function deleteEntry(): void
    {
        $delete = $this->di->get(DeleteEntry::class);
        $delete->deleteEntry();
        $this->showData();
    }

    public function showData(): void
    {
        $getData = $this->di->get(DataFromFile::class);
        $data = $getData->fromFile();

        require 'view/Calculator/index.php';
    }

    public function countAll(): void
    {
        $count = $this->di->get(CalcAll::class);
        $sums = $count->calc();
        $getData = $this->di->get(DataFromFile::class);
        $data = $getData->fromFile();

        require 'view/Calculator/index.php';
    }

    public function finalPay(): void
    {
        $count = $this->di->get(CalcAll::class);
        $sums = $count->calc();
        $final = $this->di->get(Pay::class);
        if (isset($sums) && !empty($sums)) {
            try {
                $pay = $final->pay();
            } catch (InputValidationException $exception) {
                $exception->getMessage();
            }
        }

        require 'view/Calculator/index.php';
    }
}
