<div>
    @foreach($project_themes as $theme)
        <div class="modal fade project_theme_modal" id="edittheme_{{ $theme->id }}" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Thematic Area</h3>
                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="update_projecttheme_form" method="post" autocomplete="off" action="{{ route('projectthemes.update', $theme->id) }}">   
                            @csrf
                            @method('PUT') <!-- Assuming you are using PUT method for updating -->
                            <input type="hidden" name="project_id" value="{{ $theme->project_id }}">
                       
                            <div class="row ">
                                <div class="fv-row col-md-4">
                                    <label class="fs-8 fw-semibold form-label 2">
                                        <span class="">Thematic Area:</span>
                                    </label>
                                    <br>
                                {{$theme->scitheme_name?->name ?? ''}}
                                </div>
                                <div class="fv-row col-md-4 col-lg-4 col-sm-12">
                                    <label class="fs-8 fw-semibold form-label">
                                    <span class="">Sub-Thematic Area:</span>
                                    </label>
                                    <br>
                                    {{$theme->scisubtheme_name?->name ?? ''}}
                                </div>
                                <div class="fv-row col-md-4">
                                    <label class="fs-9 fw-semibold form-label ">
                                        <span class="required"> House Hold target</span>
                                    </label>
                                    <input type="text" name="house_hold_target" class="form-control  mx-1" placeholder="# of HH Target" autocomplete="off" value="{{$theme->house_hold_target ?? ''}}">
                                </div>
                                <div class="fv-row col-md-2">
                                    <label class="fs-9 fw-se9mibold form-label">
                                        <span class="required"> Beneficiaries Target</span>
                                    </label>
                                    <input type="text" name="individual_target" id="individual_target" class="form-control  mx-1" placeholder="# of Beneficiaries" value="{{$theme->individual_target ?? ''}}" autocomplete="off">
                                </div>
                            
                                <div class="fv-row col-md-2">
                                    <label class="fs-9 fw-semibold form-label ">
                                        <span class="required">Women Target</span>
                                    </label>
                                    <input type="text" name="women_target" id="women_target" class="form-control  mx-1" value="{{$theme->women_target ?? "" }}" placeholder="# of Women" autocomplete="off">
                                </div>
                                <div class="fv-row col-md-2">
                                    <label class="fs-9 fw-semibold form-label ">
                                        <span class="required">Men Target</span>
                                    </label>
                                    <input type="text" name="men_target" id="men_target" class="form-control" placeholder="# of Men" value="{{$theme->men_target ?? ''}}" autocomplete="off">
                                </div>
                                <div class="fv-row col-md-2">
                                    <label class="fs-9 fw-semibold form-label ">
                                        <span class="required">Girls Target</span>
                                    </label>
                                    <input type="text" name="girls_target" id="girls_target" class="form-control" placeholder="# of Girls" value="{{$theme->girls_target ?? ''}}" autocomplete="off">
                                </div>
                                <div class="fv-row col-md-2">
                                    <label class="fs-9 fw-semibold form-label">
                                        <span class="required">Boys Target</span>
                                    </label>
                                    <input type="text" name="boys_target" id="boys_target" class="form-control" placeholder="# of Boys" value="{{$theme->boys_target ?? ''}}" autocomplete="off">
                                </div>
                                <div class="fv-row col-md-2">
                                    <label class="fs-9 fw-semibold form-label">
                                        <span class="">PWD Target</span>
                                    </label>
                                    <input type="text" name="pwd_target" id="pwd_target" class="form-control" placeholder="# of PWD" value="{{$theme->pwd_target ?? ''}}" autocomplete="off" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm m-5">
                                    @include('partials/general/_button-indicator', ['label' => 'Update'])
                                </button>
                                <div id="loadingSpinner_{{ $theme->id }}" style="display: none;">Loading...</div>
                            </div>      
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

