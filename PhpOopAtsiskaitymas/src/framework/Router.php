<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Framework;

use SimonasLinkis\PhpOopAtsiskaitymas\Controllers\CalcController;

class Router
{
    public function __construct(private DIContainer $di)
    {
    }

    public function process(string $method): void
    {
        $controller = $this->di->get(CalcController::class);
        if ($method == 'POST') {
            if (isset($_POST['data'])) {
                $controller->enterData();
            }
        } elseif ($method == 'DELETE') {
            $controller->deleteEntry();
        } elseif ($method == 'COUNT') {
            $controller->countAll();
        } elseif ($method == 'PAY') {
            $controller->finalPay();
        } else {
            $controller->showData();
        }
    }
}
