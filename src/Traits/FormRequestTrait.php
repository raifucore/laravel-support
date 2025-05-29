<?php

namespace RaifuCore\Support\Traits;

use Illuminate\Foundation\Http\FormRequest;
use ReflectionClass;

trait FormRequestTrait
{
    public function fromFormRequest(FormRequest $request): self
    {
        $reflection = new ReflectionClass($this);

        foreach ($request->validated() as $field => $value) {
            if ($reflection->hasProperty($field)) {

                $reflectionProperty = $reflection->getProperty($field);
                $reflectionPropertyType = $reflectionProperty->getType();
                $reflectionPropertyTypeName = $reflectionPropertyType->getName();

                if (class_exists($reflectionPropertyTypeName)) {
                    if (enum_exists($reflectionPropertyTypeName)) {
                        $this->$field = $reflectionPropertyTypeName::tryFrom($value);
                    }
                } else {
                    $this->$field = $value;
                }
            }
        }

        return $this;
    }
}
