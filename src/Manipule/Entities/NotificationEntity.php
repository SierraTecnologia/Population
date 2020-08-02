<?php

namespace Population\Manipule\Entities;

/**
 * Class NotificationEntity.
 *
 * @package Core\Entities
 */
final class NotificationEntity extends AbstractEntity
{
    private $id;
    private $value;

    /**
     * NotificationEntity constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (!is_null($attributes['id'])) {
            $this->setId($attributes['id']);
        }
        if (!is_null($attributes['value'])) {
            $this->setValue($attributes['value']);
        }
    }

    /**
     * @param  int $id
     * @return $this
     */
    private function setId(int $id): NotificationEntity
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
     * @param  string $value
     * @return $this
     */
    private function setValue(string $value): NotificationEntity
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
