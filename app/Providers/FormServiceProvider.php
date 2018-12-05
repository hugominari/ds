<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	    \Form::component('cToggle', 'components.forms.toggle',              ['name', 'value' => null, 'label' => '', 'checked' => null, 'type' => 'list', 'attributes' => []]);
	    \Form::component('cCheckbox', 'components.forms.checkbox',          ['name', 'value' => null, 'label' => '', 'checked' => null, 'type' => 'list', 'attributes' => [], 'help' => null]);
	    \Form::component('cRadio', 'components.forms.radio',                ['name', 'value' => null, 'label' => '', 'checked' => null, 'type' => 'list', 'attributes' => [], 'help' => null]);
        \Form::component('cSelect', 'components.forms.select',              ['name', 'selected' => null, 'label' => '', 'list' => [], 'attributes' => [], 'help' => null, 'optAtributtes' => [], 'optGroupsAttributes' => []]);

	    \Form::component('cCell', 'components.forms.cell',                  ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cMail', 'components.forms.email',                 ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
        \Form::component('cMoney', 'components.forms.money',                ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
        \Form::component('cNumber', 'components.forms.number',              ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
        \Form::component('cLetter', 'components.forms.letter',              ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
        \Form::component('cPassword', 'components.forms.password',          ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
        \Form::component('cPhone', 'components.forms.phone',                ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
        \Form::component('cPercent', 'components.forms.percent',            ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cText', 'components.forms.text',                  ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cTextarea', 'components.forms.textarea',          ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cTextareaSend', 'components.forms.textarea-sender',   ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    
	    \Form::component('cDropzone', 'components.forms.dropzone',          ['name', 'value' => [], 'label' => '', 'maxFile' => 1, 'message' => 'Clique para escolher ou arraste um arquivo.', 'extraClass' => null, 'accept' => 'image/*', 'maxSize' => 2]);
	    \Form::component('cDropzoneCrop', 'components.forms.dropzonecrop',  ['name', 'value' => [], 'label' => '', 'maxFile' => 1, 'message' => 'Clique para escolher ou arraste um arquivo.', 'extraClass' => null, 'accept' => 'image/*', 'maxSize' => 2]);
	
	    //Verify later
	    \Form::component('cColor', 'components.forms.color',                ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cDate', 'components.forms.date',                  ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cDateInline', 'components.forms.date-inline',     ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cDatetime', 'components.forms.datetime',          ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
	    \Form::component('cTime', 'components.forms.time',                  ['name', 'value' => null, 'label' => '', 'attributes' => [], 'help' => null]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
