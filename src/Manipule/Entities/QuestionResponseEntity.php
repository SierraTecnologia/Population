<?php

namespace Population\Manipule\Entities;


/**
 * Class QuestionResponseEntity.
 *
 * @package Core\Entities
 */
final class QuestionResponseEntity extends AbstractEntity
{
    private $id;
    private $coordinates;

    /**
     * QuestionResponseEntity constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (!is_null($attributes['id'])) {
            $this->setId($attributes['id']);
        }
    }

    /**
     * @param  int $id
     * @return $this
     */
    private function setId(int $id): QuestionResponseEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    // /**
    //  * @inheritdoc
    //  */
    // public function __toString(): string
    // {
    //     return (string) $this->getCoordinates();
    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function toArray(): array
    // {
    //     return [
    //         'id' => $this->getId(),
    //         'location' => $this->getLocation() ? $this->getLocation()->toArray() : null,
    //     ];
    // }
}
