<div class="info-box bg-gradient-danger">
    <span class="info-box-icon bg-danger"><i class="fas fa-bullseye"></i></span>

    <div class="info-box-content">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-left">
                <h6>
                    Meta deste trimestre:
                    <span class="text-bold" id="targetPoints">
                        @switch($quarter)
                            @case(1)
                            {{ $pointsTable->target_first_quarter ?? 0 }}
                            @break

                            @case(2)
                            {{ $pointsTable->target_second_quarter ?? 0 }}
                            @break

                            @case(3)
                            {{ $pointsTable->target_third_quarter ?? 0 }}
                            @break

                            @case(4)
                            {{ $pointsTable->target_fourth_quarter ?? 0 }}
                            @break
                        @endswitch
                    </span>
                    pontos
                </h6>
                <h6>Faltam <span id="missingPoints" class="text-bold">0</span> pontos para atingir a meta deste
                    trimestre.</h6>
            </div>

            <div class="col-md-6 col-sm-12 text-right">

                <span class="mr-2">meus pontos: </span>
                <b class="totalQuarterPoints">0</b> / <small class="targetPoints">0</small>


                <div class="progress-group">
                    <div class="progress progress-bar-striped progress-bar-animated">
                        <div class="progress-bar bg-info" id="progress-bar"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.info-box-content -->
</div>
