<div>
    <livewire:components.navbaradmin />

    <livewire:components.adminheader :viewname='$viewname'/>

    @switch($content)
        @case ('dashboard')
       <livewire:admin.dashboard  />
        @break;

        @case ('user')
        <livewire:admin.users />
        @break;
    @endswitch
    <livewire:components.userfooter />
</div>


