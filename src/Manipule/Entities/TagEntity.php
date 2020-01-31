<?php

namespace Population\Manipule\Entities;

/**
 * Class TagEntity.
 *
 * @package Core\Entities
 */
final class TagEntity extends AbstractEntity
{
    private $id;
    private $value;

    /**
     * TagEntity constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (!is_null($attributes['id'])) {
            $this->setId($attributes['id']);
        }
        $this->setValue($attributes['value'] ?? null);
    }

    /**
     * @param int $id
     * @return $this
     */
    private function setId(int $id): TagEntity
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

    /**
     * @param string $value
     * @return $this
     */
    private function setValue(string $value): TagEntity
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'value' => $this->getValue(),
        ];
    }
}
