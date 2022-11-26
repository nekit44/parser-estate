<?php
declare(strict_types=1);

namespace AppParsers\Parsers\Result;

use AppParsers\Entities\ObjectEntity;

class SaveToJson implements SaveTo
{
    const DIR = __DIR__ . '/../../../result/';

    public function save(ObjectEntity $entity): void
    {
        if (!file_exists(self::DIR)) {
            mkdir(self::DIR, 0755, true);
        }
        file_put_contents(self::DIR . $entity->getObjectSlug() . '.json', $entity->getResultJson());
    }
}