{{-- Print success message from a previous operation attempt --}}
    @if (session('status'))

        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{ session('status') }}
        </div>
        
    @endif