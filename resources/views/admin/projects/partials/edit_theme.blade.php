<div>
    @foreach($project_themes as $theme)
        <div class="modal fade" id="edittheme_{{ $theme->id }}" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Thematic Area</h3>
                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="update_projectpartner_{{ $theme->id }}" class="update_projectpartner_form" method="post" autocomplete="off" action="{{ route('projectthemes.update', $theme->id) }}">   
                            @csrf
                            @method('PUT') <!-- Assuming you are using PUT method for updating -->
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="hidden" name="partner_id" value="{{ $theme->partner_id }}">
                            <div class="px-5">
                                <!-- Your form fields here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm m-5">
                                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
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

