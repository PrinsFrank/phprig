<?php declare(strict_types=1);

namespace PrinsFrank\PHPRIG\Config;

use JsonSerializable;

readonly class ListOfStrings implements JsonSerializable {
    /** @var string[] */
    public array $value;

    public function __construct(
        string ... $string,
    ){
        $this->value = $string;
    }

    /** @return list<string> */
    public function jsonSerialize(): array {
        return $this->value;
    }
}