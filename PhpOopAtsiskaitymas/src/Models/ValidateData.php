<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Models;

use SimonasLinkis\PhpOopAtsiskaitymas\Exceptions\InputValidationException;
use SimonasLinkis\PhpOopAtsiskaitymas\Interfaces\ValidateDataInterface;

class ValidateData implements ValidateDataInterface
{
    public function validate(): array
    {
        $finalData = [];
        $newData = $_POST['data'];
        $arrayData = explode(' ', $newData);

        if (isset($arrayData[4])) {
            throw new InputValidationException
            ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą.");
        }

        if (isset($arrayData[0]) && is_numeric($arrayData[0])) {
            $finalData['amount'] = $arrayData[0];
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą.");

        if (isset($arrayData[1]) && is_numeric($arrayData[1])) {
            $finalData['price'] = $arrayData[1];
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą.");

        if (isset($arrayData[2]) && ($arrayData[2] === 'diena' || $arrayData[2] === 'naktis')) {
            $finalData['period'] = $arrayData[2];
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą.");

        if (isset($arrayData[3]) && is_numeric($arrayData[3]) && $arrayData[3] < 13
            && $arrayData[3] > 0) {
            if ($arrayData[3] + 1 < date('m')) {
                throw new InputValidationException
                ("Jūs vėluojate sumokėti mokesčius " . (date('m') - $arrayData[3] - 1) * 30 . " dienų. Patikslinkite ir bandykite dar kartą.");
            } elseif ($arrayData[3] + 1 > date('m')) {
                throw new InputValidationException
                ("Mokėjimas atliekamas per anksti. Patikslinkite ir bandykite dar kartą.");
            } else {
                $finalData['month'] = $arrayData[3];
            }
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą.");

        return $finalData;
    }
}
