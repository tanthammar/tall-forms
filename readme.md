# Laravel TALL-stack Forms

![Laravel Livewire Forms](https://i.imgur.com/YB0gEJ8.gif)

A dynamic, responsive [Laravel Livewire](https://laravel-livewire.com) form component with realtime validation, file uploads, array fields, and more.

- [Support](https://github.com/kdion4891/laravel-livewire-forms/issues)
- [Contributions](https://github.com/kdion4891/laravel-livewire-forms/pulls)
- [Buy me a coffee](https://paypal.me/kjjdion)

# WARNING, this documentation is not up to date. 
If you want to use it, please check the source code for all (not yet documented) features.

# Status
The package is in development, it is being used in a live project without issues but please test thoroughly in your project.

# Help wanted
If you like this package, please help me with the documentation and tests. Send me a PM.

### Requirements

- Make sure you've [installed Laravel Livewire](https://laravel-livewire.com/docs/installation/).
- Install [Tailwind UI](https://tailwindui.com/) or [Tailwind CSS](https://tailwindcss.com/) + [Form plugin](https://tailwindcss-custom-forms.netlify.app/)
- This package also uses [Blade UI kit - blade-icons](https://github.com/blade-ui-kit/blade-icons). Follow the package installation instructions.

## Looking for a Bootstrap CSS version?:
If you want to use Bootstrap CSS you can use the package made by kdion4891, which this package is based on. 
- [https://github.com/kdion4891/laravel-livewire-forms](https://github.com/kdion4891/laravel-livewire-forms)

## Credits

- [kdion4891](https://github.com/kdion4891)

# Installation
Installing this package via composer:

    composer require tanthammar/tall-forms
    

You'll need to add `@stack('scripts')`, `@livewireScripts`, and `@livewireStyles` blade directives to your `resources/views/layouts/app.blade.php` file:

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
    
    ...

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
    @stack('scripts')




# Making Form Components

Using the `make` command:

    php artisan make:tall-form UserCreateForm --model=User --path=App/

That command would create a new form component in `app/Http/Livewire/App` folder.

After making a component, you may want to edit the `fields`, `success`, `saveAndStayResponse` and `saveAndGoBackResponse` methods:

    class UserCreateForm extends FormComponent
    {
        public function fields()
        {
            return [
                Field::make('Name')->input()->rules('required'),
            ];
        }
    
        public function success()
        {
            User::create($this->form_data);
        }
    
        public function saveAndStayResponse()
        {
            return redirect()->route('users.create');
        }
    
        public function saveAndGoBackResponse()
        {
            return back();
        }
    }
    
You don't have to use the `render()` method in your form component or worry about a component view, because the package handles that automatically.

**Protip: you can add the `FillsColumns` trait to your model for automatic `$fillable`s via database column names.**

# Using Form Components

You use form components in views just like any other Livewire component:

    @livewire('user-create-form')

Now all you have to do is update your form component class!

# "SPA" mode with Route::livewire
You can use [Livewire route registration](https://laravel-livewire.com/docs/rendering-components#route-registration) to directly return a component and benefit from Laravel route model binding.
Doing so, you can skip the step to create a laravel blade view. **No render method is needed.**


### For this feature to work;
- Livewire assumes you have a layout stored in `resources/views/layouts/app.blade.php` that yields a "content" section `@yield('content')` 
- A laravel 7 Blade component: `pages/default.php` with a default `{$slot}`. It will be used as `<x-pages.default />`.
```
// Route
Route::livewire('/users/edit/{$user}', 'users.edit');
```

Users/Edit.php
```
use App\User;

//override the tall-form components mount method
    public function mount(User $user, $action = 'update', $showDelete = false)
    {
        $this->model = $user;
        $this->beforeFormProperties();
        $this->setFormProperties($user);
        $this->action = $action;
        $this->showDelete = $showDelete;
        $this->spaMode = true;
        $this->setup();
        $this->previous = \URL::previous();  //used for saveAndGoBack
    }

```

### "SPA" mode without route
Simply setting the property `spaMode` to true will wrap your form with `<x-pages.default />`. Don't forget to create the blade component.
```
$this->spaMode = true;
```

# Icons
Publish the config file and set the path and name for the array field icons (used with Blade UI package).

# Form Component Properties

### `$model`

Optional [Eloquent](https://laravel.com/docs/master/eloquent) model instance attached to the form component. This is passed in via the `@livewire` blade directive.

Example:

    @livewire('user-edit-form', ['model' => $user])
    
Example of using the model in the component `success` method:

    public function success()
    {
        $this->model->update($this->form_data);
    }
    
### `$form_data`

An array of the current data present in the form. This data is keyed with each field name.

Example:

    $name = $this->form_data['name'];
    
### `$storage_disk`

A static property which sets the disk to use for file uploads. Defaults to `public`.

Example:

    private static $storage_disk = 's3';
    
Or, via `.env` to apply globally:

    FORM_STORAGE_DISK="s3"
    
### `$storage_path`

A static property which sets the path to use for file uploads. Defaults to `uploads`.

Example:

    private static $storage_path = 'avatars';
    
Or, via `.env` to apply globally:

    FORM_STORAGE_PATH="avatars"
    
# Form Component Methods

### `beforeFormProperties()`
Executes before form_data is set. Example:
```php
public function beforeFormProperties()
{
    $condition = true;
    if (!$condition) {
      session()->flash('negative', 'The condition is required!');
      return redirect(route('some_route'));
    } else {
        $this->model->some_prop = true;
    }
}
```

### `setup()`
Executes after form_data is set. Example:
```php
    public function setup() {
        Gate::authorize('edit user');
        $this->fill([
            'formTitle' => trans('global.edit') . ' ' . trans('user.title_singular'),
            'action' => 'update', //or create,
            'showGoBack' => false,
        ]);
    }
```

### `fields()`

This method returns an array of `Field`s to use in the form.

Example:
```php
public function fields()
    {
        return [
            Field::make('Name')->input()->rules('required'),
            Field::make('Email')->input('email')->rules(['required', 'email', 'unique:users,email']),
            Field::make('Password')->input('password')->rules(['required', 'min:8', 'confirmed']),
            Field::make('Confirm Password', 'password_confirmation')->input('password'),
        ];
    }
```

Declaring `Field`s is similar to declaring Laravel Nova fields. [Jump to the field declaration section](#form-field-declaration) to learn more.

### `rulesIgnoreRealtime()`

This method is used to set rules to ignore during realtime validation.

Example:

    public function rulesIgnoreRealtime()
    {
        return ['confirmed', new MyCustomRule];
    }
    
### `success()`

This method defines what actions should take place when the form is successfully submitted and validation has passed.

Example:

    public function success()
    {
        $this->form_data['password'] = Hash::make($this->form_data['password']);

        User::create($this->form_data);
    }
    
### `saveAndStayResponse()`

This method defines the response after successful submission via the `Save` button.

Example:

    public function saveAndStayResponse()
    {
        return redirect()->route('users.edit', $this->model->id);
    }
    
### `saveAndGoBackResponse()`

This method defines the response after successful submission via the `Save & Go Back` button. By default it uses a version of `redirect()->back()`. See the source code.

Example:

    public function saveAndGoBackResponse()
    {
        return redirect()->route('users.index');
    }
    
### `mount($model = null)`

This method sets the initial form properties. If you have to override it, be sure to call `$this->setFormProperties()`.

##### `$model`

The model instance passed to the form component.

Example:

    public function mount($model = null)
    {
        $this->setFormProperties();
        
        // my custom code
    }

### `render()`

This method renders the form component view. If you have to override it, be sure to `return $this->formView()`.

Example:

    public function render()
    {
        // my custom code
        
        return $this->formView();
    }

# Form Field Declaration

The `Field` class is used to declare your form fields.

    public function fields()
    {
        $brand_options = Brand::orderBy('name')->get()->pluck('id', 'name')->all();

        return [
            Field::make('Brand', 'brand_id')->select($brand_options)->help('Please select a brand.'),
            Field::make('Name')->input()->rules(['required', Rule::unique('cars', 'name')->ignore($this->model->id)]),
            Field::make('Photos')->file()->multiple()->rules('required'),
            Field::make('Color')->select(['Red', 'Green', 'Blue']),
            Field::make('Owners')->array([
                ArrayField::make('Name')->input()->placeholder('Name')->rules('required'),
                ArrayField::make('Phone')->input('tel')->placeholder('Phone')->rules('required'),
            ])->rules('required'),
            Field::make('Insurable')->checkbox()->placeholder('Is the car insurable?')->rules('accepted'),
            Field::make('Fuel Type')->radio(['Gas', 'Diesel', 'Electric'])->default('Diesel'),
            Field::make('Features')->checkboxes(['Stereo', 'Bluetooth', 'Navigation'])->rules('required|min:2'),
            Field::make('Description')->textarea(),
        ];
    }
    
### `make($label, $name = null)`

##### `$label`

The label to use for the form field, e.g. `First Name`.

##### `$name`

The name to use for the form field. If null, it will use a snake cased `$label`.

Basic field example:

    Field::make('First Name')->input()->rules('required|min:2'),
    
Relationship field example:

    $brand_options = Brand::orderBy('name')->get()->pluck('id', 'name')->all();

    return [
        Field::make('Brand', 'brand_id')->select($brand_options)->rules(['required', Rule::exists('brands', 'id')]),
        ...

### `input($type = 'text')`

Sets the field to be an `input` element. Defaults to `text`.

##### `$type`

Optional HTML5 input type to use for the input.

Example:

    Field::make('Email Address')->input('email'),
    
### `file()`

Sets the field to be a `file` input element.

File fields should have a nullable `text` database column, and be cast to `array` in your model. 
This array will be populated with useful info for each file, including `file`, `disk`, `name`, `size`, and `mime_type`.

Example migration:

    $table->text('photos')->nullable();

Example model casting:

    protected $casts = ['photos' => 'array'];

Example field declaration:

    Field::make('Photos')->file(),
    
You can allow multiple file selections using the `multiple()` method:

    Field::make('Photos')->file()->multiple(),
    
### `textarea($rows = 2)`

Sets the field to be a `textarea` element.

##### `$rows`

The amount of rows to use for the textarea. Defaults to `2`.

Example:

    Field::make('Description')->textarea(5),
    
### `select($options = [])`

Sets the field to be a `select` dropdown element.

##### `$options`

An array of options to use for the select.

Example using a sequential array:

    Field::make('Colors')->select(['Red', 'Green', 'Blue']),
    
Example using an associative array:

    Field::make('Colors')->select(['Red' => '#ff0000', 'Green' => '#00ff00', 'Blue' => '#0000ff']),

When using associative arrays, the keys will be used for the option labels, and the values for the option values.

### `checkbox()`

Sets the field to be a `checkbox` element.

Checkbox fields should have a nullable `boolean` database column.

Example migration:

    $table->boolean('accepts_terms')->nullable();
    
Example field declaration:

    Field::make('Accepts Terms')->checkbox()->placeholder('Do you accept our TOS?')->rules('accepted'),
    
If a `placeholder()` is specified, it will be used as the checkbox label.

### `checkboxes($options = [])`

Sets the field to be multiple `checkbox` elements.

##### `$options`

An array of options to use for the checkboxes. Works the same as the `select()` method.

Checkboxes fields should have a nullable `text` database column, and be cast to `array` in your model.

Example migration:

    $table->text('features')->nullable();

Example model casting:

    protected $casts = ['features' => 'array'];

Example field declaration:

    Field::make('Features')->checkboxes(['Stereo', 'Bluetooth', 'Navigation'])->rules('required|min:2'),
    
### `radio($options = [])`

Sets the field to be a `radio` element.

##### `$options`

An array of options to use for the radio. Works the same as the `select()` method.

Example:

    Field::make('Fuel Type')->radio(['Gas', 'Diesel', 'Electric'])->default('Diesel'),

### `array($fields = [])`

Sets the field to be an array of fields.

##### `$fields`

An array of `ArrayField`s to use. [Jump to the array field declaration section](#array-field-declaration) to learn more.

Example:

    Field::make('Owners')->array([
        ArrayField::make('Full Name')->input()->placeholder('Full Name')->rules('required'),
        ArrayField::make('Phone Number')->input('tel')->placeholder('Phone Number'),
    ]),

Use the `sortable()` method to make the array fields sortable:

    Field::make('Owners')->array([
        ArrayField::make('Full Name')->input()->placeholder('Full Name')->rules('required'),
        ArrayField::make('Phone Number')->input('tel')->placeholder('Phone Number'),
    ])->sortable(),

### `default($default)`

Sets the default value to use for the field.

##### `$default`

The default value.

Example:

    Field::make('City')->input()->default('Toronto'),
    
### `autocomplete($autocomplete)`

Sets the autocomplete value to use for the field.

##### `$autocomplete`

The autocomplete value.

Example:

    Field::make('Password')->input('password')->autocomplete('new-password'),
    
### `placeholder($placeholder)`

Sets the placeholder value to use for the field.

##### `$placeholder`

The placeholder value.

Example:

    Field::make('Country')->input()->placeholder('What country do you live in?'),
    
### `help($help)`

Sets the help text to use below the field.

##### `$help`

The help text.

Example:

    Field::make('City')->input()->help('Please enter your current city.'),
    
### `rules($rules)`

Sets the [Laravel validation rules](https://laravel.com/docs/master/validation#available-validation-rules) to use for the field.

##### `$rules`

A string or array of Laravel validation rules.

Example using a string:

    Field::make('Name')->input()->rules('required|min:2'),
    
Example using an array:

    Field::make('City')->input()->rules(['required', Rule::in(['Toronto', 'New York']), new MyCustomRule]),
    
### `view($view)`

Sets a custom view to use for the field. Useful for more complex field elements not included in the package.

##### `$view`

The custom view.

Example custom view file:

    {{-- fields/custom-field.blade.php --}}
    <div class="form-group row">
        <label for="{{ $field->name }}" class="col-md-2 col-form-label text-md-right">
            {{ $field->label }}
        </label>
    
        <div class="col-md">
            <input
                id="{{ $field->name }}"
                type="text"
                class="custom-field-class form-control @error($field->key) is-invalid @enderror"
                wire:model.lazy="{{ $field->key }}">
    
            @include('tall-forms::fields.error-help')
        </div>
    </div>
    
Custom views are passed `$field`, `$form_data`, and `$model` variables, as well as any other public component properties.

Example custom view field declaration:

    Field::make('Custom Field')->view('fields.custom-field');

# Array Field Declaration

`ArrayField`s are slightly different than `Field`s. They should only be declared within the field `array()` method.
They have most of the same methods available, except for the `file()` and `array()` methods.
They also have a `colspan()` method unavailable to `Field`s.

### `make($name)`

##### `$name`

The name to use for the array field, e.g. `phone_number`. 
Array fields do not use labels. Rather, you should specify a `placeholder()` for them instead.

Example:

    ArrayField::make('phone_number')->input('tel')->placeholder('Phone Number')->rules('required'),

### `colspan($width)`

Optional [Bootstrap 4 grid](https://getbootstrap.com/docs/4.4/layout/grid/) column width to use for the array field on desktop. 
If this is not set, the column will uniformly fit in the grid by default.

Example:

    ArrayField::make('province')->select(['AB', 'BC', 'ON'])->placeholder('Province')->colspan(4),

You can also use `auto` to have the column auto-fit the array field width:

    ArrayField::make('old_enough')->checkbox()->placeholder('Old Enough')->colspan('auto'),

# Publishing Files

Publishing files is optional.

Publishing the form view files:

    php artisan vendor:publish --tag=form-views

Publishing the config file:

    php artisan vendor:publish --tag=form-config
