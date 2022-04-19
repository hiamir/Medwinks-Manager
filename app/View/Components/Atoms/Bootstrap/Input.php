<?php

namespace App\View\Components\Atoms\Bootstrap;

use App\Traits\Quicker;
use Illuminate\View\Component;

class Input extends Component
{
    public
        $id,
        $name,
        $size = 'normal',
        $container,
        $type,
        $icon,
        $iconLeft,
        $iconRight,
        $iconLeftFunction,
        $iconRightFunction,
        $inputClass,
        $lazy = false,
        $defer = true,
        $debounce,
        $label,
        $placeholder,
        $value,
        $custom,
        $class,
        $reference,
        $showError,
        $configDate,
        $configFile;


    use Quicker;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($configFile='',$configDate='',$reference = '', $inputClass = '', $icon = '', $iconLeft = '', $iconRight = '', $iconLeftFunction = '', $iconRightFunction = '', $showError = true, $id = null, $name = null, $type = null, $container = null, $placeholder = null, $size = null, $label = null, $lazy = null, $defer = null,
                                $debounce = null, $value = null, $custom = null, $class = null)
    {
        if ($id === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('id'), 'error');
        } elseif ($name === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('name'), 'error');
        } elseif ($class === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('class'), 'error');
        } elseif ($type === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('type'), 'error');
        } elseif ($container === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('container'), 'error');
        } elseif ($placeholder === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('placeholder'), 'error');
        } elseif ($size === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('size'), 'error');
        } elseif ($label === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('label'), 'error');

        } elseif ($type === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('type'), 'error');
        } elseif ($defer === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('defer'), 'error');
        } elseif ($debounce === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('debounce'), 'error');
        } elseif ($value === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('value'), 'error');
        } elseif ($custom === null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'), $this->sweetAlertComponentMessage('custom'), 'error');
        } else {


            $this->id = $id;
            $this->name = $name;
            $this->size = $size;
            $this->icon = $icon;
            $this->iconLeft = $iconLeft;
            $this->iconRight = $iconRight;
            $this->iconLeftFunction = $iconLeftFunction;
            $this->iconRightFunction = $iconRightFunction;
            $this->container = $container;
            $this->label = $label;
            $this->lazy = $lazy;
            $this->defer = $defer;
            $this->debounce = $debounce;
            $this->type = $type;
            $this->inputClass = $inputClass;
            $this->placeholder = $placeholder;
            $this->value = $value;
            $this->showError = $showError;
            $this->reference = $reference;
            $this->configDate=$configDate;
            $this->configFile=$configFile;
            $this->custom = $custom;

            ($class == '') ? $this->class = "p-0 mb-4" : $this->class = $class;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.input');
    }
}
