<div class="input-checkbox bg-light-primary"

    x-data = "{ {{$xdata}},
    reset: false,
    error: false,
    model: '',
    originalValue: '',
    emptyValue: '',
    generateID() {
        return this.idName + '_' + pid + '_' + sid;
    },
    divGenerateID(){
    return 'div_'+this.idName + '_' + pid + '_' + sid;
    },

    isValidationError() {
        @this.on('validation-error', (value) => {
            console.log('status: ' + value.status);
        (value.status) ? this.error = true: this.error = false;
{{--            console.log('validator: inputValue= ' + this.inputValue);--}}
    {{--            console.log('validator: originalValue= ' + this.originalValue);--}}
    {{--            console.log(this.error);--}}
        });
    }
}"
     :id="divGenerateID"

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
{{--             console.log('inputValue: ' + inputValue);--}}
        switch (value) {

            case ('create'):
                model = value;
{{--                     console.log(value);--}}
        xdata = '';
{{--                     console.log('create: inputValue= ' + inputValue);--}}
    {{--                     console.log('create: originalValue= ' + originalValue);--}}
    {{--                     console.log(error);--}}
        break;

    case ('submitCreate'):
{{--                     console.log(value);--}}
    {{--                     console.log('submitCreate: inputValue= ' + inputValue);--}}
    {{--                     console.log('submitCreate: originalValue= ' + originalValue);--}}
    {{--                     console.log(error);--}}
        isValidationError();
        if(!error)inputValue = '';
        break;

    case ('change'):
        model = value;
        inputValue = originalValue;
{{--                     console.log(value);--}}
    {{--                     console.log('change: inputValue= ' + inputValue);--}}
    {{--                     console.log('change: originalValue= ' + originalValue);--}}
    {{--                     console.log(error);--}}
        break;

    case ('submitChange'):
{{--                     console.log(value);--}}
    {{--                     console.log('submitChange: inputValue= ' + inputValue);--}}
    {{--                     console.log('submitChange: originalValue= ' + originalValue);--}}
    {{--                     console.log(error);--}}
        isValidationError();
        break;

    case ('delete'):
        model = value;
{{--                     console.log(value);--}}
        break;

    case ('submitDelete'):
{{--                     console.log(value);--}}
        break;

    case ('close'):
{{--                     console.log(value);--}}
        inputValue = '';
{{--                     console.log('model :' + model);--}}
    {{--                     console.log('close: inputValue= ' + inputValue);--}}
    {{--                     console.log('close: originalValue= ' + originalValue);--}}
    {{--                     console.log(error);--}}
        if (model == 'change') {
            inputValue = originalValue;
        } else if (!error && model == 'create') {

        }
        error = false
        break;
}
});">


    <div class="form-check form-check-inline">
        <input
            class="form-check-input"
            type="checkbox"
            :id="generateID"
            value=1
            x-model='inputValue'
            wire:model.defer="{{$name}}"
        >
        <label class="form-check-label" for="checkbox-0" x-text="placeholder"></label>
    </div>

    <label for="input-checkbox">Active</label>
</div>
