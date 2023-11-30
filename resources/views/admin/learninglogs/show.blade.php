


<x-nform-layout>

    @section('title')
       Detail Learning Logs
    @endsection
    <style>
        .blog-title {
            color: #007bff;
        }

        

        .blog-image {
            width: 100% !important;
            height: 350px;
            border-radius: 8px;
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
        <div class="row">
            <div class="col-md-12">
                <h1 class="blog-title">{{$log->title}}</h1>
                <p class="blog-meta text-muted">Published on {{$log->created_at}}</p>
                <img src="{{ asset('storage/learninglog/'.$log->thumbnail) }}" alt="Blog Post Image" class="img-fluid blog-image mb-4">
                
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
