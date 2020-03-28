@if(count($errors))

    <div class="form-group pt-2">
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li style="color: red;" class="alert-link" role="alert">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endif
