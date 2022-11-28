<?php
declare(strict_types=1);

namespace AppParsers\Entities;

use AppParsers\Entities\MapEntity;

class ObjectEntity
{
    private ?string $name = null;
    private ?string $object_number = null;
    private ?string $object_slug = null;
    private ?string $complex_slug = null;
    private ?string $city = null;
    private ?string $type = null;
    private ?string $rooms = null;
    private ?string $living_space = null;
    private ?string $completion_date = null;
    private ?string $price = null;
    private ?string $currency = null;
    private array $images = [];
    private ?string $description = null;
    private array $features = [];
    private MapEntity $map_coords;

    /**
     * @param array $map_coords
     */
    public function setMapCoords(MapEntity $map_coords): void
    {
        $this->map_coords = $map_coords;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $object_number
     */
    public function setObjectNumber(string $object_number): void
    {
        $this->object_number = $object_number;
    }

    /**
     * @param string $object_slug
     */
    public function setObjectSlug(string $object_slug): void
    {
        $this->object_slug = $object_slug;
    }

    /**
     * @return string|null
     */
    public function getObjectSlug(): ?string
    {
        return $this->object_slug;
    }

    /**
     * @param string $complex_slug
     */
    public function setComplexSlug(string $complex_slug): void
    {
        $this->complex_slug = $complex_slug;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param string $rooms
     */
    public function setRooms(string $rooms): void
    {
        $this->rooms = $rooms;
    }

    /**
     * @param string $living_space
     */
    public function setLivingSpace(string $living_space): void
    {
        $this->living_space = $living_space;
    }

    /**
     * @param string $completion_date
     */
    public function setCompletionDate(string $completion_date): void
    {
        $this->completion_date = $completion_date;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param FeaturesEntity $features
     * @return void
     */
    public function setFeatures(FeaturesEntity $features): void
    {
        $this->features[] = $features;
    }

    /**
     * @return false|string
     */
    public function getResultJson(): string
    {
        $result['name'] = $this->name;
        $result['object_number'] = $this->object_number;
        $result['object_slug'] = $this->object_slug;
        $result['complex_slug'] = $this->complex_slug;
        $result['city'] = $this->city;
        $result['type'] = $this->type;
        $result['rooms'] = $this->rooms;
        $result['living_space'] = $this->living_space;
        $result['completion_date'] = $this->completion_date;
        $result['price'] = $this->price;
        $result['currency'] = $this->currency;
        $result['images'] = $this->images;
        $result['description'] = $this->description;

        /**
         * @var FeaturesEntity $feature
         */
        foreach ($this->features as $feature){
            $result['features'][] = [
               'name' => $feature->getName(),
               'list' => $feature->getList()
            ];
        }
        $result['map_coords'] = [
           'lat' => $this->map_coords->getLat(),
           'lng' => $this->map_coords->getLng(),
        ];
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}