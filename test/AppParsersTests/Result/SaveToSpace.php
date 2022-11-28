<?php
declare(strict_types=1);

namespace AppParsersTests\Result;

use AppParsers\Entities\ObjectEntity;
use AppParsers\Parsers\Result\SaveTo;
use PHPUnit\Framework\TestCase;

class SaveToSpace extends TestCase implements SaveTo
{
    public function save(ObjectEntity $entity): void
    {
        /**
         * Send data in space for Elon Musk
         */
        $this->assertIsObject($entity);
        $this->assertNotEmpty($entity->getResultJson());
        $json = json_decode($entity->getResultJson());

        $this->assertEquals('2+1 Apartment in Alanya, Antalya, Turkey No. 60907', $json->name);
        $this->assertEquals('Alanya', $json->city);
        $this->assertEquals('2022', $json->completion_date);
        $this->assertEquals('nova-capitol-66875', $json->complex_slug);
        $this->assertEquals('€', $json->currency);
        $this->assertEquals('Описание объектаNova Property proudly presents its new project, Nova Capitol. It is located in one of the best areas of Alanya - Oba. Nova Capitol is our new high quality project. Its close to some important social sites such as private schools, hospital, shopping mall and the D400 main road, along with stunning sea and mountain views, makes it convenient for quick local accessibility. Designed by professional architects and experienced expert engineers, this project has been carefully planned considering the needs of a comfortable and enjoyable life. This wonderfully designed project, which consists of 2 blocks with a total of 36 flats. A total of 16 flats in A Block are about to be delivered on 30.03.2022 and consist of 4 2+1 Duplexes and 12 1+1 flats. - 1+1 Apartments are 60 m2. - 2+1 Duplex Apartments are 120 – 130 m2. Our 20 flats in the B Block will start to built on April 2022 and will be delivered on 30.03.2023. This project consists of 5 2+1 Duplexes, 13 1+1 and 2 2+1 Garden Duplexes. - 1+1 Apartments are 47 m2. - 2+1 Duplex Apartments are 90 – 102 m2 - 2+1 Garden Duplexes are 96 + 103 m2.', $json->description);
        $this->assertEquals('113 m2', $json->living_space);
        $this->assertEquals('60907', $json->object_number);
        $this->assertEquals('o60907', $json->object_slug);
        $this->assertEquals('18500000', $json->price);
        $this->assertEquals('2+1', $json->rooms);
        $this->assertEquals('Apartment', $json->type);
        $this->assertEquals('36.5489160921591', $json->map_coords->lat);
        $this->assertEquals('32.05607806428894', $json->map_coords->lng);
        $this->assertIsArray($json->images);

    }
}