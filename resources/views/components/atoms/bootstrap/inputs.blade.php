<div class="form-floating mb-3 floating-label"
     x-data = "{ {{$xdata}},
    reset: false,
    error: false,
    model: '',
    originalValue: '',
    emptyValue: '',
    generateID() {
        return this.idName + '_' + pid + '_' + sid;
    },

    isValidationError() {
        @this.on('validation-error', (value) => {
            console.log('status: ' + value.status);
            (value.status) ? this.error = true: this.error = false;
            console.log('validator: inputValue= ' + this.inputValue);
            console.log('validator: originalValue= ' + this.originalValue);
            console.log(this.error);
        });
    }
}"
    x-init = " {{$xinit}}

    originalValue = inputValue;
    emptyValue = '';
    $watch('reset', (value) => {
        if (reset) {
            inputValue = '';
            $refs.input.focus()
            reset = false;
        }
    });


    $watch('entangleName', () => {

    });

    $watch('modelframe', (value) => {
        if (error) {
            inputValue = originalValue;
        }
        console.log('inputValue: ' + inputValue);
        switch (value) {

            case ('create'):
                model = value;
                console.log(value);
                xdata = '';
                console.log('create: inputValue= ' + inputValue);
                console.log('create: originalValue= ' + originalValue);
                console.log(error);
                break;

            case ('submitCreate'):
                console.log(value);
                console.log('submitCreate: inputValue= ' + inputValue);
                console.log('submitCreate: originalValue= ' + originalValue);
                console.log(error);
                isValidationError();
                break;

            case ('change'):
                model = value;
                inputValue = originalValue;
                console.log(value);
                console.log('change: inputValue= ' + inputValue);
                console.log('change: originalValue= ' + originalValue);
                console.log(error);
                break;

            case ('submitChange'):
                console.log(value);
                console.log('submitChange: inputValue= ' + inputValue);
                console.log('submitChange: originalValue= ' + originalValue);
                console.log(error);
                isValidationError();
                break;

            case ('delete'):
                model = value;
                console.log(value);
                break;

            case ('submitDelete'):
                console.log(value);
                break;

            case ('close'):
                console.log(value);
                inputValue = '';
                console.log('model :' + model);
                console.log('close: inputValue= ' + inputValue);
                console.log('close: originalValue= ' + originalValue);
                console.log(error);
                if (model == 'change') {
                    inputValue = originalValue;
                } else if (!error && model == 'create') {

                }
                error = false
                break;
        }
    });">


    <input
        x-ref="input"
        type="text"
        :id="generateID"
        :placeholder="placeholder"
        wire:model="{{$name}}"
        :value=inputValue
        x-model=inputValue
        x-on:blur="$dispatch('input',inputValue)"
        class="form-control"
    >
<span class="reset-icon" x-on:click="reset=true" ><i class="fas fa-times-circle"></i></span>

@error($name)
<label :for="generateID" class="text-"><span class="" x-text="label"></span> - <span class="text-danger text-xs">{{$message}}</span> </label>
@else
    <label :for="generateID" class="text-"><span class="form-floating-label" x-text="label"></span></label>
    @enderror
</div>
