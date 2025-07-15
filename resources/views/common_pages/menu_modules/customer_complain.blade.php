<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.customer_complain')) }}">
    <a><i class="fa fa-archive" aria-hidden="true"></i><span>গ্রাহকের অভিযোগ</span></a>
     <ul class="nav child-nav level-1">

        <!-- Customer Compalin Managements start-->
        @if(isMenuRender(['CustomerComplainTypesController@create','CustomerComplainTypesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['CustomerComplainTypesController']) }}">
                <a><span>Complain Type Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('CustomerComplainTypesController@create',$menu_list))
                        <li @if($current_location=='CustomerComplainTypesController@create') class="active-item" @endif><a href="{{ route('complainTypes.create',[]) }}">Add Complain Type</a></li>
                    @endif
                    @if(isMenuRender('CustomerComplainTypesController@index',$menu_list))
                        <li @if($current_location=='CustomerComplainTypesController@index') class="active-item" @endif><a href="{{ route('complainTypes.index',[]) }}">Complain Type Lists</a></li>
                    @endif
                    
                </ul>
            </li>
        @endif
        @if(isMenuRender(['ProductsController@create','ProductsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ProductsController']) }}">
                <a><span>Product Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ProductsController@create',$menu_list))
                        <li @if($current_location=='ProductsController@create') class="active-item" @endif><a href="{{ route('products.create',[]) }}">Add Product</a></li>
                    @endif
                    @if(isMenuRender('ProductsController@index',$menu_list))
                        <li @if($current_location=='ProductsController@index') class="active-item" @endif><a href="{{ route('products.index',[]) }}">Product Lists</a></li>
                    @endif
                    
                </ul>
            </li>
        @endif
        <!-- Customer Compalin Managements end-->


    </ul>
</li>
