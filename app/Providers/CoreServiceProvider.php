<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Collective\Html\FormFacade as Form;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCompnnentViews();
    }

    public function registerCompnnentViews(){
        Form::component('bsImageThumb', 'components.form.image-thumb', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsNumber', 'components.form.number', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsEmail', 'components.form.email', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsText', 'components.form.text', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsPrice', 'components.form.price', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsLink', 'components.form.link', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsTextarea', 'components.form.textarea', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsEditor', 'components.form.editor', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsEditorDescription', 'components.form.description', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsSelect', 'components.form.select', ['title', 'name', 'value', 'list', 'attributes' => [], 'required']);
        Form::component('bsLanguage', 'components.form.language', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsImage', 'components.form.image', ['title', 'name', 'value', 'size', 'required']);
        Form::component('bsGallery', 'components.form.gallery', ['title', 'name', 'gallerys', 'size', 'required']);
        Form::component('bsDate', 'components.form.date', ['title', 'name', 'value', 'required', 'day']);
        Form::component('bsTag', 'components.form.tag', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsPost', 'components.form.post', ['title', 'name', 'value', 'attributes' => [], 'required']);
        Form::component('bsCustomer', 'components.form.customer', ['title', 'name', 'value', 'attributes' => [], 'required']);
    }
}