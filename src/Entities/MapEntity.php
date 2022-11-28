<?php
declare(strict_types=1);

namespace AppParsers\Entities;

class MapEntity
{
    private ?string $lat;
    private ?string $lng;

    /**
     * @param string $lat
     * @param string $lng
     */
    public function __construct(string $lat, string $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLng(): string
    {
        return $this->lng;
    }

}