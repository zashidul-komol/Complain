<div class="col-md-4">
    <h4 class="section-subtitle"><b>Customer Complain Status</b> At A Glance</h4>
    <div class="panel">
           <div class="row dash-box-height SixBox">
                <div class="col-md-6">
                    <a href="{{ route('customerComplains.index',[1]) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">New Application</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary"> 
                                    </h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/purchase.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('customerComplains.completed',[1]) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Completed</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary"> </h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/inject.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('customerComplains.processing',[1]) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Processing</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary"> </h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/in_sip.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </div>
</div>
<div class="col-md-4">
    <h4 class="section-subtitle"><b>Monthly Compalin Status</b> Graphical View</h4>
    <div class="panel">
           <div class="row dash-box-height SixBox">
                
            </div>
    </div>
</div>
<div class="col-md-4">
    <h4 class="section-subtitle"><b>Region Wise Compalin Status</b> Graphical View</h4>
    <div class="panel">
           <div class="row dash-box-height SixBox">
                
            </div>
    </div>
</div>
