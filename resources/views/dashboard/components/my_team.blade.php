<div class="card card-danger card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users mr-1"></i> Minha Equipe → <b>{{ Auth::user()->team->name }}</b>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <div class="row">
            @foreach($team_members as $member)
                <div class="col-sm-3">
                    <div class="card bg-light">
                        <div class="card-header text-muted">
                            <h2 class="lead mb-0">
                                <b>{{ $member->name_short }}</b>
                                @if($member->profile == 'supervisor')
                                    <small>(Supervisor)</small>
                                @endif
                            </h2>
                            <small>{{ $member->name }}</small>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-7">
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small mb-2"><span class="fa-li"><i
                                                    class="fas fa-lg fa-house-user mr-2"></i></span>
                                            CRECI:
                                            {{ $member->creci }}
                                        </li>
                                        <li class="small mb-2"><span class="fa-li"><i
                                                    class="fas fa-lg fa-id-card mr-2"></i></span>
                                            {{ $member->cpf }}
                                        </li>
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-phone mr-2"></i></span>
                                            {{ $member->phone }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img
                                        src="{{ asset('storage') }}/{{ $member->photo ?? '../images/no_photo.png' }}"
                                        alt="{{ $member->name }}"
                                        class="img-circle img-member-team">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
    <!-- /.car-body -->
</div>
<!-- /.card -->
