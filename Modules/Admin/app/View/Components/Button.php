<?php

namespace Modules\Admin\View\Components;

use Illuminate\Contracts\Support\Htmlable;
use Livewire\Component;

class Button extends Component implements Htmlable
{
    protected string $label;
    protected string $type;
    protected string $wireTarget;
    protected string $wireModel;
    protected string $color;
    protected array $attributese;
    public function __construct(
        protected string $name
    ) {
        //
    }

    public static function make(string $name)
    {
        return new self($name);
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function wireTarget(string $wireTarget): self
    {
        $this->wireTarget = $wireTarget;
        return $this;
    }

    public function wireModel(string $wireModel): self
    {
        $this->wireModel = $wireModel;
        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label ?? $this->name;
    }

    public function getType(): string
    {
        return $this->type ?? 'button';
    }

    public function getWireTarget(): string
    {
        return $this->wireTarget ?? '';
    }

    public function getWireModel(): string
    {
        return $this->wireModel ?? '';
    }

    public function getColor(): string
    {
        return $this->color ?? 'primary';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributes(): array
    {
        return $this->attributese ?? [];
    }

    public function attributes(array $attributes): self
    {
        $this->attributese = $attributes;
        return $this;
    }

    public function extractPublicMetods(): array
    {
        $methods = [];
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $methods[$method->getName()] = \Closure::fromCallable([$this, $method->getName()]);
        }
        return $methods;
    }

    public function render()
    {
        return view("admin::components.button", $this->extractPublicMetods());
    }

    public function toHtml()
    {
        return $this->render()->render();
    }
}
