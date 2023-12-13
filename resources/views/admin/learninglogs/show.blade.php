


<x-nform-layout>

    @section('title')
     View {{$log->title ?? 'Lesson'}}
    @endsection
    <style>
        .blog-title {
            color: #007bff;
        }

        

        .blog-image {
            width: 100% !important;
            height: 350px;
            border-radius: 8px;
            background-image: url('{{ asset('storage/learninglog/thumbnail/'.$log->thumbnail) }}'); /* Replace 'your-image-url.jpg' with your actual image URL */
            background-size: cover;
            background-position: center;
            
        }

        .blog-image::before {
            
            filter: blur(100px); /* Adjust the blur amount as needed */
            height: 100%;
            z-index: 6;
        }
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 15px 0;
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
      
        <div class="blog-image" >
            <div class="text-white mx-auto my-auto text-center">
                
                {{-- <div class="d-flex justify-content-between p-5">
                    <div class="p-5" style="font-weight: bold; font-size: 2em;">Project: {{ $log->projects->name}} ({{$log->project_type}})</div>
                    <div class="p-5" style="font-weight: bold; font-size: 2em;">Date of Submission: {{ $log->created_at->format('d/m/Y')}}</div>
                </div> --}}
            </div>
            
        </div>
       
        <div class="container mt-4">
            <div class="d-flex justify-content-between">
               <a href="{{route('learning-logs.index')}}" class="btn btn-light  btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Return to Explore</a>
               <a href="{{route('download.log_file',$log->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>Download Attachment</a>
            </div>
        <div class="row mt-5">
            <div class="col-md-12">
              
             
                <div> 
                    <h5 class="text-primary">
                    @foreach($themes as $theme) 
                        {{$theme->name ?? ''}}, 
                    @endforeach</h5>
                    <h1>{{ucfirst($log->title ?? '')}}</h1>
                    <h5>{{$log->projects->name ?? ''}} ({{$log->project_type ?? ''}})</h5>
                    <div class="row mt-5">
                        <div class="col-md-3">
                          <ul>
                            <li>
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Cooking/Dish.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Research Type::  {{$log->research_type}}
                            </li>
                            <li>
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                                </svg><!--end::Svg Icon--></span>
                                @foreach($provinces as $province)
                                    {{$province->province_name ?? ''}},
                                @endforeach</li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                          </ul>
                        </div>
                        <div class="col-md-3 mt-">
                          <ul>
                            <li> Project</li>
                            <li>
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Compass.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                @foreach($districts as $district)
                                    {{$district->district_name ?? ''}},
                                @endforeach
                            </li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                          </ul>
                        </div>
                        <div class="col-md-3">
                          <ul>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                            <li>Lorem ipsum</li>
                          </ul>
                        </div>
                    </div>
                </div>
                
              
               <div class="card mb-5" ">
                <p class="text-center">{!! $log->description !!}</p>
               </div>
            </div>
    
           
           
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2023 {{$log->title}}</p>
    </footer>
    </div>
   
</x-nform-layout>
