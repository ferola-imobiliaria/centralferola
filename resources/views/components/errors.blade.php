@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <ul class="list-unstyled msg-error">
                <li><small><i class="fas fa-asterisk"></i> {{ $error }}</small></li>
            </ul>
        @endforeach
    </div>
@endif
