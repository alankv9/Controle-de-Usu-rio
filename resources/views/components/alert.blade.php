@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('seccess') }}
    </div>
@endif  

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
            {{ $error }} </dd></dd>
        @endforeach
    </div>
@endif

