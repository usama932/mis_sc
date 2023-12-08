


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
                <h1 style="color:red;  font-weight: bold; font-size: 3em; padding-top:10% !important;">{{$log->title ?? ''}}</h1>
            
                <div class="d-flex justify-content-between p-5">
                    <div class="p-5" style="font-weight: bold; font-size: 2em;">Project: {{ $log->projects->name}} ({{$log->project_type}})</div>
                    <div class="p-5" style="font-weight: bold; font-size: 2em;">Date of Submission: {{ $log->created_at->format('d/m/Y')}}</div>
                </div>
            </div>
            
        </div>
       
        <div class="container mt-4">
            <div class="d-flex justify-content-between">
               <a href="{{route('learning-logs.index')}}" class="btn btn-light  btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Return to Explore</a>
               <a href="{{route('download.log_file',$log->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>Download Attachment</a>
            </div>
        <div class="row mt-5">
            <div class="col-md-12">
              
                <h3 class="text-center">Theme</h3> <h3 class="blog-title">
                <div  class="text-center"> 
                    @foreach($themes as $theme) 
                       
                        {{$theme->name ?? ''}}, 
                    @endforeach</h3>
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
