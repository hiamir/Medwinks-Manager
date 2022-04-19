<div>
    <livewire:components.admin-header :pageName="$pageName"/>
    <livewire:components.menu.menu/>
    @if(!session()->get('error'))
        {{$slot}}
    @else
        <livewire:components.error/>
    @endif
    <livewire:components.userfooter/>
</div>
