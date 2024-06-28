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
    <div class="col-md-3 col-sm-6">
        <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-success"><i class="fa fa-calendar-check text-dark"></i></div></a>
        <div class="circle-tile-content  bg-success">
            <div class="circle-tile-description text-white text-bold"> Total Visits</div>
            <div class="circle-tile-number text-white ">{{ $total_qbs+$old_totalqb ?? '' }}</div>
        </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-danger"><i class="fa fa-calendar text-dark"></i></div>
            <div class="circle-tile-content bg-danger">
                <div class="circle-tile-description text-white"> Current Month</div>
                <div class="circle-tile-number text-white">{{$qb_this_month ?? ''}}</div>
            </div>
        </div>
    </div> 

    <div class="col-md-3 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-primary"><i class="fa fa-calendar-alt text-dark"></i></div>
            <div class="circle-tile-content bg-primary">
            <div class="circle-tile-description text-white"> Last Month</div>
            <div class="circle-tile-number text-white">{{$qb_last_month ?? ''}}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="circle-tile ">
            <div class="circle-tile-heading bg-info"><i class="fa fa-calendar-week text-dark"></i></div>
            <div class="circle-tile-content bg-info">
            <div class="circle-tile-description text-white">Last 10 days</div>
            <div class="circle-tile-number text-white">{{$qb_last_days ?? ''}}</div>
            </div>
        </div>
    </div>
</div>