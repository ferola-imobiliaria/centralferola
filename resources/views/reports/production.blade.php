@extends('layouts.master')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    @include('components.errors')

    <div class="card card-danger card-outline card-tabs report-productions-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ !isset($teamSelected) ? 'active' : '' }}" id="custom-tabs-three-home-tab"
                       data-toggle="pill"
                       href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                       aria-selected="true">Por Corretor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isset($teamSelected) ? 'active' : '' }}" id="custom-tabs-three-profile-tab"
                       data-toggle="pill"
                       href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                       aria-selected="false">Por Equipe</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade {{ !isset($teamSelected) ? 'show active' : '' }}" id="custom-tabs-three-home"
                     role="tabpanel"
                     aria-labelledby="custom-tabs-three-home-tab">
                    @include('reports._production-realtor')
                </div>
                <div class="tab-pane fade {{ isset($teamSelected) ? 'show active' : '' }}"
                     id="custom-tabs-three-profile" role="tabpanel"
                     aria-labelledby="custom-tabs-three-profile-tab">
                    @include('reports._production-team')
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

@endsection


@section('js')
    <!-- SELECT 2 -->
    <script src="{{ asset('js/select2.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/input-masks.js') }}"></script>

    <!-- floatThead -->
    <script src="{{ asset('js/jquery.floatThead.js') }}"></script>

    <!-- printThis -->
    <script src="{{ asset('js/printThis.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('select#realtor').select2({
                theme: "bootstrap"
            });
            $('select#team').select2({
                theme: "bootstrap"
            });

            $('table#productionTable').floatThead({
                responsiveContainer: function ($table) {
                    return $table.closest('.table-responsive');
                },
                position: 'fixed',
                scrollingTop: 65
            });


            $('#print-production-team').click(function () {
                let team = $("#team option:selected").text() ? $("#team option:selected").text() : "{{ $teams[0]->name }} ";
                let month = $("#month option:selected").text();
                let year = $("#year option:selected").text();

                $('#card-production-team').printThis({
                    importStyle: true,
                    header: "<h1>" + team + "-" + month + "de" + year + "</h1><br><br>",
                });
            });
        });
    </script>
@endsection
