<?php

namespace App\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class ShowDTO extends DataTransferObject
{
    public int $id;
    public string $url;
    public string $name;
    public string $type;
    public string $language;

    /** @var string[] $genres */
    public array $genres;
    public string $status;
    public $runtime;
    public $averageRuntime;
    public $premiered;
    public $ended;
    public $officialSite;
    public $schedule;
    public $rating;
    public int $weight;
    public $network;
    public $webChannel;
    public $dvdCountry;
    public $externals;
    public $image;
    public string $summary;
    public int $updated;
    public $_links;
}
