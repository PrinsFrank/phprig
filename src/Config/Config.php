<?php declare(strict_types=1);

namespace PrinsFrank\PHPRIG\Config;

use JsonSerializable;

readonly class Config implements JsonSerializable {
    public function __construct(
        private ListOfStrings $paths,
    ) {}

    /** @return array{paths: ListOfStrings} */
    public function jsonSerialize(): array {
        return [
            'paths' => $this->paths,
        ];
    }
}
