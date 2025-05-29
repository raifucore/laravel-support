<?php

namespace RaifuCore\Support\Dto;

use Illuminate\Foundation\Http\FormRequest;
use RaifuCore\Support\Helpers\StringHelper;

class FilterDto
{
    protected int $total = 0;
	protected array $fields = [];

	public function __construct(array|FormRequest $params = [])
	{
        $this->_fillFromArray(is_array($params) ? $params : $params->all());
	}

	public function setTotal(int $total): self
    {
		$this->total = $total;
		return $this;
	}

	public function getTotal(): int
    {
		return $this->total;
	}

	public function showResult(): string
    {
		return $this->total . ' ' . StringHelper::getPlural(
            $this->total,
            __('raifucore::filter.units.one'),
            __('raifucore::filter.units.few'),
            __('raifucore::filter.units.many')
        );
	}

	public function set(string $name, mixed $value): self
    {
		$this->fields[$name] = $value;
		return $this;
	}

	public function delete($name): static
    {
		if (isset($this->fields[$name])) {
            unset($this->fields[$name]);
        }
		return $this;
	}

	public function get(string $name, $default = null)
	{
		return $this->fields[$name] ?? $default;
	}

	public function has($name): bool
    {
		return array_key_exists($name, $this->fields);
	}

	public function hash(): string
    {
		return md5($this->toJson());
	}

	public function toJson(): string
    {
		$fields = $this->fields ?: [];
		ksort($fields);
		return json_encode($fields, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function toArray(): array
    {
		return $this->fields;
	}

    private function _fillFromArray(array $params = []): void
    {
        foreach ($params as $field => $mixedValue) {

            if (is_null($mixedValue)) {
                continue;
            }

            switch ($field) {
                case 'since':
                case 'until':
                    $this->set($field, date('Y-m-d', strtotime($mixedValue)));
                    break;

                case 'order':
                    $parts = explode('_', $mixedValue);
                    $oField = $parts[0] ?? null;
                    $oDirection = $parts[1] ?? 'asc';
                    $this->set('order', ['field' => $oField, 'direction' => $oDirection]);
                    break;

                default:
                    $this->set($field, $mixedValue);
                    break;
            }
        }
    }
}
