<?php
declare(strict_types=1);

namespace AppParsers\Entities;

class FeaturesEntity
{
    private string $name;
    private array $list = [];

    /**
     * @param $name
     * @param array $list
     */
    public function __construct(string $name, array $list)
    {
        $this->name = $name;
        $this->list = $list;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }


}