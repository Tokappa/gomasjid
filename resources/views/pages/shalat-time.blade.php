@extends('layouts.app-dashboard')



@section('page-title')
@lang('masjid.shalat_time.page_title')
@endsection



@section('style')
<!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.touchspin.min.css') }}"> -->
@endsection



@section('navbar-dashboard-title')
@lang('masjid.shalat_time.page_title')
@endsection



@section('navbar-dashboard-search')
<!-- <form class="navbar-form navbar-right typeahead__container" method="get" role="search" action="{{ route('user.search') }}">
    <div class="form-group is-empty typeahead__field">
        <span class="typeahead__query">
            <input type="text" class="form-control" name="q" placeholder="Search" autocomplete="off">
            <span class="material-input"></span>
        </span>
    </div>

    <input type="hidden" name="search" value="user">

    <button type="submit" class="btn btn-white btn-round btn-just-icon">
        <i class="material-icons">search</i><div class="ripple-container"></div>
    </button>
</form> -->
@endsection



@section('content')


<div class="wrapper">

    @include('layouts.sidebar')

    <div class="main-panel">

        @include('layouts.navbar-dashboard')

        <div class="content">
            <div class="container-fluid">

                @include('layouts.flash')

                <div class="row">
                    <div class="col-sm-4">
                        <form action="{{ route('shalat.update') }}" method="post">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">@lang('masjid.shalat_calculation')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_latitude')</label>
                                        <input type="text" class="form-control" name="latitude" value="{{ $masjid->lat }}">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_longitude')</label>
                                        <input type="text" class="form-control" name="longitude" value="{{ $masjid->lng }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">@lang('masjid.select_convention')</label>
                                        <select class="form-control" name="convention">
                                            <option value="mwlg" {{ ($masjid->convention == "mwlg") ?  'selected="selected"' : '' }}>MWL — Muslim World League</option>
                                            <option value="isna" {{ ($masjid->convention == "isna") ?  'selected="selected"' : '' }}>ISNA — Islamic Society of North America</option>
                                            <option value="egas" {{ ($masjid->convention == "egas") ?  'selected="selected"' : '' }}>EGAS — Egyptian General Authority of Survey</option>
                                            <option value="uqum" {{ ($masjid->convention == "uqum") ?  'selected="selected"' : '' }}>Ummul Qura University, Makkah</option>
                                            <option value="uisk" {{ ($masjid->convention == "uisk") ?  'selected="selected"' : '' }}>University of Islamic Sciences, Karachi</option>
                                        </select>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_altitude')</label>
                                        <input type="text" class="form-control" name="altitude" value="{{ $masjid->alt}}">
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <input type="hidden" name="step" value="1">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <form action="{{ route('shalat.update') }}" method="post">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">@lang('masjid.shalat_adjustment_detail')</h3>
                                </div>

                                <div class="panel-body">

                                    <?php
                                    $pengaturan_subuh = isset($pengaturan_sholat->subuh) ? $pengaturan_sholat->subuh : [0,0,0,0];
                                    $pengaturan_dzuhur = isset($pengaturan_sholat->dzuhur) ? $pengaturan_sholat->dzuhur : [0,0,0,0];
                                    $pengaturan_ashar = isset($pengaturan_sholat->ashar) ? $pengaturan_sholat->ashar : [0,0,0,0];
                                    $pengaturan_maghrib = isset($pengaturan_sholat->maghrib) ? $pengaturan_sholat->maghrib : [0,0,0,0];
                                    $pengaturan_isya = isset($pengaturan_sholat->isya) ? $pengaturan_sholat->isya : [0,0,0,0];
                                    $pengaturan_imsak = isset($pengaturan_sholat->imsak) ? $pengaturan_sholat->imsak : [0,0];
                                    $pengaturan_syuruq = isset($pengaturan_sholat->syuruq) ? $pengaturan_sholat->syuruq : [0,0];
                                    ?>

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <!-- <li role="presentation"><a href="#imsak" aria-controls="imsak" role="tab" data-toggle="tab">Imsak</a></li> -->
                                        <li role="presentation" class="active"><a href="#subuh" aria-controls="subuh" role="tab" data-toggle="tab">Subuh</a></li>
                                        <!-- <li role="presentation"><a href="#syuruq" aria-controls="syuruq" role="tab" data-toggle="tab">Syuruq</a></li> -->
                                        <li role="presentation"><a href="#dzuhur" aria-controls="dzuhur" role="tab" data-toggle="tab">Dzuhur</a></li>
                                        <li role="presentation"><a href="#ashar" aria-controls="ashar" role="tab" data-toggle="tab">Ashar</a></li>
                                        <li role="presentation"><a href="#maghrib" aria-controls="maghrib" role="tab" data-toggle="tab">Maghrib</a></li>
                                        <li role="presentation"><a href="#isya" aria-controls="isya" role="tab" data-toggle="tab">Isya</a></li>
                                        <!-- <li role="presentation"><a href="#jumat" aria-controls="jumat" role="tab" data-toggle="tab">Jumat</a></li> -->
                                    </ul>


                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <!-- Imsak -->
                                        <!-- <div role="tabpanel" class="tab-pane fade" id="imsak">
                                            <p>&nbsp;</p>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Tampilkan</label>
                                                <div class="checkbox col-sm-4">
                                                    <label>
                                                        <input type="checkbox" name="show_imsak" {{ ($pengaturan_imsak[0] == 1) ? 'checked="checked"' : '' }}> Tampilkan di layar
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="clearfix"></div>
                                                <label class="col-sm-2 control-label" for="pengaturan_imsak">Imsak</label>
                                                <div class="col-sm-4">
                                                    <input id="pengaturan_imsak" type="text" value="{{ $pengaturan_imsak[1] }}" name="pengaturan_imsak" class="touchspin-adjust">
                                                    <span class="help-block">Sebelum Adzan Subuh</span>
                                                </div>
                                            </div>

                                        </div> -->
                                        <!-- End Imsak -->

                                        <!-- Subuh -->
                                        <div role="tabpanel" class="tab-pane fade in active" id="subuh">
                                            <!-- <h4>Subuh</h4> -->
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Hasil Kalkulasi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="{{ $waktu_sholat[0] }}" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Persiapan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_subuh[0] }}" name="subuh_preparation" class="form-control touchspin-adjust">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Adzan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_subuh[1] }}" name="subuh_adzan" class="form-control touchspin" data-time="{{ $waktu_sholat[0] }}">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Iqamat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_subuh[2] }}" name="subuh_iqamat" class="form-control touchspin-adjust">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Durasi Sholat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_subuh[3] }}" name="subuh_duration" class="form-control touchspin-adjust">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Subuh -->

                                        <!-- Syuruq -->
                                        <!-- <div role="tabpanel" class="tab-pane fade" id="syuruq">
                                            <p>&nbsp;</p>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Tampilkan</label>
                                                <div class="checkbox col-sm-4">
                                                    <label>
                                                        <input type="checkbox" name="show_syuruq" {{ ($pengaturan_syuruq[0] == 1) ? 'checked="checked"' : '' }}> Tampilkan di layar
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <div class="clearfix"></div>
                                                <label class="col-sm-2 control-label" for="pengaturan_syuruq">Syuruq</label>
                                                <div class="col-sm-4">
                                                    <input id="pengaturan_syuruq" type="text" value="{{ $pengaturan_syuruq[1] }}" name="pengaturan_syuruq" class="form-control touchspin" data-time="{{ $waktu_sholat[0] }}">
                                                    <span class="help-block adzan_subuh ">{{ $waktu_sholat[0] }}</span>
                                                </div>
                                            </div>

                                        </div> -->
                                        <!-- End Syuruq -->

                                        <!-- Dzuhur -->
                                        <div role="tabpanel" class="tab-pane fade" id="dzuhur">
                                            <!-- <h4>Dzuhur</h4> -->
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Hasil Kalkulasi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="{{ $waktu_sholat[2] }}" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Persiapan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_dzuhur[0] }}" name="dzuhur_preparation" class="form-control touchspin-adjust">
                                                    <span class="help-block persiapan persiapan_dzuhur">{{ $waktu_sholat[2] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Adzan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_dzuhur[1] }}" name="dzuhur_adzan" class="form-control touchspin" data-time="{{ $waktu_sholat[2] }}">
                                                    <span class="help-block adzan_dzuhur ">{{ $waktu_sholat[2] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Iqamat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_dzuhur[2] }}" name="dzuhur_iqamat" class="form-control touchspin-adjust">
                                                    <span class="help-block iqamat_dzuhur">{{ $waktu_sholat[2] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Durasi Sholat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_dzuhur[3] }}" name="dzuhur_duration" class="form-control touchspin-adjust">
                                                    <span class="help-block durasi_dzuhur">{{ $waktu_sholat[2] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Dzuhur -->

                                        <!-- Ashar -->
                                        <div role="tabpanel" class="tab-pane fade" id="ashar">
                                            <!-- <h4>Ashar</h4> -->
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Hasil Kalkulasi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="{{ $waktu_sholat[3] }}" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Persiapan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_ashar[0] }}" name="ashar_preparation" class="form-control touchspin-adjust">
                                                    <span class="help-block persiapan persiapan_ashar">{{ $waktu_sholat[3] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Adzan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_ashar[1] }}" name="ashar_adzan" class="form-control touchspin" data-time="{{ $waktu_sholat[3] }}">
                                                    <span class="help-block adzan_ashar ">{{ $waktu_sholat[3] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Iqamat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_ashar[2] }}" name="ashar_iqamat" class="form-control touchspin-adjust">
                                                    <span class="help-block iqamat_ashar">{{ $waktu_sholat[3] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Durasi Sholat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_ashar[3] }}" name="ashar_duration" class="form-control touchspin-adjust">
                                                    <span class="help-block durasi_ashar">{{ $waktu_sholat[3] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Ashar -->

                                        <!-- Maghrib -->
                                        <div role="tabpanel" class="tab-pane fade" id="maghrib">
                                            <!-- <h4>Maghrib</h4> -->
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Hasil Kalkulasi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="{{ $waktu_sholat[4] }}" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Persiapan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_maghrib[0] }}" name="maghrib_preparation" class="form-control touchspin-adjust">
                                                    <span class="help-block persiapan persiapan_maghrib">{{ $waktu_sholat[4] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Adzan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_maghrib[1] }}" name="maghrib_adzan" class="form-control touchspin" data-time="{{ $waktu_sholat[4] }}">
                                                    <span class="help-block adzan_maghrib ">{{ $waktu_sholat[4] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Iqamat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_maghrib[2] }}" name="maghrib_iqamat" class="form-control touchspin-adjust">
                                                    <span class="help-block iqamat_maghrib">{{ $waktu_sholat[4] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Durasi Sholat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_maghrib[3] }}" name="maghrib_duration" class="form-control touchspin-adjust">
                                                    <span class="help-block durasi_maghrib">{{ $waktu_sholat[4] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Maghrib -->

                                        <!-- Isya -->
                                        <div role="tabpanel" class="tab-pane fade" id="isya">
                                            <!-- <h4>Isya</h4> -->
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Hasil Kalkulasi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="{{ $waktu_sholat[5] }}" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Persiapan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_isya[0] }}" name="isya_preparation" class="form-control touchspin-adjust">
                                                    <span class="help-block persiapan persiapan_isya">{{ $waktu_sholat[5] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Adzan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_isya[1] }}" name="isya_adzan" class="form-control touchspin" data-time="{{ $waktu_sholat[5] }}">
                                                    <span class="help-block adzan_isya ">{{ $waktu_sholat[5] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Iqamat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_isya[2] }}" name="isya_iqamat" class="form-control touchspin-adjust">
                                                    <span class="help-block iqamat_isya">{{ $waktu_sholat[5] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Durasi Sholat</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="{{ $pengaturan_isya[3] }}" name="isya_duration" class="form-control touchspin-adjust">
                                                    <span class="help-block durasi_isya">{{ $waktu_sholat[5] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Isya -->


                                        <!-- Jumat -->
                                        <!-- <div role="tabpanel" class="tab-pane fade" id="jumat">
                                            <p>&nbsp;</p>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="pengaturan_adzan_jumat">Adzan</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input type="text" name="pengaturan_adzan_jumat" id="pengaturan_adzan_jumat" class="form-control pickJumatTime">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="clearfix"></div>
                                                <label class="col-sm-2 control-label" for="pengaturan_iqamat_jumat">Iqamat</label>
                                                <div class="col-sm-4">
                                                    <input id="pengaturan_iqamat_jumat" type="text" value="{{ $pengaturan_isya[2] }}" name="pengaturan_iqamat_jumat" class="form-control touchspin-adjust">
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- End Jumat -->

                                    </div>

                                    <div class="clearfix"></div>


                                </div>

                                <div class="panel-footer">
                                    <input type="hidden" name="step" value="2">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary btn-block">Simpan</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer-dashboard')

    </div>
</div>
@endsection





@section('javascript')
<!-- <script src="{{ asset('js/bootstrap.touchspin.min.js') }}"></script> -->
<script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    // $.each($(' .touchspin '), function() {
    //     var currentTime = $(this).attr('data-time');
    //     $(this).TouchSpin({
    //         verticalbuttons: true,
    //         min: -60,
    //         max: 60,
    //         prefix: currentTime,
    //         postfix: 'menit'
    //     });
    // });
    //
    // $.each($(' .touchspin-adjust '), function() {
    //     $(this).TouchSpin({
    //         verticalbuttons: true,
    //         min: 0,
    //         max: 60,
    //         postfix: 'menit'
    //     });
    // });

    // Subuh
    var refTime = $(' .adzan_subuh ').html();
    var adjustTime = $(' input[name="pengaturan_adzan_subuh"] ').val();
    var adzanTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .adzan_subuh ').html(adzanTime);

    var refTime = $(' .adzan_subuh ').html();
    var adjustTime = $(' input[name="pengaturan_persiapan_subuh"] ').val();
    var persiapanTime = moment(refTime, 'HH:mm:ss').subtract(adjustTime,'m').format('HH:mm:ss');
    $(' .persiapan_subuh ').html(persiapanTime);

    var adjustTime = $(' input[name="pengaturan_iqamat_subuh"] ').val();
    var iqamatTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .iqamat_subuh ').html(iqamatTime);

    var refTime = $(' .iqamat_subuh ').html();
    var adjustTime = $(' input[name="pengaturan_durasi_subuh"] ').val();
    var durationTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .durasi_subuh ').html(durationTime);

    // Dzuhur
    var refTime = $(' .adzan_dzuhur ').html();
    var adjustTime = $(' input[name="pengaturan_adzan_dzuhur"] ').val();
    var adzanTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .adzan_dzuhur ').html(adzanTime);

    var refTime = $(' .adzan_dzuhur ').html();
    var adjustTime = $(' input[name="pengaturan_persiapan_dzuhur"] ').val();
    var persiapanTime = moment(refTime, 'HH:mm:ss').subtract(adjustTime,'m').format('HH:mm:ss');
    $(' .persiapan_dzuhur ').html(persiapanTime);

    var adjustTime = $(' input[name="pengaturan_iqamat_dzuhur"] ').val();
    var iqamatTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .iqamat_dzuhur ').html(iqamatTime);

    var refTime = $(' .iqamat_dzuhur ').html();
    var adjustTime = $(' input[name="pengaturan_durasi_dzuhur"] ').val();
    var durationTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .durasi_dzuhur ').html(durationTime);


    // Ashar
    var refTime = $(' .adzan_ashar ').html();
    var adjustTime = $(' input[name="pengaturan_adzan_ashar"] ').val();
    var adzanTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .adzan_ashar ').html(adzanTime);

    var refTime = $(' .adzan_ashar ').html();
    var adjustTime = $(' input[name="pengaturan_persiapan_ashar"] ').val();
    var persiapanTime = moment(refTime, 'HH:mm:ss').subtract(adjustTime,'m').format('HH:mm:ss');
    $(' .persiapan_ashar ').html(persiapanTime);

    var adjustTime = $(' input[name="pengaturan_iqamat_ashar"] ').val();
    var iqamatTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .iqamat_ashar ').html(iqamatTime);

    var refTime = $(' .iqamat_ashar ').html();
    var adjustTime = $(' input[name="pengaturan_durasi_ashar"] ').val();
    var durationTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .durasi_ashar ').html(durationTime);


    // Maghrib
    var refTime = $(' .adzan_maghrib ').html();
    var adjustTime = $(' input[name="pengaturan_adzan_maghrib"] ').val();
    var adzanTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .adzan_maghrib ').html(adzanTime);

    var refTime = $(' .adzan_maghrib ').html();
    var adjustTime = $(' input[name="pengaturan_persiapan_maghrib"] ').val();
    var persiapanTime = moment(refTime, 'HH:mm:ss').subtract(adjustTime,'m').format('HH:mm:ss');
    $(' .persiapan_maghrib ').html(persiapanTime);

    var adjustTime = $(' input[name="pengaturan_iqamat_maghrib"] ').val();
    var iqamatTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .iqamat_maghrib ').html(iqamatTime);

    var refTime = $(' .iqamat_maghrib ').html();
    var adjustTime = $(' input[name="pengaturan_durasi_maghrib"] ').val();
    var durationTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .durasi_maghrib ').html(durationTime);


    // Isya
    var refTime = $(' .adzan_isya ').html();
    var adjustTime = $(' input[name="pengaturan_adzan_isya"] ').val();
    var adzanTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .adzan_isya ').html(adzanTime);

    var refTime = $(' .adzan_isya ').html();
    var adjustTime = $(' input[name="pengaturan_persiapan_isya"] ').val();
    var persiapanTime = moment(refTime, 'HH:mm:ss').subtract(adjustTime,'m').format('HH:mm:ss');
    $(' .persiapan_isya ').html(persiapanTime);

    var adjustTime = $(' input[name="pengaturan_iqamat_isya"] ').val();
    var iqamatTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .iqamat_isya ').html(iqamatTime);

    var refTime = $(' .iqamat_isya ').html();
    var adjustTime = $(' input[name="pengaturan_durasi_isya"] ').val();
    var durationTime = moment(refTime, 'HH:mm:ss').add(adjustTime,'m').format('HH:mm:ss');
    $(' .durasi_isya ').html(durationTime);

});
</script>
@endsection
