<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class ShowListDTO extends DataTransferObject
{
    public float $score;
    public ShowDTO $show;
}
