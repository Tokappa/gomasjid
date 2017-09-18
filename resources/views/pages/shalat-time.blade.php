@extends('layouts.app-dashboard')



@section('page-title')
@lang('masjid.shalat_time.page_title')
@endsection



@section('style')
<style>
.notopmargin {
    margin-top: 0px;
}
</style>
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
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('masjid.shalat_calculation')</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group label-floating">
                                    <label class="control-label">@lang('masjid.input_latitude')</label>
                                    <input type="text" class="form-control" name="latitude">
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">@lang('masjid.input_longitude')</label>
                                    <input type="text" class="form-control" name="latitude">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('masjid.select_convention')</label>
                                    <select class="form-control" name="convention">
                                        <option value="mwlg">MWL — Muslim World League</option>
                                        <option value="isna">ISNA — Islamic Society of North America</option>
                                        <option value="egas">EGAS — Egyptian General Authority of Survey</option>
                                        <option value="uqum" selected="selected">Ummul Qura University, Makkah</option>
                                        <option value="uisk">University of Islamic Sciences, Karachi</option>
                                    </select>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">@lang('masjid.input_altitude')</label>
                                    <input type="text" class="form-control" name="altitude">
                                </div>

                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('masjid.shalat_adjustment_detail')</h3>
                            </div>

                            <div class="panel-body">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation"><a href="#imsak" aria-controls="imsak" role="tab" data-toggle="tab">Imsak</a></li>
                                    <li role="presentation" class="active"><a href="#subuh" aria-controls="subuh" role="tab" data-toggle="tab">Subuh</a></li>
                                    <li role="presentation"><a href="#syuruq" aria-controls="syuruq" role="tab" data-toggle="tab">Syuruq</a></li>
                                    <li role="presentation"><a href="#dzuhur" aria-controls="dzuhur" role="tab" data-toggle="tab">Dzuhur</a></li>
                                    <li role="presentation"><a href="#ashar" aria-controls="ashar" role="tab" data-toggle="tab">Ashar</a></li>
                                    <li role="presentation"><a href="#maghrib" aria-controls="maghrib" role="tab" data-toggle="tab">Maghrib</a></li>
                                    <li role="presentation"><a href="#isya" aria-controls="isya" role="tab" data-toggle="tab">Isya</a></li>
                                    <!-- <li role="presentation"><a href="#jumat" aria-controls="jumat" role="tab" data-toggle="tab">Jumat</a></li> -->
                                </ul>


                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Imsak -->
                                    <div role="tabpanel" class="tab-pane fade" id="imsak">
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tampilkan</label>
                                            <div class="checkbox col-sm-4">
                                                <label>
                                                    <input name="show_imsak" checked="&quot;checked&quot;" type="checkbox"> Tampilkan di layar
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_imsak">Imsak</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_imsak" value="10" name="pengaturan_imsak" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block">Sebelum Adzan Subuh</span>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Imsak -->

                                    <!-- Subuh -->
                                    <div role="tabpanel" class="tab-pane fade in active" id="subuh">
                                        <!-- <h4>Subuh</h4> -->
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_persiapan_subuh">Persiapan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_persiapan_subuh" value="8" name="pengaturan_persiapan_subuh" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block persiapan persiapan_subuh">04:11:57</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_adzan_subuh">Adzan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">04:19:57</span><input id="pengaturan_adzan_subuh" value="0" name="pengaturan_adzan_subuh" class="touchspin form-control" data-time="04:19:57" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block adzan_subuh ">04:19:57</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_iqamat_subuh">Iqamat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_iqamat_subuh" value="15" name="pengaturan_iqamat_subuh" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block iqamat_subuh">04:34:57</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_durasi_subuh">Durasi Sholat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_durasi_subuh" value="10" name="pengaturan_durasi_subuh" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block durasi_subuh">04:44:57</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Subuh -->

                                    <!-- Syuruq -->
                                    <div role="tabpanel" class="tab-pane fade" id="syuruq">
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tampilkan</label>
                                            <div class="checkbox col-sm-4">
                                                <label>
                                                    <input name="show_syuruq" type="checkbox"> Tampilkan di layar
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_syuruq">Syuruq</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">04:19:57</span><input id="pengaturan_syuruq" value="0" name="pengaturan_syuruq" class="touchspin form-control" data-time="04:19:57" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <!-- <span class="help-block adzan_subuh ">04:19:57</span> -->
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Syuruq -->

                                    <!-- Dzuhur -->
                                    <div role="tabpanel" class="tab-pane fade" id="dzuhur">
                                        <!-- <h4>Dzuhur</h4> -->
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_persiapan_dzuhur">Persiapan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_persiapan_dzuhur" value="0" name="pengaturan_persiapan_dzuhur" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block persiapan persiapan_dzuhur">11:37:15</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_adzan_dzuhur">Adzan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">11:33:15</span><input id="pengaturan_adzan_dzuhur" value="4" name="pengaturan_adzan_dzuhur" class="touchspin form-control" data-time="11:33:15" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block adzan_dzuhur ">11:37:15</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_iqamat_dzuhur">Iqamat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_iqamat_dzuhur" value="0" name="pengaturan_iqamat_dzuhur" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block iqamat_dzuhur">11:37:15</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_durasi_dzuhur">Durasi Sholat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_durasi_dzuhur" value="0" name="pengaturan_durasi_dzuhur" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block durasi_dzuhur">11:37:15</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Dzuhur -->

                                    <!-- Ashar -->
                                    <div role="tabpanel" class="tab-pane fade" id="ashar">
                                        <!-- <h4>Ashar</h4> -->
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_persiapan_ashar">Persiapan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_persiapan_ashar" value="10" name="pengaturan_persiapan_ashar" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block persiapan persiapan_ashar">14:44:34</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_adzan_ashar">Adzan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">14:48:34</span><input id="pengaturan_adzan_ashar" value="6" name="pengaturan_adzan_ashar" class="touchspin form-control" data-time="14:48:34" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block adzan_ashar ">14:54:34</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_iqamat_ashar">Iqamat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_iqamat_ashar" value="9" name="pengaturan_iqamat_ashar" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block iqamat_ashar">15:03:34</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_durasi_ashar">Durasi Sholat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_durasi_ashar" value="12" name="pengaturan_durasi_ashar" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block durasi_ashar">15:15:34</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Ashar -->

                                    <!-- Maghrib -->
                                    <div role="tabpanel" class="tab-pane fade" id="maghrib">
                                        <!-- <h4>Maghrib</h4> -->
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_persiapan_maghrib">Persiapan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_persiapan_maghrib" value="0" name="pengaturan_persiapan_maghrib" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block persiapan persiapan_maghrib">17:36:12</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_adzan_maghrib">Adzan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">17:36:12</span><input id="pengaturan_adzan_maghrib" value="0" name="pengaturan_adzan_maghrib" class="touchspin form-control" data-time="17:36:12" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block adzan_maghrib ">17:36:12</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_iqamat_maghrib">Iqamat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_iqamat_maghrib" value="0" name="pengaturan_iqamat_maghrib" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block iqamat_maghrib">17:36:12</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_durasi_maghrib">Durasi Sholat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_durasi_maghrib" value="0" name="pengaturan_durasi_maghrib" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block durasi_maghrib">17:36:12</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Maghrib -->

                                    <!-- Isya -->
                                    <div role="tabpanel" class="tab-pane fade" id="isya">
                                        <!-- <h4>Isya</h4> -->
                                        <p>&nbsp;</p>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_persiapan_isya">Persiapan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_persiapan_isya" value="15" name="pengaturan_persiapan_isya" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block persiapan persiapan_isya">19:00:12</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pengaturan_adzan_isya">Adzan</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">19:06:12</span><input id="pengaturan_adzan_isya" value="9" name="pengaturan_adzan_isya" class="touchspin form-control" data-time="19:06:12" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block adzan_isya ">19:15:12</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_iqamat_isya">Iqamat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_iqamat_isya" value="15" name="pengaturan_iqamat_isya" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block iqamat_isya">19:30:12</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="clearfix"></div>
                                            <label class="col-sm-2 control-label" for="pengaturan_durasi_isya">Durasi Sholat</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_durasi_isya" value="20" name="pengaturan_durasi_isya" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                                <span class="help-block durasi_isya">19:50:12</span>
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
                                                    <div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><span class="bootstrap-timepicker-hour">12</span></td> <td class="separator">:</td><td><span class="bootstrap-timepicker-minute">00</span></td> </tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div>
                                                    <input name="pengaturan_adzan_jumat" id="pengaturan_adzan_jumat" class="form-control pickJumatTime" type="text">
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
                                                <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="pengaturan_iqamat_jumat" value="15" name="pengaturan_iqamat_jumat" class="touchspin-adjust form-control" style="display: block;" type="text"><span class="input-group-addon bootstrap-touchspin-postfix">menit</span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span></div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End Jumat -->

                                </div>

                                <div class="clearfix"></div>
                                <button class="btn btn-primary">Simpan</button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer-dashboard')

    </div>
</div>
@endsection





@section('javascript')
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {

});
</script>
@endsection
