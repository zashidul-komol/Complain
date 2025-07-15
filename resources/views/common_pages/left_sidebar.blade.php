@php
    $current_location=class_basename(Route::currentRouteAction());
@endphp
<div class="left-sidebar">
    <!-- left sidebar HEADER -->
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">&nbsp;</div>
        <div onclick="addcollapsibleclass('left-sidebar-collapsed')" class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <!-- ================NAVIGATION =================-->
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>


                <ul class="nav nav-left-lines" id="main-nav">
                    <!--HOME-->
                    <li @if($current_location=='HomeController@index') class="active-item" @endif>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>অভিযোগের আবেদন করুন</span>
                        </a>
                    </li>

                    <li @if($current_location=='CustomerComplainsController@index') class="active-item" @endif>
                        <a href="{{ route('customerComplains.index',[]) }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>অভিযোগের তালিকা</span>
                        </a>
                    </li>


                    <!-- =====Customer Complain Module start=====-->
                    @if(isMenuRender(config('myconfig.menu.customer_complain'),$controller_list))
                        @include('common_pages.menu_modules.customer_complain')
                    @endif
                    <!-- ======Customer Complain Module end====-->
                    <li @if($current_location=='CustomerComplainsController@dashboard') class="active-item" @endif>
                        <a href="{{ route('customerComplains.dashboard',[]) }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>ড্যাশবোর্ড</span>
                        </a>
                    </li>

                    <!-- =======Configuraion Module start======-->
                    @if(isMenuRender(config('myconfig.menu.configaration'),$controller_list))
                        @include('common_pages.menu_modules.configuration')
                    @endif
                    <!-- ========Configuraion Module end=======-->

                    <!-- ======User Module start=========-->
                    @if(isMenuRender(config('myconfig.menu.user'),$controller_list))
                        @include('common_pages.menu_modules.user')
                    @endif
                    <!-- =====User Module end=========-->
                    
                    <!-- =====Inventory Module start=====-->
                    @if(isMenuRender(config('myconfig.menu.inventory'),$controller_list))
                        @include('common_pages.menu_modules.inventory')
                    @endif
                    <!-- =====Inventory Module end======-->

                    <!-- ======employee Module start=======-->
                    @if(isMenuRender(config('myconfig.menu.employee'),$controller_list))
                        @include('common_pages.menu_modules.employee')
                    @endif
                    <!-- ======employee Module end======-->

                    @if (env('APP_ENV') === 'local')
                        @include('common_pages.menu_modules.template_menu')
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>