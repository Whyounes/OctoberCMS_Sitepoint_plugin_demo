<?php namespace Rafie\SitepointDemo\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * UniqueValue Form Widget
 */
class UniqueValue extends FormWidgetBase
{
    /*
     * Config attributes
     */
    protected $modelClass = null;
    protected $selectFrom = 'name';
    protected $pattern = 'text';

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'rafie_sitepointDemo_uniquevalue';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'modelClass',
            'selectFrom',
            'pattern'
        ]);
        $this->assertModelClass();

        parent::init();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('uniquevalue');
    }

    public function onChange()
    {
        $formFieldValue = post($this->formField->getName());
        $modelRecords = call_user_func_array("{$this->modelClass}::where", [$this->selectFrom, $formFieldValue]);
        
        return ['exists' => (boolean) $modelRecords->count()];
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['inputType'] = $this->pattern;
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    protected function assertModelClass()
    {
        if( !isset($this->modelClass) || !class_exists($this->modelClass) )
        {
            throw new \InvalidArgumentException(sprintf("Model class {%s} not found.", $this->modelClass));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/uniquevalue.css', 'rafie.SitepointDemo');
        $this->addJs('js/uniquevalue.js', 'rafie.SitepointDemo');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
