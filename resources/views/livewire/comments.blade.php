<div>
    <div>
        @if (session()->has('message-add'))
            <div class="alert alert-success">
                {{ session('message-add') }}
            </div>
        @elseif (session()->has('message-delete'))
            <div class="alert alert-success">
                {{ session('message-delete') }}
            </div>
        @elseif (session()->has('message-cannot-delete'))
            <div class="alert alert-danger">
                {{ session('message-cannot-delete') }}
            </div>
        @endif
    </div>
    <form class="mb-3 needs-validation" novalidate wire:submit.prevent="addComment">
        <div class="row">
            <div class="col-10">
@if($photo)

                <img src="{{$photo->temporaryUrl()}}" class="img img-circle rounded-circle" alt="">
                @endif

                <input type="file" wire:model="photo">
                <div wire:loading wire:target="photo" class="text-black-50">Uploading...</div>
                @error('photo') <span class="text-xs text-danger">{{ $message }}</span> @enderror

                <input name='inputext' type="text" class="form-control" id="formGroupExampleInput"
                       wire:model='inputComment' placeholder="Example input placeholder">
                @error('inputComment') <span class="text-xs text-danger">{{$message}}</span> @endError
            </div>
            <div class="col-2">
                @role('Editor-in-Chief')
                <button type="submit" class="btn btn-primary">Add</button>
                @endrole
            </div>
        </div>
    </form>


    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($comments as $comment)
            <div class="col">
                <div class="card h-100">
                    <div class="card-header ">
                        <button type="button" class="btn-close btn-sm float-end"
                                wire:click="deleteComment({{$comment->id}})" aria-label="Close"></button>

                    </div>

                    <img src="{{ asset('storage/photos/'.$comment->photo)}}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$comment->creator_id}}</h5>
                        <p class="card-text">{{$comment->body}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated {{$comment->created_at->diffForHumans()}}</small>
                    </div>
                </div>
            </div>
        @empty
            <p>No Comments</p>
        @endforelse

    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 py-3">
                {{$comments->links()}}
            </div>

        </div>
    </div>

</div>php

