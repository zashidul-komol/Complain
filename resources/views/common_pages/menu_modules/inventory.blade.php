<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.inventory')) }}">
    <a><i class="fa fa-archive" aria-hidden="true"></i><span>Employees Module</span></a>
     <ul class="nav child-nav level-1">

          <!-- Supplier Managements start-->
        @if(isMenuRender(['SuppliersController@create','SuppliersController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['SuppliersController']) }}">
                <a><span>Supplier Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('SuppliersController@create',$menu_list))
                        <li @if($current_location=='SuppliersController@create') class="active-item" @endif><a href="{{ route('suppliers.create',[]) }}">Add Supplier</a></li>
                    @endif
                    @if(isMenuRender('SuppliersController@index',$menu_list))
                        <li @if($current_location=='SuppliersController@index') class="active-item" @endif><a href="{{ route('suppliers.index',[]) }}">Supplier Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Supplier Managements end-->

        <!-- Employee Managements start-->
        @if(isMenuRender(['EmployeesController@create','EmployeesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['EmployeesController']) }}">
                <a><span>Employee Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('EmployeesController@create',$menu_list))
                        <li @if($current_location=='EmployeesController@create') class="active-item" @endif><a href="{{ route('employees.create',[]) }}">Add Employee</a></li>
                    @endif
                    @if(isMenuRender('EmployeesController@index',$menu_list))
                        <li @if($current_location=='EmployeesController@index') class="active-item" @endif><a href="{{ route('employees.index',[]) }}">Employee Lists</a></li>
                    @endif
                    @if(isMenuRender('EmployeesController@uploadEmployee',$menu_list))
                        <li @if($current_location=='EmployeesController@uploadEmployee') class="active-item" @endif><a href="{{ route('employees.uploads',[]) }}">Employee Uploads</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Employee Managements end-->


    </ul>
</li>
