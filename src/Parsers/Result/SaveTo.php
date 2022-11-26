<?php

namespace AppParsers\Parsers\Result;

use AppParsers\Entities\ObjectEntity;

interface SaveTo
{
    public function save(ObjectEntity $entity): void;
}