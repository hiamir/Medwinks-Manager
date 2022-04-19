<div
    x-data="{
    value:@entangle($name),
    weekend:{{$weekend}},
    minDate:{{$minDate}},
    maxDate:{{$minDate}},
        days:[
        {'id':'0','day':'sunday'},
        {'id':'1','day':'monday'},
        {'id':'2','day':'tuesday'},
        {'id':'3','day':'wednesday'},
        {'id':'4','day':'thursday'},
        {'id':'5','day':'friday'},
        {'id':'6','day':'saturday'},
        ]

       }"
    x-on:change="value = $event.target.value"
    x-init="new Pikaday({

            field: $refs.input,
            trigger:'',
            defaultDate:{{$defaultDate}},
            setDefaultDate:{{$setDefaultDate}},
            format: '{{$format}}',
            firstDay:{{$firstDay}},
            yearSuffix:'{{$yearSuffix}}',
            minDate:minDate,
            maxDate:maxDate,
            pickWholeWeek:{{$pickWholeWeek}},
            yearRange:{{$yearRange}},

            setStartRange:moment().subtract({days: 10}).toDate(),
            setEndRange:moment().add({days: 10}).toDate(),

        showWeekNumber:{{$showWeekNumber}},
            disableDayFn: function(date){
                // Disable Friday & Saturday
{{--                console.log(new Date());--}}
                let daysoff=[5,6];
                $.each( weekend, function( key, day ) {
                day=day.toLowerCase();
              switch(day){
               case 'sunday':
                    daysoff[key]=0;
                    break;
               case 'monday':
               daysoff[key]=1;
                    break;
                case 'tuesday':
                    daysoff[key]=2;
                    break;
                case 'wednesday':
                    daysoff[key]=3;
                    break;
                case 'thursday':
                    daysoff[key]=4;
                    break;
               case 'friday':
                    daysoff[key]=5;
                    break;
                case 'saturday':
                    daysoff[key]=6;
                    break;
              }
              });
                return (daysoff.indexOf(date.getDay()) != -1)
            },
             disableWeekends:{{$disableWeekends}},
             showMonthAfterYear:true,


            toString(date, format) {
                const day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear();
                return `${day}/${month}/${year}`;
            },
            parse(dateString, format) {
                // dateString is the result of `toString` method
                const parts = dateString.split('/');
                const day = parseInt(parts[0], 10);
                const month = parseInt(parts[1], 10) - 1;
                const year = parseInt(parts[2], 10);
                return new Date(year, month, day);
            }
    });">
    <div class="relative mt-2">
        <input
            name="{{$name}}"
            x-ref="input"
            x-bind:value="value"
            type="text"
            class=""
            placeholder="Select date"
        />
    </div>
</div>
