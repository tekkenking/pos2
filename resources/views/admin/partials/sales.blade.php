<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <span class="label label-warning pull-right">Daily</span>
            <h5>Sales</h5>
        </div>
        <div class="ibox-content">

            <div class="row">
                <div class="col-md-6">
                	<small>Yesterday</small>
                    <h3 class="no-margins">{{money(200000000)}}</h3>
                    
                </div>
                <div class="col-md-6 text-right">
                	<small>Today</small>
                    <h3 class="no-margins">{{money('2060000,12')}}</h3>
                    <div class="font-bold text-danger">{{money('2000')}} <i class="fa fa-level-down"></i></div>
                </div>
            </div>


        </div>
    </div>
</div>


<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <span class="label label-warning pull-right">Weekly</span>
            <h5>Sales</h5>
        </div>
        <div class="ibox-content">

            <div class="row">
                <div class="col-md-6">
                	<small>last week</small>
                    <h3 class="no-margins">{{money('406,42')}}</h3>
                    
                </div>
                <div class="col-md-6 text-right">
                	<small>This week</small>
                    <h3 class="no-margins">{{money('206,12')}}</h3>
                    <div class="font-bold text-danger">{{money('2000')}} <i class="fa fa-level-down"></i></div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <span class="label label-warning pull-right">Monthly</span>
            <h5>Sales</h5>
        </div>
        <div class="ibox-content">

            <div class="row">
                <div class="col-md-6">
                	<small>Last month</small>
                    <h3 class="no-margins">{{money('406,42')}}</h3>
                </div>
                <div class="col-md-6 text-right">
                	<small>This month <em>so far</em></small>
                    <h3 class="no-margins">{{money('206,12')}}</h3>
                    <div class="font-bold text-navy">{{money('2000')}} <i class="fa fa-level-up"></i></div>
                </div>
            </div>


        </div>
    </div>
</div>
