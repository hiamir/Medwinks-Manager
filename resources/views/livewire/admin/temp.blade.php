<div>
    {{--    <div x-data="{--}}
    {{--        hello:'World' --}}
    {{--    }">--}}
    {{--        <span x-text="2+2"></span>--}}
    {{--    </div>--}}

    {{--    <div x-data="{ rec:[] }">--}}
    {{--        <div x-show="rec.length >= 1"> Amir </div>--}}
    {{--    </div>--}}


    {{--    <div x-data="{--}}
    {{--        show:false--}}
    {{--    }">--}}
    {{--        <button x-on:click="show=!show">Click Me</button>--}}
    {{--        <div x-show="show">Hello Amir</div>--}}

    {{--    </div>--}}


    {{--    <div x-data="{--}}
    {{--        number:0--}}
    {{--    }">--}}
    {{--        <button x-on:click="number=number+1">Increment</button>--}}
    {{--        <div x-text="number"></div>--}}
    {{--    </div>--}}


    {{--    <div x-data="{--}}
    {{--        name:''--}}
    {{--    }">--}}
    {{--        <label>--}}
    {{--            <input type="text" x-model="name">--}}
    {{--            <span x-text="name"></span>--}}
    {{--        </label>--}}
    {{--    </div>--}}


    {{--    <form x-data="{--}}
    {{--        name:'',--}}
    {{--        makeUpperCase(){--}}
    {{--        this.name=this.name.toUpperCase()--}}
    {{--        }--}}
    {{--    }"--}}
    {{--          x-on:submit.prevent="console.log(name)"--}}
    {{--    >--}}
    {{--        <input type="text" x-model="name">--}}
    {{--        <button type="button" x-on:click="makeUpperCase()"> Hello</button>--}}
    {{--        <button type="submit">Submit</button>--}}
    {{--    </form>--}}



    {{--    <div  x-data="{--}}
    {{--            query:'',--}}
    {{--            img:'',--}}
    {{--            getImage(){--}}
    {{--                this.img='https://source.unsplash.com/random/900×700/?'+this.query--}}
    {{--                }--}}
    {{--            }">--}}
    {{--        <form x-on:submit.prevent="getImage" >--}}
    {{--            <input type="text" x-model="query">--}}
    {{--            <button type="submit">Search</button>--}}
    {{--        </form>--}}
    {{--        <div x-show="img!=''" >--}}
    {{--            <img x-bind:src="img" alt="" width="300px">--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div--}}
    {{--        x-data="{--}}
    {{--        users:[],--}}
    {{--        deleteUsers(){--}}
    {{--        console.log(this.users)--}}
    {{--        }--}}
    {{--    }"--}}
    {{--    >--}}
    {{--        <form--}}
    {{--            x-on:submit.prevent="deleteUsers()"--}}
    {{--        >--}}
    {{--            <input type="checkbox" x-model="users" value="1"> Alex--}}
    {{--            <input type="checkbox" x-model="users" value="2"> Amir--}}
    {{--            <input type="checkbox" x-model="users" value="3"> Zubair--}}

    {{--            <button type="submit">Delete</button>--}}
    {{--        </form>--}}

    {{--        <div x-show="users !=''">--}}
    {{--            <span x-text="users"></span>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    {{--    <div--}}
    {{--        x-data="{--}}
    {{--        plan:''--}}
    {{--    }"--}}
    {{--    >--}}
    {{--        <select x-model="plan">--}}
    {{--            <option value="">Please choose...</option>--}}
    {{--            <option value="yearly">Yearly</option>--}}
    {{--            <option value="daily">Daily</option>--}}
    {{--        </select>--}}
    {{--        <div x-show="plan != ''">--}}
    {{--            <span x-text="'You have choosen '+ plan + ' plan'"></span>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <style>
        .bold {
            font-weight: 700;
        }
    </style>

    {{--    <div x-data="{--}}

    {{--        selected:false--}}

    {{--    }">--}}

    {{--        <span x-bind:class="{'bold':selected}"> Amir </span>--}}
    {{--        <button x-on:click="selected=true"> Bold </button>--}}

    {{--    </div>--}}

    {{--    <div x-data="{--}}
    {{--        progress:0--}}
    {{--    }">--}}

    {{--        <progress max="100" x-bind:value="progress">--}}
    {{--            <span x-text="progress+'%'"></span>--}}
    {{--        </progress>--}}

    {{--        <button x-on:click="progress=progress+5">Progress</button>--}}

    {{--    </div>--}}


    {{--    <div x-data="{--}}
    {{--    selected:[],--}}
    {{--        people:[--}}
    {{--        {id:1,name:'Amir'},--}}
    {{--        {id:2,name:'Sameer'},--}}
    {{--        {id:3,name:'Zubair'},--}}
    {{--        ]--}}
    {{--    }"--}}

    {{--    >--}}
    {{--        <span x-text="selected"></span>--}}
    {{--        <template x-for="person in people">--}}
    {{--            <div>--}}
    {{--                <input--}}
    {{--                    x-model.number="selected"--}}
    {{--                    x-bind:id="'person_'+person.id"--}}
    {{--                    x-bind:value="person.id"--}}
    {{--                    type="checkbox"--}}
    {{--                > <span x-text="person.name" x-bind:class="{'bold':selected.includes(person.id)}"></span>--}}
    {{--            </div>--}}
    {{--        </template>--}}

    {{--    </div>--}}

    {{--    <style>--}}
    {{--        .progress{--}}
    {{--            height:10px;--}}
    {{--        }--}}
    {{--        .progress-inner{--}}
    {{--            height:10px;--}}
    {{--            background-color:slategrey;--}}
    {{--        }--}}
    {{--    </style>--}}

    {{--    <div x-data="{--}}
    {{--        progress:0--}}
    {{--    }">--}}
    {{--        <div class="progress" >--}}
    {{--         <div class="progress-inner" x-bind:style="'width:'+progress+'%;'"></div>--}}
    {{--    </div>--}}

    {{--        <button x-on:click="progress++">Increment</button>--}}
    {{--    </div>--}}


    {{--    <div x-data="{--}}
    {{--        fruits:['apples','oranges','grapes','peach']--}}
    {{--    }">--}}
    {{--        <template x-for="fruit, index in fruits">--}}
    {{--            <div>--}}
    {{--                <span x-text="index"></span>:<span x-text="fruit"></span>--}}
    {{--            </div>--}}
    {{--        </template>--}}
    {{--    </div>--}}


    {{--    <div x-data="{--}}
    {{--    selectId:0,--}}
    {{--        people:[--}}
    {{--        {'id':1,'name':'Amir','point':1},--}}
    {{--        {'id':2,'name':'Sameer','point':100},--}}
    {{--        {'id':3,'name':'Zubair','point':5},--}}
    {{--        ],--}}

    {{--        incrementPoint(id){--}}
    {{--            this.selectId=this.people.find((e)=>e.id===id)--}}
    {{--            console.log(this.selectId.point++)--}}
    {{--        },--}}

    {{--        sortedPoint(){--}}
    {{--                return this.people.sort((a,b)=>a.point-b.point)--}}
    {{--        }--}}
    {{--    }">--}}

    {{--        <template x-for="person in sortedPoint" :key="person.id">--}}
    {{--            <div>--}}
    {{--                <span x-text="person.id"></span>: <span x-text="person.name+' Points: '+person.point"></span>--}}
    {{--                <button x-on:click="incrementPoint(person.id)"> Increment</button>--}}
    {{--            </div>--}}
    {{--        </template>--}}

    {{--    </div>--}}

    <style>
        body {
            margin: 0px;
        }

        #main {
            margin: 0px;
            padding: 0px;
        }

        .modal-wrapper {
            display: flex;
            position: absolute;
            width: 100%;
            height: 100vh;
            align-items: center;
            justify-content: center;
            background: rgba(112, 128, 144, 0.5);
        }

        .modal {
            display: flex;
            height: 30%;
            width: 50%;
            background: #fff;
            padding: 50px;
            border-radius: 10px;
            position: relative;
            text-align: center;

        }

        .modal-text {
            display: flex;
            width: 100%;
            position: relative;
        }
    </style>

    {{--    <div x-data="{ open:true, message:'' }"--}}
    {{--         x-on:open-modal.window="open = true; message=($event.detail); "--}}
    {{--         x-on:keyup.escape.window="open = false"--}}
    {{--    >--}}
    {{--            <div x-show="open" x-bind:class="'modal-wrapper'">--}}
    {{--                <div x-bind:class="'modal'" x-on:click.outside="open=false">--}}
    {{--                    <span x-bind:class="'modal-text'" x-text="message"></span>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--    </div>--}}

{{--    <div x-data="{--}}
{{--    query:'',--}}
{{--    result:[],--}}
{{--       init(){--}}
{{--        this.$watch('query',(query)=>{--}}
{{--            this.performSearch(query)--}}
{{--         }--}}
{{--         )},--}}

{{--         performSearch(query){--}}
{{--            this.result=['apple','oranges','peach']--}}
{{--         }--}}

{{--    }"--}}

{{--    >--}}
{{--        <span x-text="query"></span>--}}
{{--        <input x-model="query">--}}
{{--    </div>--}}

{{--    http://hn.algolia.com/api/v1/items/:id--}}
{{--    <button x-data x-on:click="$dispatch('open-modal','Hello')">Modal</button>--}}



{{--    <div x-data="{--}}
{{--        query:'',--}}
{{--        results:[],--}}
{{--        performSearch(query){--}}
{{--            fetch('https://hn.algolia.com/api/v1/search?query='+query)--}}
{{--            .then(response=>response.json())--}}
{{--            .then(results=>this.results=results.hits)--}}
{{--        },--}}

{{--        init(){--}}
{{--        this.$watch('query',(query)=>{--}}
{{--        if(query===''){--}}
{{--            this.results=[];--}}
{{--            return--}}
{{--        }--}}
{{--            this.performSearch(query)--}}
{{--        })--}}
{{--        }--}}


{{--    }"--}}
{{--    >--}}


{{--        <input x-model.debounce="query">--}}

{{--        <p x-show="query">--}}
{{--            Your search for <span x-text="query"></span> returned <span x-text="results.length"></span> results--}}
{{--        </p>--}}

{{--        <template x-for="result in results" :key="result.objectID">--}}
{{--            <div>--}}
{{--                <h4 x-text="result.title"></h4>--}}
{{--                <a x-bind:href="result.url" x-text="result.url"></a>--}}
{{--            </div>--}}
{{--        </template>--}}

{{--    </div>--}}



    <div x-data="{
        imagePreview:null,

        imageData(e){
        const reader= new FileReader();
        console.log(this.$refs.image);
{{--render.onload=(e)=>this.imagePreview=e.target.result--}}
        }

    }">
        <span x-text="imagePreview"></span>
        <img x-bind:src="imagePreview" alt="">
        <div>
            <input type="file" x-on:change="imageData" x-ref="image">
        </div>
    </div>

</div>
