<?php namespace Mcore\DatalistWidget\FormWidgets;

use Arr;
use Backend\Classes\FormWidgetBase;

/**
 * Datalist Form Widget
 *
 * @link https://docs.octobercms.com/3.x/extend/forms/form-widgets.html
 */
class Datalist extends FormWidgetBase
{
    protected $defaultAlias = 'datalist';

    public $options = [];
    public $useOptionKey = false;
    public $useGroups = false;
    public $useGroupKey = false;
    public $maxItems = 5;

    public function init()
    {
        $this->fillFromConfig([
            'options',
            'useOptionKey',
            'useGroupKey',
            'maxItems',
        ]);
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('datalist');
    }

    public function prepareVars()
    {

        $this->vars['field'] = $this->formField;
        $this->vars['name'] = $this->formField->getName();
        
        $options = $this->getLoadOptions();
        
        $this->vars['useGroups'] = $this->isMultiArrayOptions($options);

        $this->vars['options'] = $options;

        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['useOptionKey'] = $this->useOptionKey;
        $this->vars['useGroupKey'] = $this->useGroupKey;
        $this->vars['maxItems'] = $this->maxItems;
    }

    protected function isMultiArrayOptions($options)
    {
        return Arr::isAssoc($options) && is_array($options[array_keys($options)[0]]);
    }

    public function getLoadOptions()
    {
        $options = $this->options;

        $optionsMethod = $this->formField->config['optionsMethod'] ?? null;
        if ($optionsMethod && method_exists($this->model, $optionsMethod)) {
            return $this->model->$optionsMethod();
        }

        return $options;
    }

    public function loadAssets()
    {
        $this->addCss('css/datalist.css');
        $this->addJs('js/datalist.js?t='.time());
    }

    public function getSaveValue($value)
    {
        return $value;
    }
}
