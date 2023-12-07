


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
            background-color: grey; /* Replace 'yourColor' with the color you want */
            display: flex;  
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

   

        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 15px 0;
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container mt-4">
            <div class="d-flex justify-content-between">
               <a href="{{route('learning-logs.index')}}" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
               <a href="{{route('download.log_file',$log->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>Download Attachment</a>
            </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h1 class="">Title</h1> <h1 class="blog-title">{{$log->title}}</h1>
                <h3 class="">Theme</h3> <h3 class="blog-title">
                   
                    @foreach($themes as $theme) 
                       
                        {{$theme->name ?? ''}}, 
                    @endforeach</h3>
                    
                <p class="blog-meta text-muted">Published on {{$log->created_at}}</p>
                @if(!empty($log->thumbnail))
                    <img src="{{ asset('storage/learninglog/thumbnail/'.$log->thumbnail) }}" alt="Blog Post Image" class="img-fluid blog-image mb-4">
                @else
                <div class="img-fluid blog-image mb-4 text-center" >
                    <h1 class="text-white mx-auto my-auto">{{$log->title}}</h1>
                </div>
                @endif
                <!-- Blog Post Content -->
                <p>{!! $log->description !!}</p>
            </div>
    
           
           
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2023 {{$log->title}}</p>
    </footer>
    </div>
   
</x-nform-layout>
