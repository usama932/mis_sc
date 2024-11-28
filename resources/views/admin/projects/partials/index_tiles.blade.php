<style>
    .circle-tile {
        margin-bottom: 15px;
        text-align: center;
    }
    .circle-tile-heading {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 100%;
        color: #FFFFF;
        height: 80px;
        margin: 0 auto -40px;
        position: relative;
        transition: all 0.3s ease-in-out 0s;
        width: 80px;
    }
    .circle-tile-heading .fa {
        line-height: 80px;
    }
    .circle-tile-content {
        padding-top: 50px;
        
    }
    .circle-tile-number {
        font-size: 20px;
        font-weight: bold;
        line-height: 1;
        padding: 5px 0 15px;
    }
    .circle-tile-description {
        text-transform: uppercase;
        font-weight: bold;
    }
    
</style>
<div class="row p-5">
    <div class="col-md-2 col-sm-6">
        <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-success"><i class="fa fa-project-diagram text-dark"></i></div></a>
        <div class="circle-tile-content  bg-success">
            <div class="circle-tile-description text-white text-bold "> Total Projects</div>
            <div class="circle-tile-number text-white ">{{ $total_projects ?? '' }}</div>
        </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-danger"><i class="fa fa-tasks text-dark"></i></div>
            <div class="circle-tile-content bg-danger">
                <div class="circle-tile-description text-white"> Active </div>
                <div class="circle-tile-number text-white">{{$active ?? ''}}</div>
            </div>
        </div>
    </div> 

    <div class="col-md-2 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-primary"><i class="fa fa-unlink text-dark"></i></div>
            <div class="circle-tile-content bg-primary">
            <div class="circle-tile-description text-white fs-7"> InActive </div>
            <div class="circle-tile-number text-white">{{$inactive ?? ''}}</div>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-info "><i class="fa fa-venus-double text-dark"></i></div>
            <div class="circle-tile-content bg-info">
            <div class="circle-tile-description text-white ">Humanitarian</div>
            <div class="circle-tile-number text-white ">{{$humanterian ?? ''}}</div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-dark"><i class="fa-thin fa-code-compare text-light"></i></div>
            <div class="circle-tile-content bg-dark">
            <div class="circle-tile-description text-white">Development </div>
            <div class="circle-tile-number text-white">{{$development ?? ''}}</div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-warning"><i class="fa fa-calendar-week text-dark"></i></div>
            <div class="circle-tile-content bg-warning">
            <div class="circle-tile-description text-white">Detail Project </div>
            <div class="circle-tile-number text-white">{{$detail ?? ''}}</div>
            </div>
        </div>
    </div>
</div>