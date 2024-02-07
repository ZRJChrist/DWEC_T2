<?php

namespace App\Enums;

enum PolizaEnums: string
{
    case C = 'Cobrada';
    case P = 'Prepadado';
    case L = 'Liquidada';
    case A = 'Anulada';
    case N = 'PreAnulada';
}
