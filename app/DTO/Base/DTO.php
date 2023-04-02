<?php
namespace App\DTO\Base;

use ReflectionClass;

abstract class DTO
{
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Fill property for given attributes
     */
    public function fill(array $attributes = [])
    {
        // get properties list of class
        foreach($this->getAttributes() as $property)
        {
            // check if property is not inside DTO Abstraction
            if($property->class !== DTO::class) {
                // assign property to the fill attribute
                $this->{$property->name} = $attributes[$property->name] ?? null;
            }
        }
    }

    /**
     * Get attributes of DTO Object
     */
    protected function getAttributes(): array
    {
        // get reflaction of object class
        $reflector = new ReflectionClass($this);

        return $reflector->getProperties();
    }

    /**
     * Get DTO Attribute to array
     */
    public function toArray(): array
    {
        $array = [];
        foreach($this->getAttributes() as $attribute)
        {
            $array[$attribute->name] = $this->{$attribute->name};
        }

        return $array;
    }
}