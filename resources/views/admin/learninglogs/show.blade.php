


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
            </div>  
        </div>
        <div class="container mt-4">
            <div class="d-flex justify-content-between">
               <a href="{{route('learning-logs.index')}}" class="btn btn-divght  btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Return to Explore</a>
               <a href="{{route('download.log_file',$log->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>Download Attachment</a>
            </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="mt-5"> 
                    <h5 class="text-primary">
                    @foreach($themes as $theme) 
                        {{$theme->name ?? ''}}, 
                    @endforeach</h5>
                    <h1>{{ucfirst($log->title ?? '')}}</h1>
                    
                    <div class="row mt-5">
                        <div class="col-md-3 mt-5">
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Cooking/Dish.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Research Type::  {{$log->research_type}}
                            </div>
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                                </svg><!--end::Svg Icon--></span>
                                @foreach($provinces as $province)
                                    {{$province->province_name ?? ''}},
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Interselect.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z M17,16 L17,10 C17,8.34314575 15.6568542,7 14,7 L8,7 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L17,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M9.27272727,9 L13.7272727,9 C14.5522847,9 15,9.44771525 15,10.2727273 L15,14.7272727 C15,15.5522847 14.5522847,16 13.7272727,16 L9.27272727,16 C8.44771525,16 8,15.5522847 8,14.7272727 L8,10.2727273 C8,9.44771525 8.44771525,9 9.27272727,9 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Project:: {{$log->projects->name ?? ''}} ({{$log->project_type ?? ''}})
                            </div>
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Compass.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                @foreach($districts as $district)
                                    {{$district->district_name ?? ''}},
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Picker.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M10.232233,10.232233 L13.767767,13.767767 L8.46446609,19.0710678 C7.48815536,20.0473785 5.90524292,20.0473785 4.92893219,19.0710678 C3.95262146,18.0947571 3.95262146,16.5118446 4.92893219,15.5355339 L10.232233,10.232233 Z" fill="#000000"/>
                                        <path d="M13.767767,6.69669914 L15.5355339,4.92893219 C16.5118446,3.95262146 18.0947571,3.95262146 19.0710678,4.92893219 C20.0473785,5.90524292 20.0473785,7.48815536 19.0710678,8.46446609 L17.3033009,10.232233 L18.363961,11.2928932 C18.9497475,11.8786797 18.9497475,12.8284271 18.363961,13.4142136 C17.7781746,14 16.8284271,14 16.2426407,13.4142136 L10.5857864,7.75735931 C10,7.17157288 10,6.22182541 10.5857864,5.63603897 C11.1715729,5.05025253 12.1213203,5.05025253 12.7071068,5.63603897 L13.767767,6.69669914 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Created By:: {{$log->user?->name ?? '' }}
                            </div>
                            <div class="mt-5"> 
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Vertical.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M12,3 C12.5522847,3 13,3.44771525 13,4 L13,5 C13,5.55228475 12.5522847,6 12,6 C11.4477153,6 11,5.55228475 11,5 L11,4 C11,3.44771525 11.4477153,3 12,3 Z M12,8 C12.5522847,8 13,8.44771525 13,9 L13,10 C13,10.5522847 12.5522847,11 12,11 C11.4477153,11 11,10.5522847 11,10 L11,9 C11,8.44771525 11.4477153,8 12,8 Z M12,13 C12.5522847,13 13,13.4477153 13,14 L13,15 C13,15.5522847 12.5522847,16 12,16 C11.4477153,16 11,15.5522847 11,15 L11,14 C11,13.4477153 11.4477153,13 12,13 Z M12,18 C12.5522847,18 13,18.4477153 13,19 L13,20 C13,20.5522847 12.5522847,21 12,21 C11.4477153,21 11,20.5522847 11,20 L11,19 C11,18.4477153 11.4477153,18 12,18 Z" fill="#000000"/>
                                    <path d="M21,9.04031242 L21,14.9596876 C21,15.23583 20.7761424,15.4596876 20.5,15.4596876 C20.3864643,15.4596876 20.276309,15.4210472 20.1876525,15.350122 L16.488043,12.3904344 C16.272412,12.2179296 16.2374514,11.9032834 16.4099561,11.6876525 C16.433022,11.6588201 16.4592107,11.6326315 16.488043,11.6095656 L20.1876525,8.64987802 C20.4032834,8.47737324 20.7179296,8.51233393 20.8904344,8.7279649 C20.9613596,8.81662142 21,8.92677668 21,9.04031242 Z M3,14.9596876 L3,9.04031242 C3,8.76417005 3.22385763,8.54031242 3.5,8.54031242 C3.61353575,8.54031242 3.723691,8.5789528 3.81234752,8.64987802 L7.51195699,11.6095656 C7.72758796,11.7820704 7.76254865,12.0967166 7.59004388,12.3123475 C7.56697799,12.3411799 7.54078935,12.3673685 7.51195699,12.3904344 L3.81234752,15.350122 C3.59671656,15.5226268 3.28207037,15.4876661 3.1095656,15.2720351 C3.03864038,15.1833786 3,15.0732233 3,14.9596876 Z" fill="#000000" opacity="0.3"/>
                                </g>
                                </svg><!--end::Svg Icon--></span>
                            Status:: {{$log->status ?? ''}}</div>
                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1lx"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Substract.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero"/>
                                        <path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Updated By:: {{$log->user1?->name ?? '' }}
                            </div>
                            <div class="mt-5">
                                <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Fdivp-vertical.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xdivnk="http://www.w3.org/1999/xdivnk" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M9.07117914,12.5710461 L13.8326627,12.5710461 C14.108805,12.5710461 14.3326627,12.3471885 14.3326627,12.0710461 L14.3326627,0.16733734 C14.3326627,-0.108805035 14.108805,-0.33266266 13.8326627,-0.33266266 C13.6282104,-0.33266266 13.444356,-0.208187188 13.3684243,-0.0183579985 L8.6069408,11.8853508 C8.50438409,12.1417426 8.62909204,12.4327278 8.8854838,12.5352845 C8.94454394,12.5589085 9.00756943,12.5710461 9.07117914,12.5710461 Z" fill="#000000" opacity="0.3" transform="translate(11.451854, 6.119192) rotate(-270.000000) translate(-11.451854, -6.119192) "/>
                                        <path d="M9.23851648,24.5 L14,24.5 C14.2761424,24.5 14.5,24.2761424 14.5,24 L14.5,12.0962912 C14.5,11.8201488 14.2761424,11.5962912 14,11.5962912 C13.7955477,11.5962912 13.6116933,11.7207667 13.5357617,11.9105959 L8.77427814,23.8143047 C8.67172143,24.0706964 8.79642938,24.3616816 9.05282114,24.4642383 C9.11188128,24.4878624 9.17490677,24.5 9.23851648,24.5 Z" fill="#000000" transform="translate(11.500000, 18.000000) scale(1, -1) rotate(-270.000000) translate(-11.500000, -18.000000) "/>
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="11" y="2" width="2" height="20" rx="1"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Uploaded At:: {{ $log->created_at->format('d/m/Y')}}
                            </div>
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
