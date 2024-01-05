<div class="row" id="researchResults">
    @forelse($logs as $log)
        <div class="col-md-4 col-sm-4 col-lg-4 my-5">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary ">
                    <h3 class="card-title fs-7"> {{ mb_strimwidth($log->title ,0, 28, '...') }}</h3> 
                    <div class="card-toolbar">
                        <a href="{{route('download.log_file',$log->id)}}">
                            <i class="fa fa-download text-primary mx-1" aria-hidden="true"></i>
                        </a>
                        @can('delete_learning_log')
                        <a href="{{route('learning-logs.edit',$log->id)}}">
                            <i class="fa fa-pencil text-info mx-1" aria-hidden="true"></i>
                        </a>
                        @endcan
                        @can('delete_learning_log')
                            <a href="javascript:void(0)" onclick="del('{{ $log->id }}')">
                                <i class="fa fa-trash text-danger mx-1" aria-hidden="true"></i>
                            </a>
                        @endcan
                    </div>
                   
                </div>
                <div class="card-body">
                    <div class="fixed-thumbnail">
                        @if($log->thumbnail)
                        <img src="{{ asset('storage/learninglog/thumbnail/'.$log->thumbnail) }}" class="img-thumbnail " alt="..." style="">
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                  
                    <div class="d-flex justify-content-between">
                        <div>{{ $log->projects->name}} ({{$log->project_type}})</div>
                        <div>{{ $log->created_at->format('d/m/Y')}}</div>
                      
                    </div>
                    <p class="fs-7">{{ mb_strimwidth($log->description ,0, 40, '...')}}  
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="{{route('learning-logs.show',$log->id)}}" class="btn btn-primary btn-sm"> View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h1 class="text-danger text-center mt-5">No Record Found</h1>
    @endforelse
 
</div