<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['web']], function () {
	
	Route::get('/login', function() {
		return redirect('auth/login');
	});
	
	Route::get('/', function () {
		return redirect('login');
	});
	
	Route::get('/settings/dbswitch', 'SettingsController@index');
	Route::post('/settings/login', 'SettingsController@SubmitLogin');
	Route::post('/settings/submit_dbswitch', 'SettingsController@SubmitDbswitch');
	
	Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
	 //return redirect('/login');
     return 'Config cache cleared';
	}); 
 
	Route::auth();
	
	Route::group(['middleware' => ['auth']], function() { 
		Route::get('/index', 'DashboardController@index');
		Route::get('/dashboard', 'DashboardController@index');
		Route::get('/index', 'DashboardController@index');
		Route::get('/dashboard/get_pdcr_alert', 'DashboardController@getPdcrAlert');
		Route::get('/dashboard/get_pdci_alert', 'DashboardController@getPdciAlert');
		Route::get('/dashboard/get_docexpinfo', 'DashboardController@getDocExpinfo');
		Route::get('/dashboard/get_vehicle_alert', 'DashboardController@getVehiExpinfo');
		Route::get('/dashboard/get_crminfo', 'DashboardController@getCrmInfo');
		Route::get('/dashboard/get_contract_expiry', 'DashboardController@getContractExpiry');
		
		Route::get('/home', 'HomeController@index');
		
		Route::resource('users','UserController');
		
		Route::get('roles',		  ['as'=>'roles.index', 'uses'=>'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
		Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
		Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
		Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
		Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
		Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
		Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
		
		Route::get('/users/{id}/delete', "UserController@deluser");
		Route::get('/users/{id}/password', "UserController@changePassword");
		Route::post('/users/{id}/password', "UserController@updatePassword");
		Route::post('/users/{id}/edit', "UserController@update");

		Route::get('/category', "CategoryController@index");
		Route::get('/category/add', 'CategoryController@add');
		Route::post('/category/save', 'CategoryController@save');
		Route::get('/category/edit/{id}', 'CategoryController@edit');
		Route::post('/category/update/{id}', 'CategoryController@update');
		Route::get('/category/delete/{id}', 'CategoryController@destroy');
		Route::post('/category/group_delete', ['uses' => 'CategoryController@destroyGroup']);
		Route::get('/category/checkname', 'CategoryController@checkname');

		Route::get('/subcategory', "SubcategoryController@index");
		Route::get('/subcategory/add', 'SubcategoryController@add');
		Route::post('/subcategory/save', 'SubcategoryController@save');
		Route::get('/subcategory/edit/{id}', 'SubcategoryController@edit');
		Route::post('/subcategory/update/{id}', 'SubcategoryController@update');
		Route::get('/subcategory/delete/{id}', 'SubcategoryController@destroy');
		Route::post('/subcategory/group_delete', ['uses' => 'SubcategoryController@destroyGroup']);
		Route::get('/subcategory/checkname', 'SubcategoryController@checkname');

		Route::get('/company', "CompanyController@index");
		Route::post('/company/update/{id}', 'CompanyController@update');


		Route::get('/sysparameter', "SysparameterController@index");
		Route::post('/sysparameter/para1_update/{id}', 'SysparameterController@para1_update');
		Route::post('/sysparameter/para2_update', 'SysparameterController@para2_update');
		Route::post('/sysparameter/para3_update', 'SysparameterController@para3_update');
		Route::post('/sysparameter/para4_update/{n}', 'SysparameterController@para4_update');
		Route::post('/sysparameter/para5_update', 'SysparameterController@para5_update');
		

		Route::get('/group', "GroupController@index");
		Route::get('/group/add', 'GroupController@add');
		Route::post('/group/save', 'GroupController@save');
		Route::get('/group/edit/{id}', 'GroupController@edit');
		Route::post('/group/update/{id}', 'GroupController@update');
		Route::get('/group/delete/{id}', 'GroupController@destroy');
		Route::post('/group/group_delete', ['uses' => 'GroupController@destroyGroup']);
		Route::get('/group/checkname', 'GroupController@checkname');

		Route::get('/subgroup', "SubgroupController@index");
		Route::get('/subgroup/add', 'SubgroupController@add');
		Route::post('/subgroup/save', 'SubgroupController@save');
		Route::get('/subgroup/edit/{id}', 'SubgroupController@edit');
		Route::post('/subgroup/update/{id}', 'SubgroupController@update');
		Route::get('/subgroup/delete/{id}', 'SubgroupController@destroy');
		Route::post('/subgroup/group_delete', ['uses' => 'SubgroupController@destroyGroup']);
		Route::get('/subgroup/checkname', 'SubgroupController@checkname');

		Route::get('/unit', "UnitController@index");
		Route::get('/unit/add', 'UnitController@add');
		Route::post('/unit/save', 'UnitController@save');
		Route::get('/unit/edit/{id}', 'UnitController@edit');
		Route::post('/unit/update/{id}', 'UnitController@update');
		Route::get('/unit/delete/{id}', 'UnitController@destroy');
		Route::post('/unit/group_delete', ['uses' => 'UnitController@destroyGroup']);
		Route::get('/unit/checkname', 'UnitController@checkname');

		Route::get('/itemmaster', "ItemmasterController@index");
		Route::get('/itemmaster/add', "ItemmasterController@add");
		Route::post('/itemmaster/save', 'ItemmasterController@save');
		Route::get('/itemmaster/edit/{id}', 'ItemmasterController@edit');
		Route::post('/itemmaster/update/{id}', 'ItemmasterController@update');
		Route::get('/itemmaster/delete/{id}', 'ItemmasterController@destroy');
		Route::get('/itemmaster/checkcode', 'ItemmasterController@checkcode');
		Route::get('/itemmaster/checkdesc', 'ItemmasterController@checkdesc');
		Route::get('/itemmaster/get_vat/{id}', 'ItemmasterController@getVat');
		Route::get('/itemmaster/get_vat/{id}/{it}', 'ItemmasterController@getVat');
		Route::get('/itemmaster/get_info/{id}', 'ItemmasterController@getInfo');
		Route::get('/itemmaster/get_purchase_cost', "ItemmasterController@getPurchaseCost");
		Route::get('/itemmaster/get_sale_cost', "ItemmasterController@getSaleCost");
		Route::get('/itemmaster/item_data/{n}', 'ItemmasterController@getItem');
		Route::get('/itemmaster/get_cost_avg', "ItemmasterController@getCostAvg");
		Route::get('/itemmaster/get_cost_sale', "ItemmasterController@getCostSale");
		Route::get('/itemmaster/ajax_create', 'ItemmasterController@ajaxSave');
		Route::get('/itemmaster/get_locinfo/{id}', 'ItemmasterController@getLocInfo');
		Route::get('/itemmaster/get_locinfo/{id}/{n}', 'ItemmasterController@getLocInfo');
		Route::get('/itemmaster/get_locinfo/{id}/{n}/{piid}/{iv}', 'ItemmasterController@getLocInfo');
		Route::get('/itemmaster/stock_location/{id}', 'ItemmasterController@StockLocation');
		Route::get('/itemmaster/item_location', 'ItemmasterController@getItemLocation');
		Route::get('/itemmaster/ajax_search/{c}', 'ItemmasterController@ajaxSearch');
		Route::get('/itemmaster/ajax_search2/{c}', 'ItemmasterController@ajaxSearch2');
		
		
		Route::post('/itemmaster/paging', 'ItemmasterController@ajaxPaging');
		Route::get('/itemmaster/item_load/{code}', 'ItemmasterController@getItemLoad');
		Route::get('/itemmaster/barcode/{id}', 'ItemmasterController@gerBarcode');
		Route::get('/itemmaster/get_purchase_info/{id}', 'ItemmasterController@getPurchaseInfo');
		Route::get('/itemmaster/get_sales_info/{id}', 'ItemmasterController@getSalesInfo');
		Route::get('/itemmaster/checkqty/{id}', 'ItemmasterController@checkQuantity'); 
		Route::get('/itemmaster/item_data/{n}/{m}', 'ItemmasterController@getItem');
		Route::get('/itemmaster/getunit', 'ItemmasterController@getUnit');
		Route::post('/itemmaster/item_data', 'ItemmasterController@ajaxgetItem');
		Route::get('/itemmaster/get_custsales_info/{id}/{uid}', 'ItemmasterController@getCustSalesInfo');
		Route::get('/itemmaster/get_desc', 'ItemmasterController@getDesc');
		Route::get('/itemmaster/get_sale_cost_avg', "ItemmasterController@getSaleCostAvg");
		Route::get('/itemmaster/get_sedeinfo/{id}/{n}', 'ItemmasterController@getSedeInfo');
		Route::get('/itemmaster/get_sedeinfo/{id}', 'ItemmasterController@getSedeInfo');
		Route::get('/itemmaster/get_item_cost_avg', "ItemmasterController@getItemCostAvg");
		Route::get('/itemmaster/get_cost_avg_mfg', "ItemmasterController@getCostAvgMfg");
		Route::get('/itemmaster/get_rawmat/{id}', 'ItemmasterController@getRawmat');
		Route::get('/itemmaster/item_data_rw', 'ItemmasterController@getItemRw');
		Route::get('/itemmaster/get_margin/{id}/{cost}', 'ItemmasterController@getMargin');
		Route::get('/itemmaster/rmitem_data/{n}', 'ItemmasterController@getItemRm');
		Route::post('/itemmaster/add_rawmaterial', 'ItemmasterController@addRawMaterial');
		Route::get('/itemmaster/asmitem_data/{n}', 'ItemmasterController@getAsmItem');
		Route::post('/itemmaster/asmitem_data', 'ItemmasterController@ajaxgetAsmItem');
		Route::get('/itemmaster/get_assembly_items/{id}/{qty}/{n}', 'ItemmasterController@getAssemblyItems');
		Route::get('/itemmaster/sts', 'ItemmasterController@status_chk'); 
		Route::get('/itemmaster/view_locinfo/{id}/{n}', 'ItemmasterController@viewLocInfo');
		Route::get('/itemmaster/get_locqty/{id}', 'ItemmasterController@getLocqty');
		
		Route::get('/itemmaster/get_cnlocinfo/{id}', 'ItemmasterController@getcnLocInfo');
		Route::get('/itemmaster/get_cnlocinfo/{id}/{n}/{g}', 'ItemmasterController@getcnLocInfo');
		Route::get('/itemmaster/get_cnlocinfo/{id}/{n}/{piid}/{iv}', 'ItemmasterController@getcnLocInfo');

		Route::get('/itemmaster/conloc_data/{n}/{c}/{i}', 'ItemmasterController@getConLocation');
		Route::get('/itemmaster/conloc_data/{n}/{c}/{i}/{r}', 'ItemmasterController@getConLocation');
		Route::post('/itemmaster/conloc_data', 'ItemmasterController@ajaxgetConLocation');
		Route::get('/itemmaster/view_conloc_items/{id}/{qty}/{n}/{t}/{r}', 'ItemmasterController@viewConlocItems');

		
		//Route::get('/itemmaster/sts', 'ItemmasterController@status_chk'); 

		
		Route::get('/itemenquiry', "ItemenquiryController@index");
		Route::post('/itemenquiry/details', "ItemenquiryController@details");
		Route::get('/itemenquiry/print/{id}/{n}', "ItemenquiryController@printItem");
		Route::post('/itemenquiry/paging', 'ItemenquiryController@ajaxPaging');
		Route::get('/itemenquiry/get_custsupp', "ItemenquiryController@getCustomerSupplier");
		Route::post('/itemenquiry/export', "ItemenquiryController@dataExport");
		Route::get('/itemenquiry/openform/{id}', "ItemenquiryController@getForm");
		

		Route::get('/bank', "BankController@index");
		Route::get('/bank/add', "BankController@add");
		Route::post('/bank/save', 'BankController@save');
		Route::get('/bank/edit/{id}', 'BankController@edit');
		Route::post('/bank/update/{id}', 'BankController@update');
		Route::get('/bank/delete/{id}', 'BankController@destroy');
		Route::get('/bank/checkcode', 'BankController@checkcode');
		Route::get('/bank/checkname', 'BankController@checkname');
		
		Route::get('/currency', "CurrencyController@index");
		Route::get('/currency/add', "CurrencyController@add");
		Route::post('/currency/save', 'CurrencyController@save');
		Route::get('/currency/edit/{id}', 'CurrencyController@edit');
		Route::post('/currency/update/{id}', 'CurrencyController@update');
		Route::get('/currency/delete/{id}', 'CurrencyController@destroy');
		Route::get('/currency/checkcode', 'CurrencyController@checkcode');
		Route::get('/currency/checkname', 'CurrencyController@checkname');
		Route::get('/currency/getrate/{id}', 'CurrencyController@ajax_getrate');
		
		Route::get('/area', "AreaController@index");
		Route::get('/area/add', "AreaController@add");
		Route::post('/area/save', 'AreaController@save');
		Route::get('/area/edit/{id}', 'AreaController@edit');
		Route::post('/area/update/{id}', 'AreaController@update');
		Route::get('/area/delete/{id}', 'AreaController@destroy');
		Route::get('/area/checkcode', 'AreaController@checkcode');
		Route::get('/area/checkname', 'AreaController@checkname');

		Route::get('/location', "LocationController@index");
		Route::get('/location/add', "LocationController@add");
		Route::post('/location/save', 'LocationController@save');
		Route::get('/location/edit/{id}', 'LocationController@edit');
		Route::post('/location/update/{id}', 'LocationController@update');
		Route::get('/location/delete/{id}', 'LocationController@destroy');
		Route::get('/location/checkcode', 'LocationController@checkcode');
		Route::get('/location/checkname', 'LocationController@checkname');
		Route::get('/location/get_loc/{id}', 'LocationController@getLocation');
		Route::get('/location/get_loc', 'LocationController@getLocation');

		Route::get('/country', "CountryController@index");
		Route::get('/country/add', "CountryController@add");
		Route::post('/country/save', 'CountryController@save');
		Route::get('/country/edit/{id}', 'CountryController@edit');
		Route::post('/country/update/{id}', 'CountryController@update');
		Route::get('/country/delete/{id}', 'CountryController@destroy');
		Route::get('/country/checkcode', 'CountryController@checkcode');
		Route::get('/country/checkname', 'CountryController@checkname');

		Route::get('/department', "DepartmentController@index");
		Route::get('/department/add', "DepartmentController@add");
		Route::post('/department/save', 'DepartmentController@save');
		Route::get('/department/edit/{id}', 'DepartmentController@edit');
		Route::post('/department/update/{id}', 'DepartmentController@update');
		Route::get('/department/delete/{id}', 'DepartmentController@destroy');
		Route::get('/department/checkcode', 'DepartmentController@checkcode');
		Route::get('/department/checkname', 'DepartmentController@checkname');

		Route::get('/terms', "TermsController@index");
		Route::get('/terms/add', "TermsController@add");
		Route::post('/terms/save', 'TermsController@save');
		Route::get('/terms/edit/{id}', 'TermsController@edit');
		Route::post('/terms/update/{id}', 'TermsController@update');
		Route::get('/terms/delete/{id}', 'TermsController@destroy');
		Route::get('/terms/checkcode', 'TermsController@checkcode');
        
		Route::get('/template_name', "TemplateNameController@index");
		Route::get('/template_name/add', "TemplateNameController@add");
		Route::post('/template_name/save', 'TemplateNameController@save');
		Route::get('/template_name/edit/{id}', 'TemplateNameController@edit');
		Route::post('/template_name/update/{id}', 'TemplateNameController@update');
		Route::get('/template_name/delete/{id}', 'TemplateNameController@destroy');

		Route::get('/consignee', "ConsigneeController@index");
		Route::get('/consignee/add', "ConsigneeController@add");
		Route::post('/consignee/save', 'ConsigneeController@save');
		Route::get('/consignee/edit/{id}', 'ConsigneeController@edit');
		Route::post('/consignee/update/{id}', 'ConsigneeController@update');
		Route::get('/consignee/delete/{id}', 'ConsigneeController@destroy');
		Route::get('/consignee/ajax_create', 'ConsigneeController@ajaxSave');
		Route::get('/consignee/checkname', 'ConsigneeController@checkname');
		Route::get('/consignee/checkphone', 'ConsigneeController@checkphone');
        Route::get('/consignee/checkphone1', 'ConsigneeController@checkphone');


		Route::get('/shipper', "ShipperController@index");
		Route::get('/shipper/add', "ShipperController@add");
		Route::post('/shipper/save', 'ShipperController@save');
		Route::get('/shipper/edit/{id}', 'ShipperController@edit');
		Route::post('/shipper/update/{id}', 'ShipperController@update');
		Route::get('/shipper/delete/{id}', 'ShipperController@destroy');
		Route::get('/shipper/ajax_create', 'ShipperController@ajaxSave');
		Route::get('/shipper/checkname', 'ShipperController@checkname');
		Route::get('/shipper/checkphone', 'ShipperController@checkphone');

		Route::get('/collection_type', "CollectionTypeController@index");
		Route::get('/collection_type/add', "CollectionTypeController@add");
		Route::post('/collection_type/save', 'CollectionTypeController@save');
		Route::get('/collection_type/edit/{id}', 'CollectionTypeController@edit');
		Route::post('/collection_type/update/{id}', 'CollectionTypeController@update');
		Route::get('/collection_type/delete/{id}', 'CollectionTypeController@destroy');
		Route::get('/collection_type/checkcode', 'CollectionTypeController@checkcode');

		Route::get('/delivery_type', "DeliveryTypeController@index");
		Route::get('/delivery_type/add', "DeliveryTypeController@add");
		Route::post('/delivery_type/save', 'DeliveryTypeController@save');
		Route::get('/delivery_type/edit/{id}', 'DeliveryTypeController@edit');
		Route::post('/delivery_type/update/{id}', 'DeliveryTypeController@update');
		Route::get('/delivery_type/delete/{id}', 'DeliveryTypeController@destroy');
		Route::get('/delivery_type/checkcode', 'DeliveryTypeController@checkcode');


		Route::get('/cargounit', "CargoUnitController@index");
		Route::get('/cargounit/add', 'CargoUnitController@add');
		Route::post('/cargounit/save', 'CargoUnitController@save');
		Route::get('/cargounit/edit/{id}', 'CargoUnitController@edit');
		Route::post('/cargounit/update/{id}', 'CargoUnitController@update');
		Route::get('/cargounit/delete/{id}', 'CargoUnitController@destroy');
		Route::post('/cargounit/group_delete', ['uses' => 'CargoUnitController@destroyGroup']);
		Route::get('/cargounit/checkname', 'CargoUnitController@checkname');

		Route::get('/cargo_vehicle', "CargoVehicleController@index");
		Route::get('/cargo_vehicle/add', "CargoVehicleController@add");
		Route::post('/cargo_vehicle/save', 'CargoVehicleController@save');
		Route::get('/cargo_vehicle/edit/{id}', 'CargoVehicleController@edit');
		Route::post('/cargo_vehicle/update/{id}', 'CargoVehicleController@update');
		Route::get('/cargo_vehicle/delete/{id}', 'CargoVehicleController@destroy');
		Route::get('/cargo_vehicle/checknumber', 'CargoVehicleController@checknumber');
		Route::get('/cargo_vehicle/ajax_create', 'CargoVehicleController@ajaxSave');
        
		Route::get('/destination_type', "CargoDestinationTypeController@index");
		Route::get('/destination_type/add', "CargoDestinationTypeController@add");
		Route::post('/destination_type/save', 'CargoDestinationTypeController@save');
		Route::get('/destination_type/edit/{id}', 'CargoDestinationTypeController@edit');
		Route::post('/destination_type/update/{id}', 'CargoDestinationTypeController@update');
		Route::get('/destination_type/delete/{id}', 'CargoDestinationTypeController@destroy');
		Route::get('/destination_type/checkname', 'CargoDestinationTypeController@checkname');

		Route::get('/cargo_salesman', "CargoSalesmanController@index");
		Route::get('/cargo_salesman/add', "CargoSalesmanController@add");
		Route::post('/cargo_salesman/save', 'CargoSalesmanController@save');
		Route::get('/cargo_salesman/edit/{id}', 'CargoSalesmanController@edit');
		Route::post('/cargo_salesman/update/{id}', 'CargoSalesmanController@update');
		Route::get('/cargo_salesman/delete/{id}', 'CargoSalesmanController@destroy');
		Route::get('/cargo_salesman/checkid', 'CargoSalesmanController@checkid');
		Route::get('/cargo_salesman/checkname', 'CargoSalesmanController@checkname');
		Route::get('/cargo_salesman/ajax_create', 'CargoSalesmanController@ajaxSave');

		Route::get('/cargo_status', "CargoStatusController@index");
		Route::get('/cargo_status/add', "CargoStatusController@add");
		Route::post('/cargo_status/save', 'CargoStatusController@save');
		Route::get('/cargo_status/edit/{id}', 'CargoStatusController@edit');
		Route::post('/cargo_status/update/{id}', 'CargoStatusController@update');
		Route::get('/cargo_status/delete/{id}', 'CargoStatusController@destroy');
		


		Route::get('/salesman', "SalesmanController@index");
		Route::get('/salesman/add', "SalesmanController@add");
		Route::post('/salesman/save', 'SalesmanController@save');
		Route::get('/salesman/edit/{id}', 'SalesmanController@edit');
		Route::post('/salesman/update/{id}', 'SalesmanController@update');
		Route::get('/salesman/delete/{id}', 'SalesmanController@destroy');
		Route::get('/salesman/checkid', 'SalesmanController@checkid');
		Route::get('/salesman/checkname', 'SalesmanController@checkname');
		Route::get('/salesman/ajax_create', 'SalesmanController@ajaxSave');

		Route::get('/jobmaster', "JobmasterController@index");
		Route::get('/jobmaster/add', "JobmasterController@add");
		Route::post('/jobmaster/save', 'JobmasterController@save');
	       
		Route::get('/jobmaster/edit/{id}', 'JobmasterController@edit');
		Route::get('/jobmaster/history/{id}', 'JobmasterController@VehiHistory');
		Route::post('/jobmaster/update/{id}', 'JobmasterController@update');
		Route::get('/jobmaster/delete/{id}', 'JobmasterController@destroy');
		Route::get('/jobmaster/checkcode', 'JobmasterController@checkcode');
		Route::get('/jobmaster/checkname', 'JobmasterController@checkname');
		Route::get('/jobmaster/job_data', "JobmasterController@getJobdata");
		Route::get('/jobmaster/job_assign/{n}', "JobmasterController@getJobAssign");
		Route::post('/jobmaster/paging', 'JobmasterController@ajaxPaging');
		Route::get('/jobmaster/ajax_create', 'JobmasterController@ajaxSave');
		Route::get('/jobmaster/job_data/{n}', 'JobmasterController@getJobdata');
		Route::get('/jobmaster/budget', "JobmasterController@budget");
		Route::post('/jobmaster/budgsave', "JobmasterController@budgetsave");
		Route::get('/jobmaster/viewbudget', "JobmasterController@viewbudget");
		Route::get('/jobmaster/budget_detail/{id}', 'JobmasterController@budgetdetail');
		Route::post('/jobmaster/updatebudget/{id}', 'JobmasterController@updatebudget');
       	Route::get('/jobmaster/print/{id}', "JobmasterController@getPrint");
       	Route::get('/jobmaster/buddelete/{id}',"JobmasterController@budDestroy");
       	Route::get('/jobmaster/preprint/{id}', "JobmasterController@getprePrint");

		Route::get('/accategory', "AccategoryController@index");
		Route::get('/accategory/add', 'AccategoryController@add');
		Route::post('/accategory/save', 'AccategoryController@save');
		Route::get('/accategory/edit/{id}', 'AccategoryController@edit');
		Route::post('/accategory/update/{id}', 'AccategoryController@update');
		Route::get('/accategory/delete/{id}', 'AccategoryController@destroy');
		Route::get('/accategory/checkname', 'AccategoryController@checkname');
		Route::get('/accategory/getcategory/{id}', 'AccategoryController@ajax_getcategory');
		Route::get('/accategory/getparent/{id}', 'AccategoryController@ajax_getParent');
     Route::post('/accategory/destroy', ['uses' => 'AccategoryController@destroyCate']);
       //Route::post('/accategory/destroy', 'AccategoryController@destroy');


		Route::get('/acgroup', "AcgroupController@index");
		Route::get('/acgroup/add', 'AcgroupController@add');
		Route::post('/acgroup/save', 'AcgroupController@save');
		Route::get('/acgroup/edit/{id}', 'AcgroupController@edit');
		Route::post('/acgroup/update/{id}', 'AcgroupController@update');
		Route::get('/acgroup/delete/{id}', 'AcgroupController@destroy');
		Route::get('/acgroup/checkname', 'AcgroupController@checkname');
		Route::get('/acgroup/checkcode', 'AcgroupController@checkcode');
		Route::get('/acgroup/getgroup/{id}', 'AcgroupController@ajax_getgroup');
		Route::get('/acgroup/getcode/{id}', 'AcgroupController@ajax_getcode');
		//Route::get('/acgroup/getcat/{id}', 'AcgroupController@ajax_getcategory');
		
		Route::get('/account_master', "AccountMasterController@index");
		
		Route::get('/account_master/add', "AccountMasterController@add");
		Route::post('/account_master/save', 'AccountMasterController@save');
		Route::get('/account_master/edit/{id}', 'AccountMasterController@edit');
		Route::post('/account_master/update/{id}', 'AccountMasterController@update');
		Route::get('/account_master/delete/{id}', 'AccountMasterController@destroy');
		Route::get('/account_master/checkcode', 'AccountMasterController@checkcode');
		Route::get('/account_master/checkdesc', 'AccountMasterController@checkdesc');
		Route::get('/account_master/getcode/{id}', 'AccountMasterController@ajax_getcode');
		Route::get('/account_master/view/{id}', 'AccountMasterController@show');
		Route::get('/account_master/get_account/{code}', 'AccountMasterController@getAccount');
		Route::get('/account_master/get_account_list/{code}', 'AccountMasterController@getAccountList');
		Route::get('/account_master/get_all_account/{no}', 'AccountMasterController@getAllAccount');
		Route::get('/account_master/custom_account/{no}', 'AccountMasterController@getCustomAccount');
		Route::get('/account_master/check_refno', 'AccountMasterController@checkRefno');
		Route::get('/account_master/check_trndate', 'AccountMasterController@checkTrndate');
		Route::get('/account_master/check_chequeno', 'AccountMasterController@checkChequeno');
		Route::get('/account_master/get_accountbudg/{no}', 'AccountMasterController@getbudgAccounts');
		Route::get('/account_master/get_accountbudginc/{no}', 'AccountMasterController@getbudgincAccounts');
		Route::get('/account_master/get_accounts/{no}', 'AccountMasterController@getAccounts');
		Route::get('/account_master/expenseac_data/{no}', 'AccountMasterController@getExpenseac');
		Route::get('/account_master/get_account_all/{no}', 'AccountMasterController@getAccountAll');
		Route::get('/account_master/ajax_create', 'AccountMasterController@ajaxSave');
		Route::get('/account_master/ajax_create_acc', 'AccountMasterController@ajaxSaveacc');
		Route::post('/account_master/paging', 'AccountMasterController@ajaxPaging');
		Route::post('/account_master/cuspaging', 'AccountMasterController@ajaxCusPaging');
		Route::post('/account_master/suppaging', 'AccountMasterController@ajaxSupPaging');
		Route::get('/account_master/ajax_account', "AccountMasterController@getAjaxAccount");
		Route::get('/account_master/get_accounts/{no}/{dp}', 'AccountMasterController@getAccounts');
		Route::get('/account_master/checkname', 'AccountMasterController@checkname');
		Route::post('/account_master/destroy',  'AccountMasterController@destroymaster'); 
		Route::post('/account_master/show_account',  'AccountMasterController@showAccount');
		Route::post('/account_master/hide_account',  'AccountMasterController@hideAccount');
		Route::get('/account_master/budget_entry', 'AccountMasterController@budgetEntry');
		Route::post('/account_master/budget_entry', 'AccountMasterController@budgetEntrySave');
		
			
		Route::get('/account_enquiry', "AccountEnquiryController@index");
		Route::get('/account_enquiry/cus', "AccountEnquiryController@indexCus");
		Route::get('/account_enquiry/sup', "AccountEnquiryController@indexSup");
		Route::post('/account_enquiry/search_account', 'AccountEnquiryController@searchAccount');
		Route::post('/account_enquiry/paging', 'AccountEnquiryController@ajaxPaging');
		Route::post('/account_enquiry/cuspaging', 'AccountEnquiryController@ajaxCusPaging');
		Route::post('/account_enquiry/suppaging', 'AccountEnquiryController@ajaxSupPaging');
		Route::post('/account_enquiry/export', 'AccountEnquiryController@dataExport');
		Route::get('/account_enquiry/address', 'AccountEnquiryController@addressList');
		Route::post('/account_enquiry/search', 'AccountEnquiryController@searchAddress');
		Route::post('/account_enquiry/address_export', 'AccountEnquiryController@addressExport');
		Route::get('/account_enquiry/os_bills/{id}', 'AccountEnquiryController@outStandingBills');
		Route::get('/account_enquiry/os_bills/{id}/{no}/{mod}/{rid}', 'AccountEnquiryController@outStandingBills');
		Route::get('/account_enquiry/os_bills/{id}/{no}', 'AccountEnquiryController@outStandingBills');
		//Route::get('/account_enquiry/os_bills/{id}/{no}/{mod}/{rid}', 'AccountEnquiryController@outStandingBills');
		//Route::get('/account_enquiry/os_bills/{id}/{mod}/{no}/{ref}/{rid}', 'AccountEnquiryController@outStandingBills');
		Route::get('/account_enquiry/reconciliation', 'AccountEnquiryController@Reconciliation');
		Route::post('/account_enquiry/search_account_ar', 'AccountEnquiryController@searchAccountAR');
		Route::post('/account_enquiry/save_reconciliation', 'AccountEnquiryController@saveReconciliation');
		Route::post('/account_enquiry/send', 'AccountEnquiryController@dataSend');
		
		
		Route::get('/account_setting', "AccountSettingController@index");
		Route::get('/account_setting/add', "AccountSettingController@add");
		Route::post('/account_setting/save', 'AccountSettingController@save');
		Route::get('/account_setting/checkname', 'AccountSettingController@checkname');
		Route::get('/account_setting/delete/{id}/{type}', 'AccountSettingController@destroy');
		Route::get('/account_setting/edit/{id}', 'AccountSettingController@edit');
		Route::post('/account_setting/update/{id}', 'AccountSettingController@update');
		
		Route::get('/header_footer', "HeaderFooterController@index");
		Route::get('/header_footer/add', "HeaderFooterController@add");
		Route::post('/header_footer/save', 'HeaderFooterController@save');
		Route::get('/header_footer/edit/{id}', 'HeaderFooterController@edit');
		Route::post('/header_footer/update/{id}', 'HeaderFooterController@update');
		Route::get('/header_footer/delete/{id}', 'HeaderFooterController@destroy');
		Route::get('/header_footer/header_data', "HeaderFooterController@getHeader");
		Route::get('/header_footer/footer_data', "HeaderFooterController@getFooter");
		
		
		Route::get('/purchase_order', ['as'=>'purchase_order.index','uses'=>'PurchaseOrderController@index','middleware' => ['permission:po-list|po-create|po-edit|po-delete']]);
		Route::get('/purchase_order/add', ['as'=>'purchase_order.add','uses'=>'PurchaseOrderController@add','middleware' => ['permission:po-create']]);
		Route::post('/purchase_order/save', ['as' => 'purchase_order.save', 'uses' => 'PurchaseOrderController@save', 'middleware' => ['permission:po-create']]);
		Route::get('/purchase_order/edit/{id}', ['as' => 'purchase_order.edit', 'uses' => 'PurchaseOrderController@edit', 'middleware' => ['permission:po-edit']]);
		Route::post('/purchase_order/update/{id}', ['as' => 'purchase_order.update', 'uses' => 'PurchaseOrderController@update', 'middleware' => ['permission:po-edit']]);
		Route::get('/purchase_order/supplier_data', "PurchaseOrderController@getSupplier");
		Route::get('/purchase_order/item_data/{id}', "PurchaseOrderController@getItem");
		Route::get('/purchase_order/checkrefno', 'PurchaseOrderController@checkRefNo');
		Route::get('/purchase_order/delete/{id}', ['as' => 'purchase_order.destroy', 'uses' => 'PurchaseOrderController@destroy', 'middleware' => ['permission:po-delete']]);
		Route::get('/purchase_order/po_data', "PurchaseOrderController@getPO");
		Route::get('/purchase_order/po_data/{id}', "PurchaseOrderController@getPO");
		Route::get('/purchase_order/po_data/{id}/{n}', "PurchaseOrderController@getPO");
		Route::get('/purchase_order/po_datatrans/{id}/{n}', "PurchaseOrderController@getPOt");
		Route::get('/purchase_order/item_details/{id}', "PurchaseOrderController@getItemDetails");
		Route::get('/purchase_order/getunit/{id}', "PurchaseOrderController@getUnit");
		Route::get('/purchase_order/order_history/{id}', "PurchaseOrderController@getOrderHistory");
		Route::get('/purchase_order/print/{id}', ['as' => 'purchase_order.getPrint', 'uses' => 'PurchaseOrderController@getPrint', 'middleware' => ['permission:po-print']]);
		Route::get('/purchase_order/supplier_data/{txt}', "PurchaseOrderController@getSupplier");
		Route::get('/purchase_order/report', "PurchaseOrderController@report");
		Route::post('/purchase_order/search', "PurchaseOrderController@getSearch");
		Route::get('/purchase_order/print/{id}/{fc}', ['as' => 'purchase_order.getPrint', 'uses' => 'PurchaseOrderController@getPrint', 'middleware' => ['permission:po-print']]);
		Route::post('/purchase_order/export', ['as' => 'purchase_order.dataExport', 'uses' => 'PurchaseOrderController@dataExport', 'middleware' => ['permission:po-print']]);
		Route::post('/purchase_order/export_po', "PurchaseOrderController@dataExportPo");
		Route::post('/purchase_order/paging', 'PurchaseOrderController@ajaxPaging');
		Route::get('/purchase_order/mr_data/{n}', "PurchaseOrderController@getMR");
		Route::get('/purchase_order/add/{id}/{n}', 'PurchaseOrderController@add'); 
		Route::get('/purchase_order/get_purchaseorder', "PurchaseOrderController@getPurchaseOrder");
		Route::get('/purchase_order/supplier_datadept/{did}', "PurchaseOrderController@getSupplierDept");
		Route::get('/purchase_order/printfc/{id}/{rid}', 'PurchaseOrderController@getPrintFc');
		Route::get('/purchase_order/get_jobpo/{jobid}', "PurchaseOrderController@getJobPo"); 
		Route::get('/purchase_order/getunit', "PurchaseOrderController@getUnit");


		Route::get('/division', "DivisionController@index");
		Route::get('/division/add', "DivisionController@add");
		Route::post('/division/save', 'DivisionController@save');
		Route::get('/division/edit/{id}', 'DivisionController@edit');
		Route::post('/division/update/{id}', 'DivisionController@update');
		Route::get('/division/delete/{id}', 'DivisionController@destroy');
		Route::get('/division/checkcode', 'DivisionController@checkcode');
		Route::get('/division/checkname', 'DivisionController@checkname');
		
		
		Route::get('/employee', 'EmployeeController@index');
		Route::get('/employee/add', 'EmployeeController@add');
	Route::post('/employee/save', 'EmployeeController@save');
		Route::get('/employee/edit/{id}', 'EmployeeController@edit');
		Route::post('/employee/update/{id}', 'EmployeeController@update');
		Route::get('/employee/delete/{id}', 'EmployeeController@destroy');
		Route::get('/employee/checkcode', 'EmployeeController@checkcode');
		Route::get('/employee/checkname', 'EmployeeController@checkname');
		Route::get('/employee/employee_data', 'EmployeeController@getEmployeedata');
		Route::get('/employee/get_employee/{id}/{n}/{y}/{m}', 'EmployeeController@getEmployee');
		Route::get('/employee/get_empdata/{id}', 'EmployeeController@getEmpData');
		Route::post('/employee/ajax_save', 'EmployeeController@ajaxSave');
		Route::post('/employee/upload', 'EmployeeController@uploadSubmit');
		Route::post('/employee/pupload', 'EmployeeController@puploadSubmit');
		Route::post('/employee/vupload', 'EmployeeController@vuploadSubmit');
		Route::post('/employee/lupload', 'EmployeeController@luploadSubmit');
		Route::post('/employee/hupload', 'EmployeeController@huploadSubmit');
		Route::post('/employee/iupload', 'EmployeeController@iuploadSubmit');
		Route::post('/employee/meupload', 'EmployeeController@meuploadSubmit');
		Route::post('/employee/fupload', 'EmployeeController@fuploadSubmit');
		Route::get('/employee/get_expinfo', 'EmployeeController@getExpinfo');
		Route::get('/employee/view/{id}', 'EmployeeController@show');
		Route::get('/employee/leave/{id}', 'EmployeeController@leave');
		Route::post('/employee/save_leave', 'EmployeeController@saveLeave');
		Route::get('/employee/rejoin/{id}', 'EmployeeController@rejoin');
		Route::post('/employee/save_rejoin', 'EmployeeController@saveRejoin');
		Route::get('/employee/resign/{id}', 'EmployeeController@resign');
		Route::post('/employee/save_resign', 'EmployeeController@saveResign');
		Route::get('/employee/rejoin-undo/{id}', 'EmployeeController@rejoinUndo');
		Route::post('/employee/paging', 'EmployeeController@ajaxPaging');
		
		
		Route::get('/vat_master', "VatMasterController@index");
		Route::get('/vat_master/add', "VatMasterController@add");
		Route::post('/vat_master/save', 'VatMasterController@save');
		Route::get('/vat_master/edit/{id}', 'VatMasterController@edit');
		Route::post('/vat_master/update/{id}', 'VatMasterController@update');
		Route::get('/vat_master/delete/{id}', 'VatMasterController@destroy');
		Route::get('/vat_master/checkcode', 'VatMasterController@checkcode');
		Route::get('/vat_master/checkname', 'VatMasterController@checkname');
		
		Route::get('/quotation', "QuotationController@index");
		Route::get('/quotation/add', "QuotationController@add");
		Route::get('/quotation/add/{id}/{n}',"QuotationController@add");
		Route::post('/quotation/save', 'QuotationController@save');
		Route::get('/quotation/edit/{id}', 'QuotationController@edit');
		Route::post('/quotation/update/{id}', 'QuotationController@update');
		Route::get('/quotation/supplier_data', "QuotationController@getSupplier");
		Route::get('/quotation/item_data/{id}', "QuotationController@getItem");
        Route::get('/quotation/item_details/{id}', "QuotationController@getItemDetails");
		Route::get('/quotation/checkrefno', 'QuotationController@checkRefNo');
		Route::get('/quotation/delete/{id}', 'QuotationController@destroy');
		Route::get('/quotation/print/{id}', 'QuotationController@print');
		Route::post('/quotation/paging', 'QuotationController@ajaxPaging');
		Route::get('/quotation/print/{id}', 'QuotationController@getPrint');
		Route::post('/quotation/search', "QuotationController@getSearch");
		Route::get('/quotation/print/{id}/{fc}', "QuotationController@getPrint");
		Route::post('/quotation/export', "QuotationController@dataExport"); //
        Route::get('/quotation/get_quotations', "QuotationController@getQuotations");
		
		
		
		Route::get('/suppliers_do', "SuppliersDOController@index");
		Route::get('/suppliers_do/add', "SuppliersDOController@add");
		Route::post('/suppliers_do/save/{id}', 'SuppliersDOController@save');
		Route::post('/suppliers_do/save', 'SuppliersDOController@save');
		Route::get('/suppliers_do/edit/{id}', 'SuppliersDOController@edit');
		Route::post('/suppliers_do/update/{id}', 'SuppliersDOController@update');
		Route::get('/suppliers_do/add/{id}', 'SuppliersDOController@add');
		Route::get('/suppliers_do/supplier_data', "SuppliersDOController@getSupplier");
		Route::get('/suppliers_do/item_data/{id}', "SuppliersDOController@getItem");
		Route::get('/suppliers_do/checkrefno', 'SuppliersDOController@checkRefNo');
		Route::get('/suppliers_do/delete/{id}', 'SuppliersDOController@destroy');
		Route::get('/suppliers_do/sdo_data', "SuppliersDOController@getSDO");
		Route::get('/suppliers_do/sdo_data/{id}', "SuppliersDOController@getSDO");
		Route::get('/suppliers_do/sdo_data/{id}/{n}', "SuppliersDOController@getSDO");
		Route::get('/suppliers_do/checkvchrno', 'SuppliersDOController@checkVchrNo');
		Route::get('/suppliers_do/checkrefno', 'SuppliersDOController@checkRefNo');
		Route::get('/suppliers_do/print/{id}/{rid}', 'SuppliersDOController@getPrint');
		Route::get('/suppliers_do/add/{id}/{n}', 'SuppliersDOController@add');
		Route::get('/suppliers_do/item_details/{id}', "SuppliersDOController@getItemDetails");
        Route::get('/suppliers_do/get_supplierdo', "SuppliersDOController@getSupplierDo");
		Route::post('/suppliers_do/search', "SuppliersDOController@getSearch");
		Route::post('/suppliers_do/export', "SuppliersDOController@dataExport");
		
		Route::get('/purchase_invoice', ['as' => 'purchase_invoice.index', 'uses' => 'PurchaseInvoiceController@index', 'middleware' => ['permission:pi-list|pi-create|pi-edit|pi-delete']]);
		Route::get('/purchase_invoice/add', ['as'=>'purchase_invoice.add','uses'=>'PurchaseInvoiceController@add','middleware' => ['permission:pi-create']]);
		Route::post('/purchase_invoice/save/{id}', ['as' => 'purchase_invoice.save', 'uses' => 'PurchaseInvoiceController@save', 'middleware' => ['permission:pi-create']] );
		Route::post('/purchase_invoice/save', ['as' => 'purchase_invoice.save', 'uses' => 'PurchaseInvoiceController@save', 'middleware' => ['permission:pi-create']] );
		Route::get('/purchase_invoice/edit/{id}', ['as' => 'purchase_invoice.edit', 'uses' => 'PurchaseInvoiceController@edit', 'middleware' => ['permission:pi-edit']]);
		Route::post('/purchase_invoice/update/{id}', ['as' => 'purchase_invoice.update', 'uses' => 'PurchaseInvoiceController@update', 'middleware' => ['permission:pi-edit']]);
		Route::get('/purchase_invoice/add/{id}/{n}', ['as'=>'purchase_invoice.add','uses'=>'PurchaseInvoiceController@add','middleware' => ['permission:pi-create']]);
		Route::post('/purchase_invoice/set_session', 'PurchaseInvoiceController@setSessionVal');
		Route::get('/purchase_invoice/supplier_data', "PurchaseInvoiceController@getSupplier");
		Route::get('/purchase_invoice/checkrefno', 'PurchaseInvoiceController@checkRefNo');
		Route::get('/purchase_invoice/delete/{id}', ['as' => 'purchase_invoice.destroy', 'uses' => 'PurchaseInvoiceController@destroy', 'middleware' => ['permission:pi-delete']]);
		Route::get('/purchase_invoice/getvoucher/{id}', "PurchaseInvoiceController@getVoucher");
		Route::get('/purchase_invoice/account_data/{id}', "PurchaseInvoiceController@getAccount");
		Route::get('/purchase_invoice/account_data/{id}/{cr}', "PurchaseInvoiceController@getAccount");
		Route::get('/purchase_invoice/pi_data', "PurchaseInvoiceController@getPI");
		Route::get('/purchase_invoice/check_invoice', 'PurchaseInvoiceController@checkInvoice');
		Route::get('/purchase_invoice/supplier_data/{no}', "PurchaseInvoiceController@getSupplier");
		Route::get('/purchase_invoice/get_invoice/{id}', "PurchaseInvoiceController@getInvoiceBySupplier");
		Route::get('/purchase_invoice/print/{id}', "PurchaseInvoiceController@getPrint");
		Route::get('/purchase_invoice/get_invoice/{id}/{n}', "PurchaseInvoiceController@getInvoiceBySupplier");
		Route::get('/purchase_invoice/order_history/{id}', "PurchaseInvoiceController@getOrderHistory");
		Route::get('/purchase_invoice/checkvchrno', 'PurchaseInvoiceController@checkVchrNo');
		Route::get('/purchase_invoice/get_invoiceset/{id}', "PurchaseInvoiceController@getInvoiceSetBySupplier"); 
		Route::get('/purchase_invoice/print/{id}/{rid}', "PurchaseInvoiceController@getPrint");
		Route::post('/purchase_invoice/search', "PurchaseInvoiceController@getSearch");
		Route::post('/purchase_invoice/export', "PurchaseInvoiceController@dataExport");
		Route::post('/purchase_invoice/paging', 'PurchaseInvoiceController@ajaxPaging');
		Route::get('/purchase_invoice/get_invoice/{id}/{n}/{val}/{rid}', "PurchaseInvoiceController@getInvoiceBySupplier");//ED12
		Route::get('/purchase_invoice/get_invoice/{id}/{n}/{pvid}', "PurchaseInvoiceController@getInvoiceBySupplierEdit");//ED12
		Route::post('/purchase_invoice/import', "PurchaseInvoiceController@getImport");
		Route::post('/purchase_invoice/export_po', "PurchaseInvoiceController@dataExportPo");
		Route::get('/purchase_invoice/item_details/{id}', "PurchaseInvoiceController@getItemDetails");
		Route::get('/purchase_invoice/getdeptvoucher/{id}', "PurchaseInvoiceController@getDeptVoucher");
		Route::get('/purchase_invoice/pi_data/{did}', "PurchaseInvoiceController@getPI");
		Route::get('/purchase_invoice/supplier_datadpt/{dpt}', "PurchaseInvoiceController@getSupplierDpt");
		Route::get('/purchase_invoice/printfc/{id}/{rid}', 'PurchaseInvoiceController@getPrintFc');
		Route::get('/purchase_invoice/getcustomer', "PurchaseInvoiceController@getCustomer");
		Route::get('/purchase_invoice/getitems', "PurchaseInvoiceController@getItems");
		Route::get('/purchase_invoice/get_purchaseinvoice', "PurchaseInvoiceController@getPurchaseInvoice");

		
		Route::get('/purchase_return', "PurchaseReturnController@index");
		Route::get('/purchase_return/add', "PurchaseReturnController@add");
		Route::post('/purchase_return/save/{id}', 'PurchaseReturnController@save');
		Route::post('/purchase_return/save', 'PurchaseReturnController@save');
		Route::get('/purchase_return/edit/{id}', 'PurchaseReturnController@edit');
		Route::get('/purchase_return/add/{id}', 'PurchaseReturnController@add');
		Route::get('/purchase_return/delete/{id}', 'PurchaseReturnController@destroy');
		Route::get('/purchase_return/checkrefno', 'PurchaseReturnController@checkRefNo');
		Route::get('/purchase_return/set_session', 'PurchaseReturnController@setSessionVal');
		Route::get('/purchase_return/print/{id}', "PurchaseReturnController@getPrint");
		Route::get('/purchase_return/checkvchrno', 'PurchaseReturnController@checkVchrNo');
		Route::post('/purchase_return/search', "PurchaseReturnController@getSearch");
		Route::post('/purchase_return/export', "PurchaseReturnController@dataExport");
		Route::post('/purchase_return/update/{id}', 'PurchaseReturnController@update');
		Route::get('/purchase_return/print/{id}/{fc}', "PurchaseReturnController@getPrint");
		Route::get('/purchase_return/getvoucher/{id}', "PurchaseReturnController@getVoucher");
		Route::post('/purchase_return/paging', 'PurchaseReturnController@ajaxPaging');
		Route::get('/purchase_return/getcustomer', "PurchaseReturnController@getCustomer");
		Route::get('/purchase_return/getitems', "PurchaseReturnController@getItems");
		Route::get('/purchase_return/getdeptvoucher/{id}', "PurchaseReturnController@getDeptVoucher");
		
		
		Route::get('/quotation_sales', ['as' => 'quotation_sales.index', 'uses' => 'QuotationSalesController@index', 'middleware' => ['permission:pi-list|qs-create|qs-edit|qs-delete']]);
		Route::get('/quotation_sales/add', ['as'=>'quotation_sales.add','uses'=>'QuotationSalesController@add','middleware' => ['permission:qs-create']]);
		Route::get('/quotation_sales/add/{id}/{n}', ['as'=>'quotation_sales.add','uses'=>'QuotationSalesController@add','middleware' => ['permission:qs-create']]);
		Route::post('/quotation_sales/save', ['as' => 'quotation_sales.save', 'uses' => 'QuotationSalesController@save', 'middleware' => ['permission:qs-create']] );
		Route::get('/quotation_sales/edit/{id}', ['as' => 'quotation_sales.edit', 'uses' => 'QuotationSalesController@edit', 'middleware' => ['permission:qs-edit']]);
		Route::post('/quotation_sales/update/{id}', ['as' => 'quotation_sales.update', 'uses' => 'QuotationSalesController@update', 'middleware' => ['permission:qs-edit']]);
		Route::get('/quotation_sales/customer_data', "QuotationSalesController@getCustomer");
		Route::get('/quotation_sales/salesman_data', "QuotationSalesController@getSalesman");
		Route::get('/quotation_sales/item_data/{id}', "QuotationSalesController@getItem");
		Route::get('/quotation_sales/checkrefno', 'QuotationSalesController@checkRefNo');
		Route::get('/quotation_sales/delete/{id}', ['as' => 'quotation_sales.destroy', 'uses' => 'QuotationSalesController@destroy', 'middleware' => ['permission:qs-delete']]);
		Route::get('/quotation_sales/get_quotation/{id}/{url}', "QuotationSalesController@getQuotation");
		Route::get('/quotation_sales/item_details/{id}', "QuotationSalesController@getItemDetails");
		Route::get('/quotation_sales/print/{id}', ['as' => 'quotation_sales.getPrint', 'uses' => 'QuotationSalesController@getPrint', 'middleware' => ['permission:qs-print']]);
		Route::post('/quotation_sales/search', "QuotationSalesController@getSearch");
		Route::get('/quotation_sales/print/{id}/{fc}', "QuotationSalesController@getPrint");
		Route::post('/quotation_sales/export', 'QuotationSalesController@dataExport');
		Route::get('/quotation_sales/checkvchrno', 'QuotationSalesController@checkVchrNo');
		Route::post('/quotation_sales/paging', 'QuotationSalesController@ajaxPaging');
		Route::get('/quotation_sales/doc_open/{id}', "QuotationSalesController@docopen");
		Route::get('/quotation_sales/revice/{id}', "QuotationSalesController@revice");
		Route::get('/quotation_sales/print/{id}/{fc}/{d}', "QuotationSalesController@getPrint");
		Route::get('/quotation_sales/get_quotations', "QuotationSalesController@getQuotations");

	
		
		
		Route::get('/sales_rental', "SalesRentalController@index");
		Route::get('/sales_rental/add', "SalesRentalController@add");
		Route::get('/sales_rental/add/{id}', "SalesRentalController@add");
		Route::get('/sales_rental/add/{id}/{n}', "SalesRentalController@add");
		Route::post('/sales_rental/save', 'SalesRentalController@save');
		Route::get('/sales_rental/edit/{id}', 'SalesRentalController@edit');
		Route::post('/sales_rental/update/{id}', 'SalesRentalController@update');
		Route::get('/sales_rental/delete/{id}', 'SalesRentalController@destroy');
        Route::post('/sales_rental/paging', 'SalesRentalController@ajaxPaging');
		Route::get('/sales_rental/print/{id}', "SalesRentalController@getPrint");
		Route::get('/sales_rental/print/{id}/{fc}', "SalesRentalController@getPrint");
		Route::get('/sales_rental/customer_data', "SalesRentalController@getCustomer");
		Route::get('/sales_rental/customer_data/{no}', "SalesRentalController@getCustomer");
		Route::get('/sales_rental/salesman_data', "SalesRentalController@getSalesman");
		Route::get('/sales_rental/item_data/{id}', "SalesRentalController@getItem");
		Route::get('/sales_rental/checkrefno', 'SalesRentalController@checkRefNo');
		Route::get('/sales_rental/getvoucher/{id}', "SalesRentalController@getVoucher");
		Route::get('/sales_rental/invoice_data', "SalesRentalController@getInvoice");
		Route::get('/sales_rental/item_details/{id}', "SalesRentalController@getItemDetails");
		Route::get('/sales_rental/get_invoice/{id}', "SalesRentalController@getInvoiceByCustomer");
		Route::get('/sales_rental/check_invoice', 'SalesRentalController@checkInvoice');
		Route::post('/sales_rental/set_session', 'SalesRentalController@setSessionVal');
		Route::get('/sales_rental/printdo/{id}', 'SalesRentalController@getPrintdo');
		Route::get('/sales_rental/tstprint', 'SalesRentalController@tstprint');
		Route::get('/sales_rental/get_invoice/{id}/{n}', "SalesRentalController@getInvoiceByCustomer");
		Route::get('/sales_rental/order_history/{id}', "SalesRentalController@getOrderHistory");
		Route::get('/sales_rental/checkvchrno', 'SalesRentalController@checkVchrNo');
		Route::get('/sales_rental/get_invoiceset/{id}', "SalesRentalController@getInvoiceSetByCustomer");
		Route::post('/sales_rental/search', "SalesRentalController@getSearch");
		Route::post('/sales_rental/export', "SalesRentalController@dataExport");
		Route::get('/sales_rental/getsaleloc/{id}', "SalesRentalController@getSaleLocation");
		Route::get('/sales_rental/get_trnno/{name}', "SalesRentalController@getTrnno");
		Route::get('/sales_rental/cust_history/{id}', "SalesRentalController@getCustHistory");
		Route::get('/sales_rental/ajax_customer', "SalesRentalController@getAjaxCust");
        
		
		Route::get('/sales_order', ['as' => 'sales_order.index', 'uses' => 'SalesOrderController@index', 'middleware' => ['permission:pi-list|so-create|so-edit|so-delete']]);
		Route::get('/sales_order/add', ['as'=>'sales_order.add','uses'=>'SalesOrderController@add','middleware' => ['permission:so-create']]);
		Route::get('/sales_order/add/{id}', ['as'=>'sales_order.add','uses'=>'SalesOrderController@add','middleware' => ['permission:so-create']]);
		Route::get('/sales_order/add/{id}/{n}', ['as'=>'sales_order.add','uses'=>'SalesOrderController@add','middleware' => ['permission:so-create']]);
		Route::post('/sales_order/save', ['as' => 'sales_order.save', 'uses' => 'SalesOrderController@save', 'middleware' => ['permission:so-create']] );
		Route::get('/sales_order/edit/{id}', ['as' => 'sales_order.edit', 'uses' => 'SalesOrderController@edit', 'middleware' => ['permission:so-edit']]);
		Route::post('/sales_order/update/{id}', ['as' => 'sales_order.update', 'uses' => 'SalesOrderController@update', 'middleware' => ['permission:so-edit']]);
		Route::get('/sales_order/customer_data', "SalesOrderController@getCustomer");
		Route::get('/sales_order/salesman_data', "SalesOrderController@getSalesman");
		Route::get('/sales_order/item_data/{id}', "SalesOrderController@getItem");
		Route::get('/sales_order/checkrefno', 'SalesOrderController@checkRefNo');
		Route::get('/sales_order/delete/{id}', ['as' => 'sales_order.destroy', 'uses' => 'SalesOrderController@destroy', 'middleware' => ['permission:so-delete']]);
		Route::get('/sales_order/get_order/{id}/{n}', "SalesOrderController@getOrder");
		Route::get('/sales_order/item_details/{id}', "SalesOrderController@getItemDetails");
		Route::get('/sales_order/print/{id}', ['as' => 'sales_order.getPrint', 'uses' => 'SalesOrderController@getPrint', 'middleware' => ['permission:so-print']]);
		Route::get('/sales_order/set_session', 'SalesOrderController@setSessionVal');
		Route::post('/sales_order/search', "SalesOrderController@getSearch");
		Route::get('/sales_order/print/{id}/{fc}', ['as' => 'sales_order.getPrint', 'uses' => 'SalesOrderController@getPrint', 'middleware' => ['permission:so-print']]);
		Route::post('/sales_order/export', 'SalesOrderController@dataExport');
		Route::get('/sales_order/newcustomer_data', "SalesOrderController@getNewCustomer");
		Route::get('/sales_order/checkvchrno', 'SalesOrderController@checkVchrNo');
		Route::post('/sales_order/paging', 'SalesOrderController@ajaxPaging');
		Route::get('/sales_order/customer_data/{did}', "SalesOrderController@getCustomer");
		Route::get('/sales_order/newcustomer_data/{did}', "SalesOrderController@getNewCustomer");
		Route::get('/sales_order/poadd/{id}', ['as'=>'sales_order.add','uses'=>'SalesOrderController@poadd','middleware' => ['permission:so-create']]);
		Route::post('/sales_order/get_orderno', 'SalesOrderController@getOrderNo');
		Route::get('/sales_order/getcounter/{id}', 'SalesOrderController@getCounter');
		Route::get('/sales_order/get_report/{id}', 'SalesOrderController@getReport');
        Route::get('/sales_order/get_salesorder', "SalesOrderController@getSalesOrder");
		
		
		Route::get('/customers_do', ['as' => 'customers_do.index', 'uses' => 'CustomersDOController@index', 'middleware' => ['permission:do-list|do-create|do-edit|do-delete']]);
		Route::get('/customers_do/add', ['as'=>'customers_do.add','uses'=>'CustomersDOController@add','middleware' => ['permission:do-create']]);
		Route::post('/customers_do/save/{id}', ['as' => 'customers_do.save', 'uses' => 'CustomersDOController@save', 'middleware' => ['permission:do-create']] );
		Route::post('/customers_do/save', ['as' => 'customers_do.save', 'uses' => 'CustomersDOController@save', 'middleware' => ['permission:do-create']] );
		Route::get('/customers_do/edit/{id}', ['as' => 'customers_do.edit', 'uses' => 'CustomersDOController@edit', 'middleware' => ['permission:do-edit']]);
		Route::get('/customers_do/add/{id}/{n}', ['as'=>'customers_do.add','uses'=>'CustomersDOController@add','middleware' => ['permission:do-create']]);
		Route::get('/customers_do/supplier_data', "CustomersDOController@getSupplier");
		Route::get('/customers_do/item_data/{id}', "CustomersDOController@getItem");
		Route::get('/customers_do/checkrefno', 'CustomersDOController@checkRefNo');
		Route::get('/customers_do/delete/{id}', ['as' => 'customers_do.destroy', 'uses' => 'CustomersDOController@destroy', 'middleware' => ['permission:do-delete']]);
		Route::get('/customers_do/sdo_data', "CustomersDOController@getSDO");
		Route::get('/customers_do/sdo_data/{id}', "CustomersDOController@getSDO");
		Route::get('/customers_do/get_order/{id}/{n}', "CustomersDOController@getOrder");
		Route::get('/customers_do/print/{id}', ['as' => 'customers_do.getPrint', 'uses' => 'CustomersDOController@getPrint', 'middleware' => ['permission:do-print']]);
		Route::get('/customers_do/set_session', 'CustomersDOController@setSessionVal');
		Route::post('/customers_do/update/{id}', 'CustomersDOController@update');
		Route::post('/customers_do/search', "CustomersDOController@getSearch");
		Route::get('/customers_do/print/{id}/{fc}', ['as' => 'customers_do.getPrint', 'uses' => 'CustomersDOController@getPrint', 'middleware' => ['permission:do-print']]);
		Route::post('/customers_do/export', 'CustomersDOController@dataExport');
		Route::get('/customers_do/checkvchrno', 'CustomersDOController@checkVchrNo');
		Route::post('/customers_do/paging', 'CustomersDOController@ajaxPaging');
		Route::get('/customers_do/item_details/{id}', "CustomersDOController@getItemDetails");
        Route::get('/customers_do/get_customerdo', "CustomersDOController@getCustomerDo");
		Route::get('/customers_do/get_pending', 'CustomersDOController@getPending'); 
		Route::get('/customers_do/edit_force/{id}', 'CustomersDOController@editForce'); //JUL7
		Route::get('/customers_do/get_order/{id}/{n}/{sid}', "CustomersDOController@getOrder");//JUL7
		
		
		Route::get('/sales_invoice', ['as' => 'sales_invoice.index', 'uses' => 'SalesInvoiceController@index', 'middleware' => ['permission:si-list|si-create|si-edit|si-delete']]);
		Route::get('/sales_invoice/add', ['as'=>'sales_invoice.add','uses'=>'SalesInvoiceController@add','middleware' => ['permission:si-create']]);
		Route::get('/sales_invoice/add/{id}/{n}', ['as'=>'sales_invoice.add','uses'=>'SalesInvoiceController@add','middleware' => ['permission:si-create']]);
		Route::post('/sales_invoice/save', ['as' => 'sales_invoice.save', 'uses' => 'SalesInvoiceController@save', 'middleware' => ['permission:si-create']]);
		Route::get('/sales_invoice/edit/{id}', ['as' => 'sales_invoice.edit', 'uses' => 'SalesInvoiceController@edit', 'middleware' => ['permission:si-edit']]);
		Route::post('/sales_invoice/update/{id}', ['as' => 'sales_invoice.update', 'uses' => 'SalesInvoiceController@update', 'middleware' => ['permission:si-edit']]);
		Route::get('/sales_invoice/customer_data', "SalesInvoiceController@getCustomer");
		Route::get('/sales_invoice/customer_data/{no}', "SalesInvoiceController@getCustomer");
		Route::get('/sales_invoice/salesman_data', "SalesInvoiceController@getSalesman");
		Route::get('/sales_invoice/item_data/{id}', "SalesInvoiceController@getItem");
		Route::get('/sales_invoice/checkrefno', 'SalesInvoiceController@checkRefNo');
		Route::get('/sales_invoice/delete/{id}', ['as' => 'sales_invoice.destroy', 'uses' => 'SalesInvoiceController@destroy', 'middleware' => ['permission:si-delete']]);
		Route::get('/sales_invoice/getvoucher/{id}', "SalesInvoiceController@getVoucher");
		Route::get('/sales_invoice/invoice_data', "SalesInvoiceController@getInvoice");
		Route::get('/sales_invoice/item_details/{id}', "SalesInvoiceController@getItemDetails");
		Route::get('/sales_invoice/get_invoice/{id}', "SalesInvoiceController@getInvoiceByCustomer");
		Route::get('/sales_invoice/check_invoice', 'SalesInvoiceController@checkInvoice');
		Route::post('/sales_invoice/set_session', 'SalesInvoiceController@setSessionVal');
		Route::get('/sales_invoice/print/{id}', ['as' => 'sales_invoice.getPrint', 'uses' => 'SalesInvoiceController@getPrint', 'middleware' => ['permission:si-print']]);
		Route::get('/sales_invoice/printdo/{id}', 'SalesInvoiceController@getPrintdo');
		Route::get('/sales_invoice/tstprint', 'SalesInvoiceController@tstprint');
		Route::get('/sales_invoice/get_invoice/{id}/{n}', "SalesInvoiceController@getInvoiceByCustomer");
		Route::get('/sales_invoice/order_history/{id}', "SalesInvoiceController@getOrderHistory");
		Route::get('/sales_invoice/checkvchrno', 'SalesInvoiceController@checkVchrNo');
		Route::get('/sales_invoice/get_invoiceset/{id}', "SalesInvoiceController@getInvoiceSetByCustomer");
		Route::post('/sales_invoice/search', "SalesInvoiceController@getSearch");
		Route::get('/sales_invoice/print/{id}/{rid}', ['as' => 'sales_invoice.getPrint', 'uses' => 'SalesInvoiceController@getPrint', 'middleware' => ['permission:si-print']]);
		Route::post('/sales_invoice/export', "SalesInvoiceController@dataExport");
		//Route::post('/sales_invoice/export', ['as' => 'sales_invoice.dataExport', 'uses' => 'SalesInvoiceController@dataExport', 'middleware' => ['permission:si-export']]);
		Route::get('/sales_invoice/getsaleloc/{id}', "SalesInvoiceController@getSaleLocation");
		Route::get('/sales_invoice/get_trnno/{name}', "SalesInvoiceController@getTrnno");
		Route::get('/sales_invoice/cust_history/{id}', "SalesInvoiceController@getCustHistory");
		Route::get('/sales_invoice/index_history/{id}', "SalesInvoiceController@getHistory");
		Route::get('/sales_invoice/ajax_customer', "SalesInvoiceController@getAjaxCust");
		Route::get('/sales_invoice/cust_history_phone/{id}', "SalesInvoiceController@getCustHistoryPhone");
		Route::post('/sales_invoice/paging', 'SalesInvoiceController@ajaxPaging');
		Route::post('/sales_invoice/paging_invoice_data', 'SalesInvoiceController@ajaxPagingInvoiceData');
		Route::get('/sales_invoice/get_invoice/{id}/{n}/{val}/{rid}', "SalesInvoiceController@getInvoiceByCustomer");//ED12
		Route::get('/sales_invoice/get_invoice/{id}/{n}/{rvid}', "SalesInvoiceController@getInvoiceByCustomerEdit");//ED12
		Route::get('/sales_invoice/get_invoicecn/{id}/{n}/{val}', "SalesInvoiceController@getInvoiceByCustomerCn");//ED12
		Route::post('/sales_invoice/export_po', "SalesInvoiceController@dataExportPo");
		Route::get('/sales_invoice/vehicle_history/{id}', "SalesInvoiceController@getvehicleHistory");
		Route::get('/sales_invoice/printfc/{id}/{rid}', ['as' => 'sales_invoice.getPrintFc', 'uses' => 'SalesInvoiceController@getPrintFc', 'middleware' => ['permission:si-print']]);
		Route::get('/sales_invoice/getdeptvoucher/{id}', "SalesInvoiceController@getDeptVoucher");
		Route::get('/sales_invoice/invoice_data/{did}', "SalesInvoiceController@getInvoice");
		Route::get('/sales_invoice/customer_datadpt/{dpt}', "SalesInvoiceController@getCustomerDpt");
		Route::get('/sales_invoice/getcustomerselect', "SalesInvoiceController@getCustomerMultiselect");
		Route::get('/sales_invoice/getitems', "SalesInvoiceController@getItems");
		Route::get('/sales_invoice/edit/{ids}/{m}/{id}', "SalesInvoiceController@editTransfer");//JUL7
		Route::get('/sales_invoice/get_billdata/{id}', "SalesInvoiceController@getBilldata");
		Route::post('/sales_invoice/upload', 'SalesInvoiceController@uploadSubmit');
		Route::get('/sales_invoice/photo-view/{id}', "SalesInvoiceController@photoView");
        Route::get('/sales_invoice/get_salesinvoice', "SalesInvoiceController@getSalesInvoice");
        
		//sales_invoice/edit/'.$sirow->id.'/SO/'.$id
		
		
		Route::get('/sales_return', ['as' => 'sales_return.index', 'uses' => 'SalesReturnController@index', 'middleware' => ['permission:sr-list|sr-create|sr-edit|sr-delete']]);
		Route::get('/sales_return/add', ['as'=>'sales_return.add','uses'=>'SalesReturnController@add','middleware' => ['permission:sr-create']]);
		Route::post('/sales_return/save/{id}', 'SalesReturnController@save');
		Route::post('/sales_return/save', 'SalesReturnController@save');
		Route::get('/sales_return/edit/{id}', ['as' => 'sales_return.edit', 'uses' => 'SalesReturnController@edit', 'middleware' => ['permission:sr-edit']]);
		Route::get('/sales_return/add/{id}', ['as'=>'sales_return.add','uses'=>'SalesReturnController@add','middleware' => ['permission:sr-create']]);
		Route::get('/sales_return/delete/{id}', ['as' => 'sales_return.destroy', 'uses' => 'SalesReturnController@destroy', 'middleware' => ['permission:sr-delete']]);
		Route::get('/sales_return/getvoucher/{id}', "SalesReturnController@getVoucher");
		Route::get('/sales_return/print/{id}', ['as' => 'sales_return.getPrint', 'uses' => 'SalesReturnController@getPrint', 'middleware' => ['permission:sr-print']]);
		Route::get('/sales_return/set_session', 'SalesReturnController@setSessionVal');
		Route::get('/sales_return/checkrefno', 'SalesReturnController@checkRefNo');
		Route::get('/sales_return/checkvchrno', 'SalesReturnController@checkVchrNo');
		Route::post('/sales_return/search', "SalesReturnController@getSearch");
		Route::post('/sales_return/export', ['as' => 'sales_return.dataExport', 'uses' => 'SalesReturnController@dataExport', 'middleware' => ['permission:sr-export']]);
		Route::post('/sales_return/update/{id}', 'SalesReturnController@update');
		Route::post('/sales_return/paging', 'SalesReturnController@ajaxPaging');
		Route::get('/sales_return/print/{id}/{rid}', "SalesReturnController@getPrint");
		Route::get('/sales_return/getcustomerselect', "SalesReturnController@getCustomerMultiselect");
		Route::get('/sales_return/getitems', "SalesReturnController@getItems");
		Route::get('/sales_return/getdeptvoucher/{id}', "SalesReturnController@getDeptVoucher");
		
		
		Route::get('/customer_receipt', ['as' => 'customer_receipt.index', 'uses' => 'CustomerReceiptController@index', 'middleware' => ['permission:rv-list|rv-create|rv-edit|rv-delete']]);
		Route::get('/customer_receipt/add', ['as'=>'customer_receipt.add','uses'=>'CustomerReceiptController@add','middleware' => ['permission:rv-create']]);
		Route::post('/customer_receipt/save', "CustomerReceiptController@save");
		Route::get('/customer_receipt/getvoucher/{id}/{type}', "CustomerReceiptController@getVoucher");
		Route::get('/customer_receipt/edit/{id}', ['as' => 'customer_receipt.edit', 'uses' => 'CustomerReceiptController@edit', 'middleware' => ['permission:rv-edit']]);
		Route::post('/customer_receipt/update/{id}', 'CustomerReceiptController@update');
		Route::get('/customer_receipt/delete/{id}', ['as' => 'customer_receipt.destroy', 'uses' => 'CustomerReceiptController@destroy', 'middleware' => ['permission:rv-delete']]);
		Route::get('/customer_receipt/checkvchrno', 'CustomerReceiptController@checkVchrNo');
		//Route::get('/customer_receipt/print2/{id}', ['as' => 'customer_receipt.getPrint2', 'uses' => 'CustomerReceiptController@getPrint2', 'middleware' => ['permission:rv-print']]);
		Route::post('/customer_receipt/paging', 'CustomerReceiptController@ajaxPaging');
		Route::get('/customer_receipt/getdeptvoucher/{id}', "CustomerReceiptController@getDeptVoucher");
		Route::get('/customer_receipt/getvoucher/{id}/{type}/{dpt}', "CustomerReceiptController@getVoucher");
		Route::get('/customer_receipt/printgrp/{id}', ['as' => 'customer_receipt.getGrpPrint', 'uses' => 'CustomerReceiptController@getGrpPrint', 'middleware' => ['permission:rv-print']]);
		Route::get('/customer_receipt/print/{id}', ['as' => 'customer_receipt.getPrint', 'uses' => 'CustomerReceiptController@getPrint', 'middleware' => ['permission:rv-print']]);
		Route::get('/customer_receipt/print2/{id}/{rid}', ['as' => 'customer_receipt.getPrint', 'uses' => 'CustomerReceiptController@getPrint', 'middleware' => ['permission:rv-print']]);
		Route::post('/customer_receipt/search', "CustomerReceiptController@getSearch");
		Route::post('/customer_receipt/export', "CustomerReceiptController@dataExport");
		Route::get('/customer_receipt/add/{id}', 'CustomerReceiptController@addAutoFill');
		
		Route::get('/other_receipt', "OtherReceiptController@index");
		Route::get('/other_receipt/add', "OtherReceiptController@add");	
		Route::post('/other_receipt/save', "OtherReceiptController@save");
		
		
		
		Route::get('/supplier_payment', ['as' => 'supplier_payment.index', 'uses' => 'SupplierPaymentController@index', 'middleware' => ['permission:si-list|pv-create|pv-edit|pv-delete']]);
		Route::get('/supplier_payment/add', ['as'=>'supplier_payment.add','uses'=>'SupplierPaymentController@add','middleware' => ['permission:pv-create']]);
		Route::post('/supplier_payment/save', "SupplierPaymentController@save");
		Route::get('/supplier_payment/edit/{id}', ['as' => 'supplier_payment.edit', 'uses' => 'SupplierPaymentController@edit', 'middleware' => ['permission:pv-edit']]);
		Route::post('/supplier_payment/update/{id}', 'SupplierPaymentController@update');
		Route::get('/supplier_payment/delete/{id}', ['as' => 'supplier_payment.destroy', 'uses' => 'SupplierPaymentController@destroy', 'middleware' => ['permission:pv-delete']]);
		Route::get('/supplier_payment/checkvchrno', 'SupplierPaymentController@checkVchrNo');
		//Route::get('/supplier_payment/print/{id}', ['as' => 'supplier_payment.getPrint', 'uses' => 'SupplierPaymentController@getPrint', 'middleware' => ['permission:pv-print']]);
		Route::get('/supplier_payment/getvoucher/{id}/{type}', "SupplierPaymentController@getVoucher");
		Route::post('/supplier_payment/paging', 'SupplierPaymentController@ajaxPaging');
		Route::get('/supplier_payment/getdeptvoucher/{id}', "SupplierPaymentController@getDeptVoucher");
		Route::get('/supplier_payment/getvoucher/{id}/{type}/{dpt}', "SupplierPaymentController@getVoucher");
		Route::get('/supplier_payment/printgrp/{id}', ['as' => 'supplier_payment.getGrpPrint', 'uses' => 'SupplierPaymentController@getGrpPrint', 'middleware' => ['permission:pv-print']]);
		Route::get('/supplier_payment/print/{id}/{rid}', ['as' => 'supplier_payment.getPrint', 'uses' => 'SupplierPaymentController@getPrint', 'middleware' => ['permission:pv-print']]);
		Route::get('/supplier_payment/cheque_details/{id}', "SupplierPaymentController@ChequeDetails");
		Route::post('/supplier_payment/che_save', "SupplierPaymentController@Chequesave");
		Route::post('/supplier_payment/search', "SupplierPaymentController@getSearch");
				Route::post('/supplier_payment/export', "SupplierPaymentController@dataExport");
		
		Route::get('/other_payment', "OtherPaymentController@index");
		Route::get('/other_payment/add', "OtherPaymentController@add");	
		Route::post('/other_payment/save', "OtherPaymentController@save");
		
		
		Route::get('/pdc_received', ['as' => 'pdc_received.index', 'uses' => 'PdcReceivedController@index', 'middleware' => ['permission:pdr-list|pdr-submit|pdr-undo|pdr-print']]);
		Route::post('/pdc_received/save', "PdcReceivedController@save");
		Route::post('/pdc_received/print', ['as' => 'pdc_received.getPrint', 'uses' => 'PdcReceivedController@getPrint', 'middleware' => ['permission:pdr-print']]);
		Route::post('/pdc_received/undo', ['as' => 'pdc_received.undo', 'uses' => 'PdcReceivedController@undo', 'middleware' => ['permission:pdr-undo']]);
		Route::get('/pdc_received/undo_list', 'PdcReceivedController@UndoList');
		Route::post('/pdc_received/cheque_submit', "PdcReceivedController@chequeSubmit");
		
		
		Route::get('/pdc_issued', ['as' => 'pdc_issued.index', 'uses' => 'PdcIssuedController@index', 'middleware' => ['permission:pdi-list|pdi-submit|pdi-undo|pdi-print']]);
		Route::post('/pdc_issued/save', "PdcIssuedController@save");
		Route::post('/pdc_issued/print', ['as' => 'pdc_issued.getPrint', 'uses' => 'PdcIssuedController@getPrint', 'middleware' => ['permission:pdi-print']]);
		Route::post('/pdc_issued/undo', ['as' => 'pdc_issued.undo', 'uses' => 'PdcIssuedController@undo', 'middleware' => ['permission:pdi-undo']]);
		Route::get('/pdc_issued/undo_list', 'PdcIssuedController@UndoList');
		
		
		Route::get('/journal', ['as' => 'journal.index', 'uses' => 'JournalController@index', 'middleware' => ['permission:jv-list|jv-create|jv-edit|jv-delete']]);
		Route::get('/journal/add', ['as'=>'journal.add','uses'=>'JournalController@add','middleware' => ['permission:jv-create']]);
		Route::post('/journal/save', "JournalController@save");
		Route::get('/journal/getvoucher/{id}', "JournalController@getVoucher");
		Route::get('/journal/delete/{id}/{n}', ['as' => 'journal.destroy', 'uses' => 'JournalController@destroy', 'middleware' => ['permission:jv-delete']]);
		Route::get('/journal/getvouchertype/{id}', 'JournalController@getVoucherType');
		Route::get('/journal/edit/{id}', ['as' => 'journal.edit', 'uses' => 'JournalController@edit', 'middleware' => ['permission:jv-edit']]);
		Route::post('/journal/update/{id}', "JournalController@update");
		Route::get('/journal/checkvchrno', 'JournalController@checkVchrNo');
		Route::get('/journal/print/{id}', ['as' => 'journal.getPrint', 'uses' => 'JournalController@getPrint', 'middleware' => ['permission:jv-print']]);
		Route::get('/journal/print/{id}/{rid}', ['as' => 'journal.getPrint', 'uses' => 'JournalController@getPrint', 'middleware' => ['permission:jv-print']]);
		Route::get('/journal/add/{id}/{rid}/{vouchertype}', ['as'=>'journal.add','uses'=>'JournalController@add','middleware' => ['permission:jv-create']]);
        Route::get('/journal/getvoucherprint', "JournalController@getVoucherprint");
        Route::get('/journal/set_transactions/{type}/{id}/{n}', "JournalController@setTransactions");
		Route::post('/journal/paging', 'JournalController@ajaxPaging');
		Route::post('/journal/recurring_add', 'JournalController@recurringAdd');



		Route::get('/voucherwise_report', "VoucherwiseReportController@index");
		Route::post('/voucherwise_report', "VoucherwiseReportController@index");
		Route::get('/voucherwise_report/print/{id}/{n}', "VoucherwiseReportController@printReport");
		Route::post('/voucherwise_report/print', "VoucherwiseReportController@getPrint");
		Route::get('/voucherwise_report/pisi_report', "VoucherwiseReportController@pisiReport");
		Route::post('/voucherwise_report/pisi_print', "VoucherwiseReportController@getPisiPrint");
		Route::get('/voucherwise_report/pisi_jobwise', "VoucherwiseReportController@pisijobReport");
		Route::post('/voucherwise_report/export', 'VoucherwiseReportController@dataExport');
		Route::post('/voucherwise_report/pisiexport', 'VoucherwiseReportController@datapisiExport');
		Route::get('/voucherwise_report/pisirtn_report', "VoucherwiseReportController@pisirtnReport");
		Route::post('/voucherwise_report/pisirtn_print', "VoucherwiseReportController@getPisirtnPrint");
		Route::get('/voucherwise_report/pisirtn_jobwise', "VoucherwiseReportController@pisirtnjobReport");
		Route::post('/voucherwise_report/pisirtnexport', 'VoucherwiseReportController@datapisirtnExport');
		
		Route::get('/voucherwise_report/pisirv_report', "VoucherwiseReportController@pisirvReport");
		Route::post('/voucherwise_report/pisirv_print', "VoucherwiseReportController@getPisirvPrint");
		Route::post('/voucherwise_report/pisirvexport', 'VoucherwiseReportController@datapisirvExport');
		Route::get('/voucherwise_report/pisirv_jobwise', "VoucherwiseReportController@pisirvjobReport");
		
		Route::get('/voucherwise_report/pisi_summary', "VoucherwiseReportController@pisiSummary");
		Route::post('/voucherwise_report/pisi_summary_print', "VoucherwiseReportController@pisiSummaryPrint");
		Route::post('/voucherwise_report/pisisummary_export', 'VoucherwiseReportController@datapisisummaryExport');
		
		
		Route::get('/trial_balance', "TrialBalanceController@index");
		Route::post('/trial_balance/search', "TrialBalanceController@getSearch");
		Route::post('/trial_balance/export', 'TrialBalanceController@dataExport');
		
		Route::get('/profit_loss', "ProfitLossController@index");
		Route::post('/profit_loss/search', "ProfitLossController@getSearch");
		Route::post('/profit_loss/export', "ProfitLossController@dataExport");
		
		
		Route::get('/balance_sheet', "BalanceSheetController@index");
		Route::post('/balance_sheet/search', "BalanceSheetController@getSearch");
		Route::post('/balance_sheet/export', "BalanceSheetController@dataExport");
		
		Route::get('/purchase_report', "PurchaseReportController@index");
		Route::post('/purchase_report/search', "PurchaseReportController@getSearch");
		Route::post('/purchase_report/summary', "PurchaseReportController@getSummary");
		Route::post('/purchase_report/print', "PurchaseReportController@getPrint");
		
		Route::get('/sales_report', "SalesReportController@index");
		Route::post('/sales_report/search', "SalesReportController@getSearch");
		Route::post('/sales_report/summary', "SalesReportController@getSummary");
		Route::post('/sales_report/print', "SalesReportController@getPrint");
		
		Route::get('/quantity_report', "QuantityReportController@index");
		Route::post('/quantity_report/search', "QuantityReportController@getSearch");
		Route::post('/quantity_report/print', "QuantityReportController@getPrint");
		Route::post('/quantity_report/export', "QuantityReportController@dataExport");
		
		
		Route::get('/stock_ledger', "StockLedgerController@index");
		Route::post('/stock_ledger/search', "StockLedgerController@getSearch");
		Route::post('/stock_ledger/print', "StockLedgerController@getPrint");
		Route::post('/stock_ledger/export', "StockLedgerController@dataExport");
		
		Route::get('/stock_transaction', "StockTransactionController@index");
		Route::post('/stock_transaction/search', "StockTransactionController@getSearch");
		//Route::post('/stock_transaction/print', "StockTransactionController@getPrint");
		Route::post('/stock_transaction/export', "StockTransactionController@dataExport");
		
		Route::get('/stock_movement', "StockMovementController@index");
		Route::post('/stock_movement/search', "StockMovementController@getSearch");
		Route::post('/stock_movement/export', "StockMovementController@dataExport");
		
		
		Route::get('/profit_analysis', "ProfitAnalysisController@index");
		Route::post('/profit_analysis/search', "ProfitAnalysisController@getSearch");
		Route::post('/profit_analysis/print', "ProfitAnalysisController@getPrint");
		Route::get('/profit_analysis/getcustomer', "ProfitAnalysisController@getCustomer");
		Route::get('/profit_analysis/getitems', "ProfitAnalysisController@getItems");
		Route::get('/profit_analysis/getsalesman', "ProfitAnalysisController@getSalesman");
		Route::get('/profit_analysis/getArea', "ProfitAnalysisController@getArea");
		Route::get('/profit_analysis/getgroup', "ProfitAnalysisController@getgroup");
		Route::get('/profit_analysis/getSubGroup', "ProfitAnalysisController@getSubGroup");
		Route::post('/profit_analysis/export', 'ProfitAnalysisController@dataExport');
		
		
		Route::get('/daily_report', "DailyReportController@index");
		Route::post('/daily_report/search', "DailyReportController@getSearch");
		Route::post('/daily_report/print', "DailyReportController@getPrint");
		Route::post('/daily_report/export', "DailyReportController@dataExport");
		Route::post('/daily_report/search_account', 'DailyReportController@searchAccount');



		Route::get('/daily_report_setting', "DailySettingController@index");
		Route::get('/daily_report_setting/detail', "DailySettingController@detail");
		Route::post('/daily_report_setting/update', "DailySettingController@update");

		Route::get('/vat_report', "VatReportController@index");
		Route::post('/vat_report/search', "VatReportController@getSearch");
		Route::post('/vat_report/print', "VatReportController@getPrint");
		Route::post('/vat_report/export', "VatReportController@dataExport");
		
		Route::get('/goods_issued', "GoodsIssuedController@index");
		Route::get('/goods_issued/add', "GoodsIssuedController@add");
		Route::post('/goods_issued/save/{id}', 'GoodsIssuedController@save');
		Route::post('/goods_issued/save', 'GoodsIssuedController@save');
		Route::get('/goods_issued/delete/{id}', 'GoodsIssuedController@destroy');
		Route::get('/goods_issued/print/{id}', "GoodsIssuedController@getPrint");
		Route::get('/goods_issued/edit/{id}', 'GoodsIssuedController@edit');
		Route::post('/goods_issued/update/{id}', 'GoodsIssuedController@update');
		Route::get('/goods_issued/getvoucher/{id}', "GoodsIssuedController@getVoucher");
		Route::post('/goods_issued/search', "GoodsIssuedController@getSearch");
		Route::post('/goods_issued/export', 'GoodsIssuedController@dataExport');
		Route::post('/goods_issued/paging', 'GoodsIssuedController@ajaxPaging');
		Route::get('/goods_issued/getdeptvoucher/{id}', "GoodsIssuedController@getDeptVoucher");
		Route::get('/goods_issued/print/{id}/{rid}', 'GoodsIssuedController@getPrint');
		
		
		Route::get('/goods_return', "GoodsReturnController@index");
		Route::get('/goods_return/add', "GoodsReturnController@add");
		Route::post('/goods_return/save/{id}', 'GoodsReturnController@save');
		Route::post('/goods_return/save', 'GoodsReturnController@save');
		Route::get('/goods_return/edit/{id}', 'GoodsReturnController@edit');
		Route::get('/goods_return/add/{id}', 'GoodsReturnController@add');
		Route::get('/goods_return/delete/{id}', 'GoodsReturnController@destroy');
		Route::get('/goods_return/set_session', 'GoodsReturnController@setSessionVal');
		Route::get('/goods_return/print/{id}', "GoodsReturnController@getPrint");
		Route::post('/goods_return/update/{id}', 'GoodsReturnController@update');
		Route::post('/goods_return/search', "GoodsReturnController@getSearch");
		Route::post('/goods_return/export', 'GoodsReturnController@dataExport');
		Route::post('/goods_return/paging', 'GoodsReturnController@ajaxPaging');
		Route::get('/goods_return/getdeptvoucher/{id}', "GoodsReturnController@getDeptVoucher");
		
		
		Route::get('/job_report', "JobReportController@index");
		Route::post('/job_report/search', "JobReportController@getSearch");
		Route::post('/job_report/print', "JobReportController@getPrint");
		Route::post('/job_report/export', "JobReportController@dataExport");
		
		
		Route::get('/utilities', "UtilityController@index");
		Route::post('/utilities/update/{type}', "UtilityController@update");
		Route::post('/utilities/updateAccMaster/{type}', "UtilityController@updateAccMaster");
		Route::post('/utilities/updateItemMasterStock/{type}', "UtilityController@updateItemMasterStock");
		Route::get('/utilities/item_log_add', "UtilityController@itemLogOBAdd");
		Route::get('/utilities/item_log_invadd', "UtilityController@itemLogInvAdd");
		Route::get('/utilities/item_log_unit_reset', "UtilityController@itemLogUnitReset");
		Route::get('/utilities/update_stmt', "UtilityController@statementUpdate");
		Route::get('/utilities/item_log_entry', "UtilityController@item_log_entry");
		Route::get('/utilities/update_pi_ref', "UtilityController@update_pi_ref");
		Route::get('/utilities/update_pv_ref', "UtilityController@update_pv_ref");
		Route::get('/utilities/ob_date_active', "UtilityController@ob_date_active");
		Route::post('/utilities/check-accounts', "UtilityController@checkAccounts");
		
		
		Route::get('/pettycash', ['as' => 'pettycash.index', 'uses' => 'PettyCashController@index', 'middleware' => ['permission:pc-list|pc-create|pc-edit|pc-delete']]);
		Route::get('/pettycash/add', ['as'=>'pettycash.add','uses'=>'PettyCashController@add','middleware' => ['permission:pc-create']]);
		Route::post('/pettycash/save', "PettyCashController@save");
		Route::get('/pettycash/getvoucher/{id}', "PettyCashController@getVoucher");
		Route::get('/pettycash/delete/{id}', ['as' => 'pettycash.destroy', 'uses' => 'PettyCashController@destroy', 'middleware' => ['permission:pc-delete']]);
		Route::get('/pettycash/getvouchertype/{id}', 'PettyCashController@getVoucherType');
		Route::get('/pettycash/edit/{id}', ['as' => 'pettycash.edit', 'uses' => 'PettyCashController@edit', 'middleware' => ['permission:pc-edit']]);
		Route::post('/pettycash/update/{id}', "PettyCashController@update");
		Route::get('/pettycash/checkvchrno', 'PettyCashController@checkVchrNo');
		Route::get('/pettycash/print/{id}', ['as' => 'pettycash.getPrint', 'uses' => 'PettyCashController@getPrint', 'middleware' => ['permission:pc-print']]);
		Route::get('/pettycash/print/{id}/{rid}', ['as' => 'pettycash.getPrint', 'uses' => 'PettyCashController@getPrint', 'middleware' => ['permission:pc-print']]);
		Route::get('/pettycash/set_transactions/{type}/{id}/{n}', "PettyCashController@setTransactions");
		//Route::get('/pettycash/set_transactions/{type}/{id}/{n}/{descr}/{ref}/{tamt}', "PettyCashController@setTransactions");
		
		Route::get('/advance_set/add', ['as'=>'advance_set.add','uses'=>'AdvanceSetController@add','middleware' => ['permission:as-list|as-create']]);
		Route::post('/advance_set/save', "AdvanceSetController@save");
		
		
		Route::get('/logdetails', "LogDetailsController@index");
		Route::post('/logdetails/search', "LogDetailsController@getSearch");

		
		Route::get('/purchase_voucher', ['as' => 'purchase_voucher.index', 'uses' => 'PurchaseVoucherController@index', 'middleware' => ['permission:vp-list|si-create|vp-edit|vp-delete']]);
		Route::get('/purchase_voucher/add', ['as'=>'purchase_voucher.add','uses'=>'PurchaseVoucherController@add','middleware' => ['permission:vp-create']]);
		Route::post('/purchase_voucher/save', "PurchaseVoucherController@save");
		Route::get('/purchase_voucher/delete/{id}', ['as' => 'purchase_voucher.destroy', 'uses' => 'PurchaseVoucherController@destroy', 'middleware' => ['permission:vp-delete']]);
		Route::get('/purchase_voucher/edit/{id}', ['as' => 'purchase_voucher.edit', 'uses' => 'PurchaseVoucherController@edit', 'middleware' => ['permission:vp-edit']]);
		Route::post('/purchase_voucher/update/{id}', "PurchaseVoucherController@update");
		Route::get('/purchase_voucher/getdeptvoucher/{id}', "PurchaseVoucherController@getDeptVoucher");
		//Route::get('/purchase_voucher/print/{id}', 'PurchaseVoucherController@getPrint');
		Route::get('/purchase_voucher/print/{id}/{rid}', 'PurchaseVoucherController@getPrint');
		Route::get('/purchase_voucher/set_transactions/{type}/{id}/{n}', "PurchaseVoucherController@setTransactions");
		
		
		Route::get('/sales_voucher', ['as' => 'sales_voucher.index', 'uses' => 'SalesVoucherController@index', 'middleware' => ['permission:vs-list|vs-create|vs-edit|vs-delete']]);
		Route::get('/sales_voucher/add', ['as'=>'sales_voucher.add','uses'=>'SalesVoucherController@add','middleware' => ['permission:vs-create']]);
		Route::post('/sales_voucher/save', "SalesVoucherController@save");
		Route::get('/sales_voucher/delete/{id}', ['as' => 'sales_voucher.destroy', 'uses' => 'SalesVoucherController@destroy', 'middleware' => ['permission:vs-delete']]);
		Route::get('/sales_voucher/edit/{id}', ['as' => 'sales_voucher.edit', 'uses' => 'SalesVoucherController@edit', 'middleware' => ['permission:vs-edit']]);
		Route::post('/sales_voucher/update/{id}', "SalesVoucherController@update");
		Route::get('/sales_voucher/getdeptvoucher/{id}', "SalesVoucherController@getDeptVoucher");
		//Route::get('/sales_voucher/print/{id}', 'SalesVoucherController@getPrint');
		Route::get('/sales_voucher/print/{id}/{rid}', 'SalesVoucherController@getPrint');
		Route::get('/sales_voucher/set_transactions/{type}/{id}/{n}', "SalesVoucherController@setTransactions");
		
		
		Route::get('/ledger_moments', "LedgerMomentsController@index");
		Route::post('/ledger_moments/search', "LedgerMomentsController@getSearch");
		Route::post('/ledger_moments/print', "LedgerMomentsController@getPrint");
		Route::post('/ledger_moments/export', "LedgerMomentsController@dataExport");
		
		Route::get('/pdc_report', "PdcReportController@index");
		Route::post('/pdc_report/search', "PdcReportController@getSearch");
		Route::post('/pdc_report/print', "PdcReportController@getPrint");
		
		Route::get('/document_report', "DocumentReportController@index");
		Route::post('/document_report/search', "DocumentReportController@getSearch");
		Route::post('/document_report/print', "DocumentReportController@getPrint");
		Route::post('/document_report/export', "DocumentReportController@dataExport");
		
		Route::get('/backup', "BackupController@index");
		Route::post('/backup/submit', "BackupController@submit");
		
		Route::get('/other_account_setting', "OtherAccountSettingController@index");
		Route::post('/other_account_setting/update', 'OtherAccountSettingController@update');
		
		Route::get('/voucher_numbers', "VoucherNumbersController@index");
		Route::post('/voucher_numbers/update', 'VoucherNumbersController@update');
		
		Route::get('/permission/edit/{id}', 'PermissionController@edit');
		Route::post('/permission/update', 'PermissionController@update');
		
		Route::get('/year_ending', "YearendingController@index");
		Route::post('/year_ending/backup', "YearendingController@backup");
		Route::get('/year_ending/step1', "YearendingController@step1");
		Route::get('/year_ending/step2', "YearendingController@step2");
		Route::post('/year_ending/step2_submit', "YearendingController@step2Submit");
		Route::get('/year_ending/step3/{id}', "YearendingController@step3");
		Route::post('/year_ending/step3_submit', "YearendingController@step3Submit");
		Route::get('/year_ending/step4', "YearendingController@step4");
		Route::post('/year_ending/step4_submit', "YearendingController@step4Submit");
		
		
		Route::get('/job_estimate', ['as' => 'job_estimate.index', 'uses' => 'JobEstimateController@index', 'middleware' => ['permission:pi-list|pi-create|pi-edit|pi-delete']]);
		Route::get('/job_estimate/add', ['as'=>'job_estimate.add','uses'=>'JobEstimateController@add','middleware' => ['permission:pi-create']]);
		Route::get('/job_estimate/add/{id}/{n}',['as'=>'job_estimate.add','uses'=>'JobEstimateController@add','middleware' => ['permission:pi-create']]);
        Route::post('/job_estimate/save', ['as' => 'job_estimate.save', 'uses' => 'JobEstimateController@save', 'middleware' => ['permission:pi-create']] );
		Route::get('/job_estimate/edit/{id}', ['as' => 'job_estimate.edit', 'uses' => 'JobEstimateController@edit', 'middleware' => ['permission:pi-edit']]);
		Route::post('/job_estimate/update/{id}', ['as' => 'job_estimate.update', 'uses' => 'JobEstimateController@update', 'middleware' => ['permission:pi-edit']]);
		Route::get('/job_estimate/customer_data', "JobEstimateController@getCustomer");
		Route::get('/job_estimate/salesman_data', "JobEstimateController@getSalesman");
		Route::get('/job_estimate/item_data/{id}', "JobEstimateController@getItem");
		Route::get('/job_estimate/checkrefno', 'JobEstimateController@checkRefNo');
		Route::get('/job_estimate/delete/{id}', ['as' => 'job_estimate.destroy', 'uses' => 'JobEstimateController@destroy', 'middleware' => ['permission:pi-delete']]);
		Route::get('/job_estimate/get_quotation/{id}/{url}', "JobEstimateController@getQuotation");
		Route::get('/job_estimate/item_details/{id}', "JobEstimateController@getItemDetails");
        Route::get('/job_estimate/get_estimate', "JobEstimateController@getEstimate");
		Route::get('/job_estimate/print/{id}', ['as' => 'job_estimate.getPrint', 'uses' => 'JobEstimateController@getPrint', 'middleware' => ['permission:pi-print']]);
		Route::post('/job_estimate/search', "JobEstimateController@getSearch");
		Route::get('/job_estimate/print/{id}/{fc}', "JobEstimateController@getPrint");
		Route::post('/job_estimate/export', ['as' => 'job_estimate.dataExport', 'uses' => 'JobEstimateController@dataExport', 'middleware' => ['permission:pi-export']]);
		Route::get('/job_estimate/ajax_create', 'JobEstimateController@ajaxCreate');
		Route::post('/job_estimate/vehsearch', "JobEstimateController@getvehSearch");
		Route::post('/job_estimate/paging', 'JobEstimateController@ajaxPaging');
		
		
		Route::get('/job_order', ['as' => 'job_order.index', 'uses' => 'JobOrderController@index', 'middleware' => ['permission:job-order-list|job-order-create|job-order-edit|job-order-delete']]);
		Route::get('/job_order/add', ['as'=>'job_order.add','uses'=>'JobOrderController@add','middleware' => ['permission:job-order-create']]);
		Route::get('/job_order/add/{id}', ['as'=>'job_order.add','uses'=>'JobOrderController@add','middleware' => ['permission:job-order-create']]);
		Route::get('/job_order/add/{id}/{n}', ['as'=>'job_order.add','uses'=>'JobOrderController@add','middleware' => ['permission:job-order-create']]);
		Route::post('/job_order/save', ['as' => 'job_order.save', 'uses' => 'JobOrderController@save', 'middleware' => ['permission:job-order-create']] );
		Route::get('/job_order/edit/{id}', ['as' => 'job_order.edit', 'uses' => 'JobOrderController@edit', 'middleware' => ['permission:job-order-edit']]);
		Route::post('/job_order/update/{id}', ['as' => 'job_order.update', 'uses' => 'JobOrderController@update', 'middleware' => ['permission:job-order-edit']]);
		Route::get('/job_order/customer_data', "JobOrderController@getCustomer");
		Route::get('/job_order/salesman_data', "JobOrderController@getSalesman");
		Route::get('/job_order/item_data/{id}', "JobOrderController@getItem");
		Route::get('/job_order/checkrefno', 'JobOrderController@checkRefNo');
		Route::get('/job_order/delete/{id}', ['as' => 'job_order.destroy', 'uses' => 'JobOrderController@destroy', 'middleware' => ['permission:job-order-delete']]);
		Route::get('/job_order/get_order/{id}/{n}', "JobOrderController@getOrder");
		Route::get('/job_order/item_details/{id}', "JobOrderController@getItemDetails");
        Route::get('/job_order/getjo', "JobOrderController@getJobOrder");
		Route::get('/job_order/print/{id}', ['as' => 'job_order.getPrint', 'uses' => 'JobOrderController@getPrint', 'middleware' => ['permission:job-order-print']]);
		Route::get('/job_order/set_session', 'JobOrderController@setSessionVal');
		Route::post('/job_order/search', "JobOrderController@getSearch");
		Route::post('/job_order/export', "JobOrderController@dataExport");
		Route::get('/job_order/print/{id}/{fc}', ['as' => 'job_order.getPrint', 'uses' => 'JobOrderController@getPrint', 'middleware' => ['permission:job-order-print']]);
		//Route::post('/job_order/export', ['as' => 'job_order.dataExport', 'uses' => 'JobOrderController@dataExport', 'middleware' => ['permission:job-order-export']]);
		Route::get('/job_order/vehicle_data/{id}', "JobOrderController@getVehicle");
		Route::post('/job_order/vehsearch', "JobOrderController@getvehSearch");
		Route::get('/job_order/vehicle_form', "JobOrderController@getVehicleForm");
		Route::get('/job_order/ajax_create', 'JobOrderController@ajaxCreate');
		Route::post('/job_order/paging', 'JobOrderController@ajaxPaging');
		Route::get('/job_order/all_vehicle', "JobOrderController@getAllVehicle");
		Route::post('/job_order/upload', 'JobOrderController@uploadSubmit');
		Route::get('/job_order/set_technician', 'JobOrderController@setTechnician'); 
		Route::post('/job_order/get_fileform', 'JobOrderController@getFileform');
		Route::get('/job_order/report', 'JobOrderController@getReport');
		Route::post('/job_order/report', "JobOrderController@getJobSearch");
		Route::get('/job_order/{type}', 'JobOrderController@getTechnicianJob');
		Route::post('/job_order/update_status', 'JobOrderController@updateStatus');
		Route::get('/job_order/jobsearch/{val}/{type}', 'JobOrderController@SearchJob');
		Route::get('/job_order/getvehicle/{id}', 'JobOrderController@getVehicleData');
		Route::get('/job_order/vehiclejob/{id}', 'JobOrderController@getVehicleJob');
		Route::get('/job_order/jobsearch_tech/{val}/{type}', 'JobOrderController@SearchJobTech');
		Route::post('/job_order/get_fileform/{si}', 'JobOrderController@getFileform');
        
		
        
		
		
		
		Route::get('/job_invoice', ['as' => 'job_invoice.index', 'uses' => 'JobInvoiceController@index', 'middleware' => ['permission:job-invoice-list|job-invoice-create|job-invoice-edit|job-invoice-delete']]);
		Route::get('/job_invoice/add', ['as'=>'job_invoice.add','uses'=>'JobInvoiceController@add','middleware' => ['permission:job-invoice-create']]);
		Route::get('/job_invoice/add/{id}/{n}', ['as'=>'job_invoice.add','uses'=>'JobInvoiceController@add','middleware' => ['permission:job-invoice-create']]);
		Route::post('/job_invoice/save', ['as' => 'job_invoice.save', 'uses' => 'JobInvoiceController@save', 'middleware' => ['permission:job-invoice-create']]);
		Route::get('/job_invoice/edit/{id}', ['as' => 'job_invoice.edit', 'uses' => 'JobInvoiceController@edit', 'middleware' => ['permission:job-invoice-edit']]);
		Route::post('/job_invoice/update/{id}', ['as' => 'job_invoice.update', 'uses' => 'JobInvoiceController@update', 'middleware' => ['permission:job-invoice-edit']]);
		Route::get('/job_invoice/item_info/{id}', "JobInvoiceController@getIteminfo");
		Route::post('/job_invoice/info_save/{id}',  "JobInvoiceController@getSaveinfo");
		
		Route::get('/job_invoice/customer_data', "JobInvoiceController@getCustomer");
		Route::get('/job_invoice/customer_data/{no}', "JobInvoiceController@getCustomer");
		Route::get('/job_invoice/salesman_data', "JobInvoiceController@getSalesman");
		Route::get('/job_invoice/item_data/{id}', "JobInvoiceController@getItem");
		Route::get('/job_invoice/checkrefno', 'JobInvoiceController@checkRefNo');
		Route::get('/job_invoice/delete/{id}', ['as' => 'job_invoice.destroy', 'uses' => 'JobInvoiceController@destroy', 'middleware' => ['permission:job-invoice-delete']]);
		Route::get('/job_invoice/getvoucher/{id}', "JobInvoiceController@getVoucher");
		Route::get('/job_invoice/invoice_data', "JobInvoiceController@getInvoice");
		Route::get('/job_invoice/item_details/{id}', "JobInvoiceController@getItemDetails");
        Route::get('/job_invoice/get_jobinvoice', "JobInvoiceController@getJobInvoice");
		Route::get('/job_invoice/get_invoice/{id}', "JobInvoiceController@getInvoiceByCustomer");
		Route::get('/job_invoice/check_invoice', 'JobInvoiceController@checkInvoice');
		Route::get('/job_invoice/set_session', 'JobInvoiceController@setSessionVal');
		Route::get('/job_invoice/print/{id}', ['as' => 'job_invoice.getPrint', 'uses' => 'JobInvoiceController@getPrint', 'middleware' => ['permission:job-invoice-print']]);
		Route::get('/job_invoice/printdo/{id}', 'JobInvoiceController@getPrintdo');
		Route::get('/job_invoice/tstprint', 'JobInvoiceController@tstprint');
		Route::get('/job_invoice/get_invoice/{id}/{n}', "JobInvoiceController@getInvoiceByCustomer");
		Route::get('/job_invoice/order_history/{id}', "JobInvoiceController@getOrderHistory");
		Route::get('/job_invoice/checkvchrno', 'JobInvoiceController@checkVchrNo');
		Route::get('/job_invoice/get_invoiceset/{id}', "JobInvoiceController@getInvoiceSetByCustomer");
		Route::post('/job_invoice/search', "JobInvoiceController@getSearch");
		Route::get('/job_invoice/print/{id}/{fc}', ['as' => 'job_invoice.getPrint', 'uses' => 'JobInvoiceController@getPrint', 'middleware' => ['permission:job-invoice-print']]);
		//Route::post('/job_invoice/export', ['as' => 'job_invoice.dataExport', 'uses' => 'JobInvoiceController@dataExport', 'middleware' => ['permission:pi-export']]);
		Route::get('/job_invoice/getdeptvoucher/{id}', "JobInvoiceController@getDeptVoucher");
		Route::post('/job_invoice/paging', 'JobInvoiceController@ajaxPaging');
		Route::post('/job_invoice/export', "JobInvoiceController@dataExport");
		
		Route::get('/location_transfer', "LocationTransferController@index");
		Route::get('/location_transfer/add', "LocationTransferController@add");
		Route::post('/location_transfer/save', "LocationTransferController@save");
		Route::get('/location_transfer/checkrefno', 'LocationTransferController@checkRefNo');
		Route::get('/location_transfer/delete/{id}', "LocationTransferController@destroy");
		Route::get('/location_transfer/edit/{id}', "LocationTransferController@edit");
		Route::post('/location_transfer/update/{id}', 'LocationTransferController@update');
		Route::get('/location_transfer/print/{id}', 'LocationTransferController@getPrint');
		
		Route::get('/package_master', "PackageMasterController@index");
		Route::get('/package_master/add', "PackageMasterController@add");
		Route::post('/package_master/save', 'PackageMasterController@save');
		Route::get('/package_master/edit/{id}', 'PackageMasterController@edit');
		Route::post('/package_master/update/{id}', 'PackageMasterController@update');
		Route::get('/package_master/delete/{id}', 'PackageMasterController@destroy');
		
		
		Route::get('/stock_transferin', "StockTransferinController@index");
		Route::get('/stock_transferin/add', "StockTransferinController@add");
		Route::post('/stock_transferin/save', "StockTransferinController@save");
		Route::get('/stock_transferin/checkrefno', 'StockTransferinController@checkRefNo');
		Route::get('/stock_transferin/delete/{id}', "StockTransferinController@destroy");
		Route::get('/stock_transferin/edit/{id}', "StockTransferinController@edit");
		Route::post('/stock_transferin/update/{id}', 'StockTransferinController@update');
		Route::get('/stock_transferin/print/{id}', 'StockTransferinController@getPrint');
		Route::get('/stock_transferin/getdeptvoucher/{id}', "StockTransferinController@getDeptVoucher");
		Route::post('/stock_transferin/search', "StockTransferinController@getSearch");
		Route::post('/stock_transferin/export', "StockTransferinController@dataExport");
		
		Route::get('/stock_transferout', "StockTransferoutController@index");
		Route::get('/stock_transferout/add', "StockTransferoutController@add");
		Route::post('/stock_transferout/save', "StockTransferoutController@save");
		Route::get('/stock_transferout/checkrefno', 'StockTransferoutController@checkRefNo');
		Route::get('/stock_transferout/delete/{id}', "StockTransferoutController@destroy");
		Route::get('/stock_transferout/edit/{id}', "StockTransferoutController@edit");
		Route::post('/stock_transferout/update/{id}', 'StockTransferoutController@update');
		Route::get('/stock_transferout/print/{id}', 'StockTransferoutController@getPrint');
		Route::get('/stock_transferout/getdeptvoucher/{id}', "StockTransferoutController@getDeptVoucher");
		Route::post('/stock_transferout/search', "StockTransferoutController@getSearch");
		Route::post('/stock_transferout/export', "StockTransferoutController@dataExport");
		
		
		Route::get('/importdata/items', "ImportDataController@importItems");
		Route::post('/importdata/save', "ImportDataController@save");
		Route::get('/importdata/accounts', "ImportDataController@importAccounts");
		Route::get('/importdata/con-loc-stock', "ImportDataController@importConLocStock");
		Route::get('/importdata/opn-balance', "ImportDataController@importOpnBalance");
		
		//Route::get('/forms/{n}', "FormManagerController@index");
		Route::get('/forms', "FormManagerController@index");
		Route::get('/forms/detail/{n}', "FormManagerController@detail");
		Route::post('/forms/update', "FormManagerController@update");
		
		Route::get('itemmaster/item_apiadd', 'ItemmasterController@item_apiadd');
		
		Route::get('/credit_note', 'CreditNoteController@index');
		Route::get('/credit_note/add', 'CreditNoteController@add');
		Route::post('/credit_note/save', "CreditNoteController@save");
		Route::get('/credit_note/delete/{id}', 'CreditNoteController@destroy');
		Route::get('/credit_note/edit/{id}', 'CreditNoteController@edit');
		Route::post('/credit_note/update/{id}', 'CreditNoteController@update');
		Route::get('/credit_note/print/{id}', 'CreditNoteController@getPrint');
		Route::get('/credit_note/getdeptvoucher/{id}', "CreditNoteController@getDeptVoucher");
        Route::get('/credit_note/print/{id}/{rid}', 'CreditNoteController@getPrint');



		
		Route::get('/debit_note', 'DebitNoteController@index');
		Route::get('/debit_note/add', 'DebitNoteController@add');
		Route::post('/debit_note/save', "DebitNoteController@save");
		Route::get('/debit_note/delete/{id}', 'DebitNoteController@destroy');
		Route::get('/debit_note/edit/{id}', 'DebitNoteController@edit');
		Route::post('/debit_note/update/{id}', 'DebitNoteController@update');
		//Route::get('/debit_note/print/{id}', 'DebitNoteController@getPrint');
		Route::get('/debit_note/getdeptvoucher/{id}', "DebitNoteController@getDeptVoucher");
		Route::get('/debit_note/print/{id}/{rid}', 'DebitNoteController@getPrint');


		Route::get('/sales_rental', "SalesRentalController@index");
		Route::get('/sales_rental/add', "SalesRentalController@add");
		Route::get('/sales_rental/add/{id}', "SalesRentalController@add");
		Route::get('/sales_rental/add/{id}/{n}', "SalesRentalController@add");
		Route::post('/sales_rental/save', 'SalesRentalController@save');
		Route::get('/sales_rental/edit/{id}', 'SalesRentalController@edit');
		Route::post('/sales_rental/update/{id}', 'SalesRentalController@update');
		Route::get('/sales_rental/delete/{id}', 'SalesRentalController@destroy');
        Route::post('/sales_rental/paging', 'SalesRentalController@ajaxPaging');
		Route::get('/sales_rental/print/{id}', "SalesRentalController@getPrint");
		Route::get('/sales_rental/print/{id}/{fc}', "SalesRentalController@getPrint");
		Route::get('/sales_rental/customer_data', "SalesRentalController@getCustomer");
		Route::get('/sales_rental/customer_data/{no}', "SalesRentalController@getCustomer");
		Route::get('/sales_rental/salesman_data', "SalesRentalController@getSalesman");
		Route::get('/sales_rental/item_data/{id}', "SalesRentalController@getItem");
		Route::get('/sales_rental/checkrefno', 'SalesRentalController@checkRefNo');
		Route::get('/sales_rental/getvoucher/{id}', "SalesRentalController@getVoucher");
		Route::get('/sales_rental/invoice_data', "SalesRentalController@getInvoice");
		Route::get('/sales_rental/item_details/{id}', "SalesRentalController@getItemDetails");
		Route::get('/sales_rental/get_invoice/{id}', "SalesRentalController@getInvoiceByCustomer");
		Route::get('/sales_rental/check_invoice', 'SalesRentalController@checkInvoice');
		Route::post('/sales_rental/set_session', 'SalesRentalController@setSessionVal');
		Route::get('/sales_rental/printdo/{id}', 'SalesRentalController@getPrintdo');
		Route::get('/sales_rental/tstprint', 'SalesRentalController@tstprint');
		Route::get('/sales_rental/get_invoice/{id}/{n}', "SalesRentalController@getInvoiceByCustomer");
		Route::get('/sales_rental/order_history/{id}', "SalesRentalController@getOrderHistory");
		Route::get('/sales_rental/checkvchrno', 'SalesRentalController@checkVchrNo');
		Route::get('/sales_rental/get_invoiceset/{id}', "SalesRentalController@getInvoiceSetByCustomer");
		Route::post('/sales_rental/search', "SalesRentalController@getSearch");
		Route::post('/sales_rental/export', "SalesRentalController@dataExport");
		Route::get('/sales_rental/getsaleloc/{id}', "SalesRentalController@getSaleLocation");
		Route::get('/sales_rental/get_trnno/{name}', "SalesRentalController@getTrnno");
		Route::get('/sales_rental/cust_history/{id}', "SalesRentalController@getCustHistory");
		Route::get('/sales_rental/ajax_customer', "SalesRentalController@getAjaxCust");
		Route::get('/sales_rental/getdeptvoucher/{id}', "SalesRentalController@getDeptVoucher");
		Route::get('/sales_rental/invoice_data/{did}', "SalesRentalController@getInvoice");
		Route::get('/sales_rental/customer_datadpt/{dpt}', "SalesRentalController@getCustomerDpt");

		
		Route::get('/quotation_rental', "QuotationRentalController@index");
		Route::get('/quotation_rental/add', "QuotationRentalController@add");
		Route::get('/quotation_rental/add/{id}/{n}', "QuotationRentalController@add");
		Route::post('/quotation_rental/save', 'QuotationRentalController@save');
		Route::get('/quotation_rental/edit/{id}', 'QuotationRentalController@edit');
		Route::post('/quotation_rental/update/{id}', 'QuotationRentalController@update');
		Route::get('/quotation_rental/delete/{id}', 'QuotationRentalController@destroy');
        Route::get('/quotation_rental/customer_data', "QuotationRentalController@getCustomer");
		Route::get('/quotation_rental/salesman_data', "QuotationRentalController@getSalesman");
		Route::get('/quotation_rental/item_data/{id}', "QuotationRentalController@getItem");
		Route::get('/quotation_rental/checkrefno', 'QuotationRentalController@checkRefNo');
        Route::get('/quotation_rental/get_quotation/{id}/{url}', "QuotationRentalController@getQuotation");
		Route::get('/quotation_rental/item_details/{id}', "QuotationRentalController@getItemDetails");
		Route::get('/quotation_rental/print/{id}', "QuotationRentalController@getPrint");
		Route::get('/quotation_rental/print/{id}/{fc}', "QuotationRentalController@getPrint");
		Route::post('/quotation_rental/search', "QuotationRentalController@getSearch");
		Route::get('/quotation_rental/checkvchrno', 'QuotationRentalController@checkVchrNo');
		Route::post('/quotation_rental/paging', 'QuotationRentalController@ajaxPaging');
		

		Route::get('/wage_entry', "WageEntryController@index");
		Route::get('/wage_entry/add', "WageEntryController@add");
		Route::post('/wage_entry/save', "WageEntryController@save");
		Route::get('/wage_entry/delete/{id}', "WageEntryController@destroy");
		Route::get('/wage_entry/edit/{id}', "WageEntryController@edit");
		Route::post('/wage_entry/update/{id}', "WageEntryController@update");
		Route::get('/pay_slip', "PaySlipController@index");
		Route::get('/pay_slip/add', "PaySlipController@add");
		Route::post('/pay_slip/search', "PaySlipController@searchEmp");
		Route::get('/pay_slip/employee/{id}/{m}', "PaySlipController@employeeSlip");
		
		Route::get('/payroll_report', "PayrollReportController@index");
		Route::post('/payroll_report/search', 'PayrollReportController@getSearch');
		Route::get('/payroll_report/job', 'PayrollReportController@jobForm');
		Route::post('/payroll_report/jobsearch', 'PayrollReportController@jobSearch');
		

		Route::get('/emp_report', "WpsReportController@index");
		Route::post('/empreport/search','WpsReportController@getSearch');
		Route::post('/empreport/export','WpsReportController@dataExport');


		Route::get('/document_report/search_form', "DocumentReportController@searchForm");
		Route::post('/document_report/search_result', 'DocumentReportController@searchResult');
		
		Route::get('/design', "DesignController@index");
		//Route::get('/design/view', "DesignController@viewer");
		//Route::get('/design/view/{id}', "DesignController@viewer");
		Route::get('/design/{id}', "DesignController@index");
		
		Route::get('/update_app/rv_modificaton', "UpdateController@RVmodificationFix");
		Route::get('/update_app/pv_modificaton', "UpdateController@PVmodificationFix");
		
		Route::get('/vehicle', "VehicleController@index");
		Route::get('/vehicle/add', "VehicleController@add");
		
		Route::post('/vehicle/save', 'VehicleController@save');
		Route::get('/vehicle/edit/{id}', 'VehicleController@edit');
		Route::post('/vehicle/update/{id}', 'VehicleController@update');
		Route::get('/vehicle/delete/{id}', 'VehicleController@destroy');
		Route::get('/vehicle/getenquiry', "VehicleController@getEnquiry");
		Route::get('/vehicle/gethistory/{id}', "VehicleController@getvehicleHistory");
		Route::get('/vehicle/checkregno', 'VehicleController@checkregno');
		
		Route::get('/jobtype', "JobtypeController@index");
		Route::get('/jobtype/add', 'JobtypeController@add');
		Route::post('/jobtype/save', 'JobtypeController@save');
		Route::get('/jobtype/edit/{id}', 'JobtypeController@edit');
		Route::post('/jobtype/update/{id}', 'JobtypeController@update');
		Route::get('/jobtype/delete/{id}', 'JobtypeController@destroy');
		Route::get('/jobtype/getjobno/{id}', 'JobtypeController@getJobNo');
		
		Route::get('/document_master', "DocumentMasterController@index");
		Route::get('/document_master/add', 'DocumentMasterController@add');
		Route::post('/document_master/save', 'DocumentMasterController@save');
		Route::get('/document_master/delete/{id}', 'DocumentMasterController@destroy');
		Route::get('/document_master/edit/{id}', 'DocumentMasterController@edit');
		Route::post('/document_master/update/{id}', 'DocumentMasterController@update');
		Route::get('/document_master/checkname', 'DocumentMasterController@checkname');
		Route::get('/document_master/get_expinfo', 'DocumentMasterController@getExpinfo');
		Route::get('/document_master/checkcode', 'DocumentMasterController@checkcode');
		Route::post('/document_master/search', "DocumentMasterController@getSearch");
		
		Route::get('/doctype', "DoctypeController@index");
		Route::get('/doctype/add', 'DoctypeController@add');
		Route::post('/doctype/save', 'DoctypeController@save');
		Route::get('/doctype/edit/{id}', 'DoctypeController@edit');
		Route::post('/doctype/update/{id}', 'DoctypeController@update');
		Route::get('/doctype/delete/{id}', 'DoctypeController@destroy');
		
		Route::get('/assets_issued', "AssetsIssuedController@index");
		Route::get('/assets_issued/add', 'AssetsIssuedController@add');
		Route::post('/assets_issued/save', 'AssetsIssuedController@save');
		Route::get('/assets_issued/edit/{id}', 'AssetsIssuedController@edit');
		Route::post('/assets_issued/update/{id}', 'AssetsIssuedController@update');
		Route::get('/assets_issued/delete/{id}', 'AssetsIssuedController@destroy');
		
		
		Route::get('/customer_enquiry', ['as' => 'customer_enquiry.index', 'uses' => 'CustomerEnquiryController@index', 'middleware' => ['permission:pi-list|qs-create|qs-edit|qs-delete']]);
		Route::get('/customer_enquiry/add', ['as'=>'customer_enquiry.add','uses'=>'CustomerEnquiryController@add','middleware' => ['permission:qs-create']]);
		Route::get('/customer_enquiry/add/{id}', ['as'=>'customer_enquiry.add','uses'=>'CustomerEnquiryController@add','middleware' => ['permission:qs-create']]);
		Route::post('/customer_enquiry/save', ['as' => 'customer_enquiry.save', 'uses' => 'CustomerEnquiryController@save', 'middleware' => ['permission:qs-create']] );
		Route::get('/customer_enquiry/edit/{id}', ['as' => 'customer_enquiry.edit', 'uses' => 'CustomerEnquiryController@edit', 'middleware' => ['permission:qs-edit']]);
		Route::post('/customer_enquiry/update/{id}', ['as' => 'customer_enquiry.update', 'uses' => 'CustomerEnquiryController@update', 'middleware' => ['permission:qs-edit']]);
		Route::get('/customer_enquiry/customer_data', "CustomerEnquiryController@getCustomer");
		Route::get('/customer_enquiry/salesman_data', "CustomerEnquiryController@getSalesman");
		Route::get('/customer_enquiry/item_data/{id}', "CustomerEnquiryController@getItem");
		Route::get('/customer_enquiry/checkrefno', 'CustomerEnquiryController@checkRefNo');
		Route::get('/customer_enquiry/delete/{id}', ['as' => 'customer_enquiry.destroy', 'uses' => 'CustomerEnquiryController@destroy', 'middleware' => ['permission:qs-delete']]);
		Route::get('/customer_enquiry/get_enquiry/{id}/{url}', "CustomerEnquiryController@getEnquiry");
		Route::get('/customer_enquiry/item_details/{id}', "CustomerEnquiryController@getItemDetails");
		Route::get('/customer_enquiry/print/{id}', ['as' => 'customer_enquiry.getPrint', 'uses' => 'CustomerEnquiryController@getPrint', 'middleware' => ['permission:qs-print']]);
		Route::post('/customer_enquiry/search', "CustomerEnquiryController@getSearch");
		Route::get('/customer_enquiry/doc_open/{id}', "CustomerEnquiryController@docopen");
		Route::get('/customer_enquiry/print/{id}/{fc}', "CustomerEnquiryController@getPrint");
		Route::post('/customer_enquiry/export', ['as' => 'customer_enquiry.dataExport', 'uses' => 'CustomerEnquiryController@dataExport', 'middleware' => ['permission:qs-export']]);
		Route::get('/customer_enquiry/checkvchrno', 'CustomerEnquiryController@checkVchrNo');
		Route::post('/customer_enquiry/paging', 'CustomerEnquiryController@ajaxPaging');
		
		Route::get('/customerleads', "CustomerLeadsController@index");
		Route::get('/customerleads/add', 'CustomerLeadsController@add');
		Route::get('/customerleads/add/{id}', 'CustomerLeadsController@add');
		Route::post('/customerleads/save', 'CustomerLeadsController@save');
		Route::get('/customerleads/edit/{id}', 'CustomerLeadsController@edit');
		Route::get('/customerleads/editadd/{id}', 'CustomerLeadsController@edit');
		Route::post('/customerleads/updates/{id}', 'CustomerLeadsController@updateAdd');
		Route::post('/customerleads/update/{id}', 'CustomerLeadsController@update');
		Route::get('/customerleads/delete/{id}', 'CustomerLeadsController@destroy');
		Route::post('/customerleads/paging', 'CustomerLeadsController@ajaxPaging');
		Route::get('/customerleads/followup/{id}', 'CustomerLeadsController@getFollowup');
		Route::get('/customerleads/new_followup', 'CustomerLeadsController@ajaxSaveFollowup');
		Route::get('/customerleads/delete_folo/{id}/{lid}', 'CustomerLeadsController@destroyFollowup');
		Route::get('/customerleads/load_followup/{id}', 'CustomerLeadsController@loadFollowup');
		Route::get('/customerleads/edit_followup', 'CustomerLeadsController@ajaxUpdateFollowup');
		Route::get('/customerleads/enquiry/{id}', 'CustomerLeadsController@getEnquiry');
		Route::get('/customerleads/set_enquiry/{id}', 'CustomerLeadsController@setEnquiry');
		Route::get('/customerleads/check_phone', 'CustomerLeadsController@checkPhone');
		Route::get('/customerleads/check_email', 'CustomerLeadsController@checkEmail');
		Route::get('/customerleads/followups/{date}', 'CustomerLeadsController@getFollowups');
		Route::get('/customerleads/getfollowup/{id}', 'CustomerLeadsController@getFollowup');
		Route::get('/customerleads/ajax_save/', 'CustomerLeadsController@ajaxCreate');
		Route::get('/customerleads/customertype/', 'CustomerLeadsController@customerType');
		Route::get('/customerleads/dophone/', 'CustomerLeadsController@doPhone');
		Route::post('/customerlead/paging', 'CustomerLeadsController@ajaxPagingleads');
		Route::post('/customerleads/saveedit/{id}', 'CustomerLeadsController@saveedit');
		Route::get('/customerleads/editdatefollow/{id}/{date}', 'CustomerLeadsController@editdateFollow');
        Route::post('/customerleads/updatefollowup/{id}', 'CustomerLeadsController@updateFollowup');
		Route::get('/customerleads/customer/', 'CustomerLeadsController@CustomerStatus');
	    Route::get('/customerleads/enquirystatus/', 'CustomerLeadsController@EnquiryStatus');
		Route::get('/customerleads/prospective/', 'CustomerLeadsController@ProspectiveStatus');
		Route::get('/customerleads/archive/', 'CustomerLeadsController@ArchiveStatus');
        Route::get('/customerleads/editFollowup/{id}/{date}', 'CustomerLeadsController@editFollowup');
        Route::get('/customerleads/set_status', 'CustomerLeadsController@setStatus');
        Route::get('/customerleads/edit/{id}/{sid}', 'CustomerLeadsController@edit');
        Route::get('/customerleads/data_transfer', 'CustomerLeadsController@getTransfer');
		Route::post('/customerleads/transfersave', 'CustomerLeadsController@TransferSave');
        

		Route::get('/leads', "LeadsController@index");
		Route::get('/leads/add', 'LeadsController@add');
		Route::post('/leads/save', 'LeadsController@save');
		Route::get('/leads/edit/{id}', 'LeadsController@edit');
		Route::post('/leads/update/{id}', 'LeadsController@update');
		Route::get('/leads/delete/{id}', 'LeadsController@destroy');
		Route::post('/leads/paging', 'LeadsController@ajaxPaging');
		Route::get('/leads/followup/{id}', 'LeadsController@getFollowup');
		Route::get('/leads/new_followup', 'LeadsController@ajaxSaveFollowup');
		Route::get('/leads/delete_folo/{id}/{lid}', 'LeadsController@destroyFollowup');
		Route::get('/leads/load_followup/{id}', 'LeadsController@loadFollowup');
		Route::get('/leads/edit_followup', 'LeadsController@ajaxUpdateFollowup');
		Route::get('/leads/set_enquiry/{id}', 'LeadsController@setEnquiry');
		
		
		Route::get('/production', ['as' => 'production.index', 'uses' => 'ProductionController@index', 'middleware' => ['permission:do-list|do-create|do-edit|do-delete']]);
		Route::get('/production/add', ['as'=>'production.add','uses'=>'ProductionController@add','middleware' => ['permission:do-create']]);
		Route::post('/production/save/{id}', ['as' => 'production.save', 'uses' => 'ProductionController@save', 'middleware' => ['permission:do-create']] );
		Route::post('/production/save', ['as' => 'production.save', 'uses' => 'ProductionController@save', 'middleware' => ['permission:do-create']] );
		Route::get('/production/edit/{id}', ['as' => 'production.edit', 'uses' => 'ProductionController@edit', 'middleware' => ['permission:do-edit']]);
		Route::get('/production/add/{id}/{n}', ['as'=>'production.add','uses'=>'ProductionController@add','middleware' => ['permission:do-create']]);
		Route::get('/production/supplier_data', "ProductionController@getSupplier");
		Route::get('/production/item_data/{id}', "ProductionController@getItem");
		Route::get('/production/checkrefno', 'ProductionController@checkRefNo');
		Route::get('/production/delete/{id}', ['as' => 'production.destroy', 'uses' => 'ProductionController@destroy', 'middleware' => ['permission:do-delete']]);
		Route::get('/production/sdo_data', "ProductionController@getSDO");
		Route::get('/production/sdo_data/{id}', "ProductionController@getSDO");
		Route::get('/production/get_order/{id}/{n}', "ProductionController@getOrder");
		Route::get('/production/print/{id}', ['as' => 'production.getPrint', 'uses' => 'ProductionController@getPrint', 'middleware' => ['permission:do-print']]);
		Route::get('/production/set_session', 'ProductionController@setSessionVal');
		Route::post('/production/update/{id}', 'ProductionController@update');
		Route::post('/production/search', "ProductionController@getSearch");
		Route::get('/production/print/{id}/{fc}', ['as' => 'production.getPrint', 'uses' => 'ProductionController@getPrint', 'middleware' => ['permission:do-print']]);
		Route::post('/production/export', ['as' => 'production.dataExport', 'uses' => 'ProductionController@dataExport', 'middleware' => ['permission:do-export']]);
		Route::get('/production/checkvchrno', 'ProductionController@checkVchrNo');
		Route::post('/production/paging', 'ProductionController@ajaxPaging');
		
		
		Route::get('/account_reports', "AccountsReportController@index");
		Route::post('/account_reports/paging', 'AccountsReportController@ajaxPaging');
		Route::post('/account_reports/search', 'AccountsReportController@getSearch');
		Route::post('/account_reports/export', 'AccountsReportController@dataExport');
		
		Route::get('/data_remove', "DataRemoveController@index");
		Route::post('/data_remove/cleardb', "DataRemoveController@clearDB");
		Route::post('/data_remove/cleardb_custom', "DataRemoveController@clearDBcustom");
		
		Route::get('/transaction_list', "TransactionListController@index");
		Route::post('/transaction_list/search', "TransactionListController@getSearch");
		Route::post('/transaction_list/export', "TransactionListController@dataExport");
		
		
		Route::get('/employee_document', "EmployeeDocumentController@index");
		Route::get('/employee_document/add', 'EmployeeDocumentController@add');
		Route::post('/employee_document/save', 'EmployeeDocumentController@save');
		Route::get('/employee_document/edit/{id}', 'EmployeeDocumentController@edit');
		Route::post('/employee_document/update/{id}', 'EmployeeDocumentController@update');
		Route::get('/employee_document/delete/{id}', 'EmployeeDocumentController@destroy');
		
		
		Route::get('/employee_report', "EmployeeReportController@index");
		Route::post('/employee_report/search', 'EmployeeReportController@getSearch');
		Route::post('/employee_report/export', 'EmployeeReportController@dataExport');
		
		Route::get('/set_report', "SetReportController@index");
		Route::get('/set_report/update', "SetReportController@update");
		Route::get('/set_report/{id}', "SetReportController@assignPrint");
		Route::get('/set_report/delete/{id}', "SetReportController@delete");
		Route::get('/set_report/save/{id}', "SetReportController@save");
		Route::get('/set_infotemplate/{code}', "SetReportController@getInfoTemplate");
		
		
		Route::get('/manufacture', ['as' => 'manufacture.index', 'uses' => 'ManufactureController@index', 'middleware' => ['permission:pi-list|pi-create|pi-edit|pi-delete']]);
		Route::get('/manufacture/add', ['as'=>'manufacture.add','uses'=>'ManufactureController@add','middleware' => ['permission:pi-create']]);
		Route::post('/manufacture/save', 'ManufactureController@save');
		Route::get('/manufacture/delete/{id}', ['as' => 'manufacture.destroy', 'uses' => 'ManufactureController@destroy', 'middleware' => ['permission:pi-delete']]);
		Route::get('/manufacture/edit/{id}', ['as' => 'manufacture.edit', 'uses' => 'ManufactureController@edit', 'middleware' => ['permission:pi-edit']]);
		Route::post('/manufacture/update/{id}', 'ManufactureController@update');
		Route::get('/manufacture/print/{id}', 'ManufactureController@getPrint');
		Route::get('/manufacture/getdeptvoucher/{id}', "ManufactureController@getDeptVoucher");
		Route::post('/manufacture/search', "ManufactureController@getSearch");
		Route::post('/manufacture/export', "ManufactureController@dataExport");
		Route::get('/manufacture/search/{id}', 'ManufactureController@getSearch');




		Route::get('/material_requisition', "MaterialRequisitionController@index");
		Route::get('/material_requisition/add', "MaterialRequisitionController@add");
		Route::post('/material_requisition/save', 'MaterialRequisitionController@save');
		Route::post('/material_requisition/save/{id}','MaterialRequisitionController@save');
	
		Route::get('/material_requisition/edit/{id}', 'MaterialRequisitionController@edit');
		Route::post('/material_requisition/update/{id}', 'MaterialRequisitionController@update');
		Route::get('/material_requisition/delete/{id}', 'MaterialRequisitionController@destroy');
		Route::get('/material_requisition/print/{id}', 'MaterialRequisitionController@getPrint');
		Route::get('/material_requisition/item_details/{id}', "MaterialRequisitionController@getItemDetails");
		Route::post('/material_requisition/search', "MaterialRequisitionController@getSearch");
		Route::post('/material_requisition/export', 'MaterialRequisitionController@dataExport');
		Route::post('/material_requisition/paging', 'MaterialRequisitionController@ajaxPaging');
		Route::post('/material_requisition/set_session', 'MaterialRequisitionController@setSessionVal');
		Route::get('/material_requisition/add/{id}/{n}', 'MaterialRequisitionController@add');
		//Route::get('/material_requisition/item_details/{id}', "MaterialRequisitionController@getItemDetails");
		Route::get('/material_requisition/get_enquiry/{id}/{url}', "MaterialRequisitionController@getEnquiry");
		
		Route::get('/ms_customer', "MsCustomerController@index");
		Route::get('/ms_customer/add', "MsCustomerController@add");
		Route::post('/ms_customer/save', 'MsCustomerController@save');
		Route::get('/ms_customer/edit/{id}', 'MsCustomerController@edit');
		Route::post('/ms_customer/update/{id}', 'MsCustomerController@update');
		Route::get('/ms_customer/delete/{id}', 'MsCustomerController@destroy');
		Route::get('/ms_customer/get_customer', "MsCustomerController@getCustomer");
		
		
		Route::get('/ms_location', "MsLocationController@index");
		Route::get('/ms_location/add', "MsLocationController@add");
		Route::post('/ms_location/save', 'MsLocationController@save');
		Route::get('/ms_location/edit/{id}', 'MsLocationController@edit');
		Route::post('/ms_location/update/{id}', 'MsLocationController@update');
		Route::get('/ms_location/delete/{id}', 'MsLocationController@destroy');
		
		
		Route::get('/ms_technician', "MsTechnicianController@index");
		Route::get('/ms_technician/add', "MsTechnicianController@add");
		Route::post('/ms_technician/save', 'MsTechnicianController@save');
		Route::get('/ms_technician/edit/{id}', 'MsTechnicianController@edit');
		Route::post('/ms_technician/update/{id}', 'MsTechnicianController@update');
		Route::get('/ms_technician/delete/{id}', 'MsTechnicianController@destroy');
		
		
		Route::get('/ms_area', "MsAreaController@index");
		Route::get('/ms_area/add', "MsAreaController@add");
		Route::post('/ms_area/save', 'MsAreaController@save');
		Route::get('/ms_area/edit/{id}', 'MsAreaController@edit');
		Route::post('/ms_area/update/{id}', 'MsAreaController@update');
		Route::get('/ms_area/delete/{id}', 'MsAreaController@destroy');

		
		Route::get('/ms_worktype', "MsWorktypeController@index");
		Route::get('/ms_worktype/add', "MsWorktypeController@add");
		Route::post('/ms_worktype/save', 'MsWorktypeController@save');
		Route::get('/ms_worktype/edit/{id}', 'MsWorktypeController@edit');
		Route::post('/ms_worktype/update/{id}', 'MsWorktypeController@update');
		Route::get('/ms_worktype/delete/{id}', 'MsWorktypeController@destroy');
		
		
		Route::get('/ms_jobmaster', "MsJobmasterController@index");
		Route::get('/ms_jobmaster/add', "MsJobmasterController@add");
		Route::post('/ms_jobmaster/save', 'MsJobmasterController@save');
		Route::get('/ms_jobmaster/edit/{id}', 'MsJobmasterController@edit');
		Route::post('/ms_jobmaster/update/{id}', 'MsJobmasterController@update');
		Route::get('/ms_jobmaster/delete/{id}', 'MsJobmasterController@destroy');
		Route::get('/ms_jobmaster/get_jobs', "MsJobmasterController@getJobs");
		
		
		Route::get('/ms_workorder', "MsWorkorderController@index");
		Route::get('/ms_workorder/add', "MsWorkorderController@add");
		Route::post('/ms_workorder/save', 'MsWorkorderController@save');
		Route::get('/ms_workorder/edit/{id}', 'MsWorkorderController@edit');
		Route::post('/ms_workorder/update/{id}', 'MsWorkorderController@update');
		Route::get('/ms_workorder/delete/{id}', 'MsWorkorderController@destroy');
		Route::post('/ms_workorder/paging', 'MsWorkorderController@ajaxPaging');
		Route::get('/ms_workorder/add/{id}', "MsWorkorderController@add");
		
		Route::get('/ms_reports', 'MsReportsController@index');
		Route::post('/ms_reports/search', 'MsReportsController@getSearch');
		Route::post('/ms_reports/export', 'MsReportsController@dataExport');
		
		Route::get('/ms_workenquiry', "MsWorkenquiryController@index");
		Route::get('/ms_workenquiry/add', "MsWorkenquiryController@add");
		Route::post('/ms_workenquiry/save', 'MsWorkenquiryController@save');
		Route::get('/ms_workenquiry/edit/{id}', 'MsWorkenquiryController@edit');
		Route::post('/ms_workenquiry/update/{id}', 'MsWorkenquiryController@update');
		Route::get('/ms_workenquiry/delete/{id}', 'MsWorkenquiryController@destroy');
		Route::post('/ms_workenquiry/paging', 'MsWorkenquiryController@ajaxPaging');
		Route::get('/ms_workenquiry/enquiry_list', "MsWorkenquiryController@getEnquiry");
		Route::post('/ms_workenquiry/ajax_enquiry_list', 'MsWorkenquiryController@ajaxGetEnquiry');

		
		Route::get('/purchase_split', "PurchaseSplitController@index");
		Route::get('/purchase_split/add', "PurchaseSplitController@add");
		Route::get('/purchase_split/add/{id}', "PurchaseSplitController@add");
		Route::post('/purchase_split/save/{id}', 'PurchaseSplitController@save');
		Route::post('/purchase_split/save', 'PurchaseSplitController@save');
		Route::get('/purchase_split/edit/{id}', 'PurchaseSplitController@edit');
        Route::post('/purchase_split/search', "PurchaseSplitController@getSearch");

		Route::get('/purchase_split/delete/{id}', 'PurchaseSplitController@destroy');
		Route::get('/purchase_split/checkrefno', 'PurchaseSplitController@checkRefNo');
		Route::get('/purchase_split/print/{id}', "PurchaseSplitController@getPrint");
		Route::get('/purchase_split/checkvchrno', 'PurchaseSplitController@checkVchrNo');
		Route::post('/purchase_split/paging', 'PurchaseSplitController@ajaxPaging');
		Route::post('/purchase_split/update/{id}', 'PurchaseSplitController@update');
		Route::get('/purchase_split/print/{id}/{rid}', "PurchaseSplitController@getPrint");
		Route::post('/purchase_split/export', "PurchaseSplitController@dataExport");
		Route::get('/purchase_split/getcustomer', "PurchaseSplitController@getCustomer");
		
		
		Route::get('/sales_split', "SalesSplitController@index");
		Route::get('/sales_split/add', "SalesSplitController@add");
		Route::get('/sales_split/add/{id}', "SalesSplitController@add");
		Route::post('/sales_split/save/{id}', 'SalesSplitController@save');
		Route::post('/sales_split/save', 'SalesSplitController@save');
		Route::get('/sales_split/edit/{id}', 'SalesSplitController@edit');
		Route::get('/sales_split/delete/{id}', 'SalesSplitController@destroy');
		Route::get('/sales_split/checkrefno', 'SalesSplitController@checkRefNo');
		Route::get('/sales_split/print/{id}', "SalesSplitController@getPrint");
		Route::get('/sales_split/checkvchrno', 'SalesSplitController@checkVchrNo');
		Route::post('/sales_split/paging', 'SalesSplitController@ajaxPaging');
		Route::post('/sales_split/update/{id}', 'SalesSplitController@update');
		Route::get('/sales_split/print/{id}/{rid}', "SalesSplitController@getPrint");
		Route::post('/sales_split/export', "SalesSplitController@dataExport");
		Route::post('/sales_split/search', "SalesSplitController@getSearch");
		
		
		Route::get('/tools', "ToolsController@index");
		Route::post('/tools/search/{type}', "ToolsController@search");
		

		Route::post('/sales_split/export', "SalesSplitController@dataExport");
		Route::post('/sales_split/search', "SalesSplitController@getSearch");
		Route::get('/sales_split/getcustomer', "SalesSplitController@getCustomer");  //


		Route::get('/buildingmaster', "BuildingMasterController@index");
		Route::get('/buildingmaster/add', "BuildingMasterController@add");
		Route::post('/buildingmaster/save', 'BuildingMasterController@save');
		Route::get('/buildingmaster/edit/{id}', 'BuildingMasterController@edit');
		Route::get('/buildingmaster/checkcode', 'BuildingMasterController@checkCode');
		Route::post('/buildingmaster/update/{id}', 'BuildingMasterController@update');
		Route::get('/buildingmaster/delete/{id}', 'BuildingMasterController@destroy');
		Route::get('/buildingmaster/getprefix/{id}', 'BuildingMasterController@getPrefix');
		Route::post('/buildingmaster/upload', 'BuildingMasterController@uploadss');

		Route::get('/flatmaster', "FlatMasterController@index");
		Route::get('/flatmaster/flat_list/{val}', "FlatMasterController@flatList");
		Route::get('/flatmaster/flat_list/{val}/{f}', "FlatMasterController@flatList");
		Route::post('/flatmaster/save', 'FlatMasterController@save');
		Route::get('/flatmaster/add', "FlatMasterController@add");
		Route::post('/flatmaster/save', 'FlatMasterController@save');
		Route::get('/flatmaster/edit/{id}', 'FlatMasterController@edit');
		Route::post('/flatmaster/update/{id}', 'FlatMasterController@update');
		Route::get('/flatmaster/delete/{id}', 'FlatMasterController@destroy');
		Route::get('/flatmaster/checkcode', 'FlatMasterController@checkCode');
		

		Route::get('/contractbuilding', "ContractBuildingController@index");
		Route::get('/contractbuilding/add', "ContractBuildingController@add");
		Route::get('/contractbuilding/add/{id}', "ContractBuildingController@add");
		Route::post('/contractbuilding/save', 'ContractBuildingController@save');


		Route::get('/contractbuilding/oreceipt_add', 'ContractBuildingController@ajaxoReceiptAdd');
		Route::post('/contractbuilding/save_rentallo', 'ContractBuildingController@saveRentAllocation');
		Route::get('/contractbuilding/edit/{id}', 'ContractBuildingController@edit');
	
		Route::get('/contractbuilding/rent_allocate', 'ContractBuildingController@ajaxAllocate');
		Route::get('/contractbuilding/receipt_add', 'ContractBuildingController@ajaxReceiptAdd');
		Route::post('/contractbuilding/save_receipt', 'ContractBuildingController@saveReceipt'); 
		Route::post('/contractbuilding/save_deposit', 'ContractBuildingController@saveDeposit'); 
		Route::post('/contractbuilding/save_otherrv', 'ContractBuildingController@saveOtherRv'); 
		Route::get('/contractbuilding/printrv/{n}/{id}', 'ContractBuildingController@printRv');
		Route::post('/contractbuilding/paging', 'ContractBuildingController@ajaxPaging');
		Route::get('/contractbuilding/enquiry', "ContractBuildingController@enquiry");
		Route::post('/contractbuilding/ajax-enquiry', 'ContractBuildingController@ajaxEnquiry');
		Route::get('/contractbuilding/renew/{id}', "ContractBuildingController@renew");
        Route::post('/contractbuilding/search', "ContractBuildingController@getSearch");
        Route::get('/contractbuilding/printjv/{id}', 'ContractBuildingController@printJv');
		Route::get('/contractbuilding/mail/{id}', "ContractBuildingController@sendmail");
		Route::get('/contractbuilding/printcontr/{id}/{rid}', 'ContractBuildingController@printcontract');
		Route::get('/contractbuilding/printinvo/{id}/{rid}', 'ContractBuildingController@printinvo');
		//Route::get('/contractbuilding/os_rvs/{id}/{n}', "ContractBuildingController@osRvs");
		Route::post('/contractbuilding/update/{id}', 'ContractBuildingController@update');
		//Route::get('/contractbuilding/os_rvs/{id}/{n}', "ContractBuildingController@osRvs");
		Route::post('/contractbuilding/update/{id}', 'ContractBuildingController@update');
        //Route::get('/contractbuilding/os_rvs/{id}/{n}', "ContractBuildingController@osRvs");
        Route::post('/contractbuilding/update/{id}', 'ContractBuildingController@update');
        Route::get('/contractbuilding/mail/{id}', "ContractBuildingController@sendmail");
		//Route::get('/contractbuilding/os_rvs/{id}/{n}', "ContractBuildingController@osRvs");
		Route::post('/contractbuilding/update/{id}', 'ContractBuildingController@update');
        Route::get('/contractbuilding/mail/{id}', "ContractBuildingController@sendmail");
		Route::get('/contractbuilding/os_rvs/{id}/{n}', "ContractBuildingController@osRvs");
		Route::post('/contractbuilding/update/{id}', 'ContractBuildingController@update');
		Route::get('/contractbuilding/delete/{id}', 'ContractBuildingController@destroy');
		Route::get('/contractbuilding/os_rvs/{id}/{n}/{rid}', "ContractBuildingController@osRvs");
		Route::get('/contractbuilding/printsi/{id}', 'ContractBuildingController@printSi');
		Route::get('/contractbuilding/close/{id}', 'ContractBuildingController@doClose');
		Route::post('/contractbuilding/close/{id}', 'ContractBuildingController@submitClose');
		Route::post('/contractbuilding/renew_save', 'ContractBuildingController@renewSave');
		Route::get('/contractbuilding/settle/{id}', "ContractBuildingController@settlement");
		Route::post('/contractbuilding/save_settlement', "ContractBuildingController@saveSettlement");
		Route::get('/contractbuilding/get_enddate/{d}/{m}', "ContractBuildingController@getEnddate");
		Route::get('/contractbuilding/closed', "ContractBuildingController@closed");
		Route::post('/contractbuilding/ajax-closed', 'ContractBuildingController@ajaxClosed');
		Route::post('/contractbuilding/save_payment', 'ContractBuildingController@savePayment');
		Route::get('/contractbuilding/rent_reallocate', 'ContractBuildingController@ajaxReallocate');
		Route::get('/contractbuilding/receipt_readd', 'ContractBuildingController@ajaxReceiptReAdd');
		Route::get('/contractbuilding/os_rvs/{id}/{n}/{rid}/{m}', "ContractBuildingController@osRvs"); //NOV24
		Route::get('/contractbuilding/get_orvdetails/{rid}/{id}', "ContractBuildingController@getOrvDetails"); //NOV24
		Route::get('/contractbuilding/printpv/{id}', 'ContractBuildingController@printPv');
		Route::post('/contractbuilding/upload', 'ContractBuildingController@uploadSubmit');
		Route::get('/contractbuilding/history', "ContractBuildingController@history");
		Route::post('/contractbuilding/ajax-history', 'ContractBuildingController@ajaxHistory');
		Route::get('/contractbuilding/rent_calculate', 'ContractBuildingController@ajaxRentCalculate');
		Route::post('/contractbuilding/update_renew/{id}', 'ContractBuildingController@updateRenew');
		Route::get('/contractbuilding/print_all/{id}', 'ContractBuildingController@printAll');
		Route::get('/contractbuilding/attach/{id}', 'ContractBuildingController@attachment');
		Route::post('/contractbuilding/get_fileform', 'ContractBuildingController@getFileform');
		Route::post('/contractbuilding/attach_save', 'ContractBuildingController@attachmentSave');
		Route::post('/contractbuilding/upload-contract', 'ContractBuildingController@uploadContract');

		Route::get('/contractbuilding/expiry', "ContractExpiryController@expiry");
        Route::post('/contractbuilding/expirysearch', "ContractExpiryController@getSearch");
        Route::post('/contractbuilding/expirytemplate', 'ContractExpiryController@expiryTemplate');
		Route::post('/contractbuilding/expiryemail', 'ContractExpiryController@expiryEmail');
		Route::get('/contractbuilding/getmessage/{id}', 'ContractExpiryController@getMessage');



        Route::get('/manual_journal',"ManualJournalController@index");
        Route::get('/manual_journal/add', "ManualJournalController@add");
		Route::post('/manual_journal/save', "ManualJournalController@save");
		Route::get('/manual_journal/getvoucher/{id}',"ManualJournalController@getVoucher");
        Route::get('/manual_journal/delete/{id}/{n}', "ManualJournalController@destroy");
		Route::get('/manual_journal/getvouchertype/{id}', "ManualJournalController@getVoucherType");
		Route::get('/manual_journal/edit/{id}', "ManualJournalController@edit");
		Route::post('/manual_journal/update/{id}', "ManualJournalController@update");
		Route::get('/manual_journal/checkvchrno', "ManualJournalController@checkVchrNo");
		Route::get('/manual_journal/print/{id}', "ManualJournalController@getPrint");
		Route::get('/manual_journal/print/print/{id}/{rid}', "ManualJournalController@getPrint");
        Route::post('/manual_journal/add/{id}/{rid}/{vouchertype}', "ManualJournalController@add");
		Route::post('/manual_journal/getvoucherprint}', "ManualJournalController@getVoucherprint");
		Route::get('/manual_journal/set_transactions/{type}/{id}/{n}', "ManualJournalController@setTransactions");



		Route::get('/realestate', "RealestateStatementController@index");
		Route::post('/realestate/search_account', 'RealestateStatementController@searchAccount');
		Route::post('/realestate/paging', 'RealestateStatementController@ajaxPaging');
		Route::post('/realestate/export', 'RealestateStatementController@dataExport');
		Route::get('/realestate/address', 'RealestateStatementController@addressList');
		Route::post('/realestate/search', 'RealestateStatementController@searchAddress');
		Route::post('/realestate/address_export', 'RealestateStatementController@addressExport');
		Route::get('/realestate/os_bills/{id}', 'RealestateStatementController@outStandingBills');
		Route::get('/realestate/os_bills/{id}/{no}/{mod}/{rid}', 'RealestateStatementController@outStandingBills');
		Route::get('/realestate/os_bills/{id}/{no}', 'RealestateStatementController@outStandingBills');

		Route::get('/duration', "DurationMasterController@index");
		Route::get('/duration/add', "DurationMasterController@add");
		Route::get('/duration/add/{id}', "DurationMasterController@add");
		Route::post('/duration/save', 'DurationMasterController@save');
        Route::get('/duration/edit/{id}', 'DurationMasterController@edit');
        Route::post('/duration/update', 'DurationMasterController@Update');
		Route::post('/duration/update/{id}', 'DurationMasterController@update');
		Route::get('/duration/delete/{id}', 'DurationMasterController@destroy');
		Route::get('/duration/checkdays', 'DurationMasterController@CalculateDays');
	//	Route::get('/duration/checkdays/{checkmon}', 'DurationMasterController@CalculateDays');


	Route::get('/cheque_details', "ChequeDetailsController@index");
	Route::post('/cheque_details/paging', 'ChequeDetailsController@ajaxPaging');
	Route::get('/cheque_details/add', "ChequeDetailsController@add");
	Route::post('/cheque_details/save', 'ChequeDetailsController@save');
	Route::get('/cheque_details/edit/{id}', 'ChequeDetailsController@edit');
	Route::post('/cheque_details/update/{id}', 'ChequeDetailsController@update');
	Route::get('/cheque_details/delete/{id}', 'ChequeDetailsController@destroy');
    Route::get('/cheque_details/print/{id}/{rid}', 'ChequeDetailsController@getPrint');
	Route::get('/cheque_details/printfc/{id}/{rid}', 'ChequeDetailsController@getPrintFc');
	//Route::get('/cheque_details/bank_data', "SalesOrderController@getBank");	



		Route::get('/machine', "MachineController@index");
		Route::get('/machine/add', "MachineController@add");
		Route::post('/machine/save', 'MachineController@save');
		Route::get('/machine/edit/{id}', 'MachineController@edit');
		Route::post('/machine/update/{id}', 'MachineController@update');
		Route::get('/machine/delete/{id}', 'MachineController@destroy');
		
		Route::get('/paper', "PaperController@index");
		Route::get('/paper/add', "PaperController@add");
		Route::post('/paper/save', 'PaperController@save');
		Route::get('/paper/edit/{id}', 'PaperController@edit');
		Route::post('/paper/update/{id}', 'PaperController@update');
		Route::get('/paper/delete/{id}', 'PaperController@destroy');
		
		Route::get('/contract_type', "ContractTypeController@index");
		Route::get('/contract_type/add', "ContractTypeController@add");
		Route::post('/contract_type/save', 'ContractTypeController@save');
		Route::get('/contract_type/edit/{id}', 'ContractTypeController@edit');
		Route::post('/contract_type/update/{id}', 'ContractTypeController@update');
		Route::get('/contract_type/delete/{id}', 'ContractTypeController@destroy');
		Route::get('/contract_type/check_code', 'ContractTypeController@checkCode');
		
		
		Route::get('/contract', "ContractController@index");
		Route::get('/contract/add', "ContractController@add");
		Route::post('/contract/save', 'ContractController@save');
		Route::get('/contract/edit/{id}', 'ContractController@edit');
		Route::post('/contract/update/{id}', 'ContractController@update');
		Route::get('/contract/delete/{id}', 'ContractController@destroy');
		Route::get('/contract/check_code', 'ContractController@checkCode');
		Route::post('/contract/paging', 'ContractController@ajaxPaging');
		Route::get('/contract/read/{id}', 'ContractController@machineRead');
		Route::post('/contract/readSave/{id}', 'ContractController@machineReadSave');
		Route::get('/contract/read-delete/{id}/{rid}', 'ContractController@machineReadDelete');
		Route::get('/contract/read-edit/{id}/{rid}', 'ContractController@machineReadEdit');
		Route::post('/contract/readeditSave/{id}/{rid}', 'ContractController@machineReadEditSave');
		
		Route::get('/contra_type', "ContraTypeController@index");
		Route::get('/contra_type/add', "ContraTypeController@add");
		Route::post('/contra_type/save', 'ContraTypeController@save');
		Route::get('/contra_type/edit/{id}', 'ContraTypeController@edit');
		Route::post('/contra_type/update/{id}', 'ContraTypeController@update');
		Route::get('/contra_type/delete/{id}', 'ContraTypeController@destroy');
		Route::get('/contra_type/check_type', 'ContraTypeController@checkType');
		Route::get('/contra_type/get_details/{id}', 'ContraTypeController@getDetails');
		Route::get('/contra_type/get_flat/{id}', 'ContraTypeController@getFlat');
		
		Route::get('/contra_type/add-settings', "ContraTypeController@addSettings");
		Route::post('/contra_type/save-settings', "ContraTypeController@saveSettings");
		Route::get('/contra_type/edit-settings/{id}', "ContraTypeController@editSettings");
		Route::post('/contra_type/update-settings/{id}', "ContraTypeController@updateSettings");
		Route::get('/contra_type/list-settings', "ContraTypeController@listSettings");
		Route::get('/contra_type/delete-settings/{id}', 'ContraTypeController@destroySettings');
		
		Route::get('/cargo_receipt', "CargoReceiptController@index");
		Route::get('/cargo_receipt/add', "CargoReceiptController@add");
		Route::post('/cargo_receipt/save', 'CargoReceiptController@save');
		Route::get('/cargo_receipt/edit/{id}', "CargoReceiptController@edit");
		Route::post('/cargo_receipt/update/{id}', 'CargoReceiptController@update');
		Route::post('/cargo_receipt/upload-attachment', 'CargoReceiptController@uploadAttachment');
		Route::post('/cargo_receipt/get_fileform', 'CargoReceiptController@getFileform');
		Route::get('/cargo_receipt/get_consignee', "CargoReceiptController@getConsignee");
		Route::get('/cargo_receipt/create_consignee', "CargoReceiptController@createConsignee");
		Route::get('/cargo_receipt/get_shipper', "CargoReceiptController@getShipper");
		Route::get('/cargo_receipt/create_shipper', "CargoReceiptController@createShipper");
		Route::get('/cargo_receipt/delete/{id}', 'CargoReceiptController@destroy');
		Route::get('/cargo_receipt/return/{id}', 'CargoReceiptController@return');
		Route::post('/cargo_receipt/paging', 'CargoReceiptController@ajaxPaging');
		Route::get('/cargo_receipt/print/{id}', "CargoReceiptController@getPrint");
		Route::get('/cargo_receipt/preprint/{id}/{rid}', "CargoReceiptController@getPreprint");
		Route::get('/cargo_receipt/print_receipt/{id}', "CargoReceiptController@getPrintRecepit");
		Route::get('/cargo_receipt/get_destination', "CargoReceiptController@getDestination");
		Route::get('/cargo_receipt/get_salesman', "CargoReceiptController@getSalesman");
		Route::get('/cargo_receipt/get_rate', "CargoReceiptController@getRate");
		Route::get('/cargo_receipt/rate_history/{id}', "CargoReceiptController@getRateHistory");
		Route::get('/cargo_receipt/get_status/{i}', "CargoReceiptController@getStatus");
		Route::post('/cargo_receipt/report', "CargoReceiptController@report");
		Route::post('/cargo_receipt/export', 'CargoReceiptController@dataExport');
		
		
		Route::get('/cargo_waybill', "CargoWayBillController@index");
		Route::get('/cargo_waybill/add', "CargoWayBillController@add");
		Route::post('/cargo_waybill/save', 'CargoWayBillController@save');
		Route::get('/cargo_waybill/get_conjobs/{id}', "CargoWayBillController@getConsigneeJobs");
		Route::get('/cargo_waybill/get_con/{id}', "CargoWayBillController@getConsignee");
		Route::get('/cargo_waybill/get_vehicle', "CargoWayBillController@getVehicle");
		Route::post('/cargo_waybill/paging', 'CargoWayBillController@ajaxPaging');
		Route::get('/cargo_waybill/delete/{id}', 'CargoWayBillController@destroy');
		Route::get('/cargo_waybill/edit/{id}', "CargoWayBillController@edit");
		Route::post('/cargo_waybill/update/{id}', 'CargoWayBillController@update');
		Route::get('/cargo_waybill/print/{id}', "CargoWayBillController@getPrint");
		
		Route::get('/cargo_despatchbill', "CargoDespatchBillController@index");
		Route::get('/cargo_despatchbill/add', "CargoDespatchBillController@add");
		Route::post('/cargo_despatchbill/save', 'CargoDespatchBillController@save');
		//Route::get('/cargo_despatchbill/get_waybills/{id}', "CargoDespatchBillController@getWaybills");
		Route::post('/cargo_despatchbill/paging', 'CargoDespatchBillController@ajaxPaging');
		Route::get('/cargo_despatchbill/delete/{id}', 'CargoDespatchBillController@destroy');
		Route::get('/cargo_despatchbill/edit/{id}', "CargoDespatchBillController@edit");
		Route::post('/cargo_despatchbill/update/{id}', 'CargoDespatchBillController@update');
		Route::get('/cargo_despatchbill/report', "CargoDespatchBillController@report");
		Route::post('/cargo_despatchbill/search', "CargoDespatchBillController@searchReport");
		Route::post('/cargo_despatchbill/export', "CargoDespatchBillController@dataExport");
		Route::get('/cargo_despatchbill/get_waybills', "CargoDespatchBillController@getWaybills");
		Route::get('/cargo_despatchbill/report_search/{val}', "CargoDespatchBillController@reportSearch");
		Route::get('/cargo_despatchbill/list', "CargoDespatchBillController@despatchList");
		Route::post('/cargo_despatchbill/paging-list', 'CargoDespatchBillController@ajaxPagingList');
		Route::get('/cargo_despatchbill/get_statusform/{id}/{type}', "CargoDespatchBillController@getStatusForm");
		Route::post('/cargo_despatchbill/upload-attachment', 'CargoDespatchBillController@uploadAttachment');
		Route::post('/cargo_despatchbill/save-status', 'CargoDespatchBillController@saveStatus');
		Route::get('/cargo_despatchbill/view/{id}', "CargoDespatchBillController@view");
		Route::get('/cargo_despatchbill/waybills', "CargoDespatchBillController@waybillList");
		Route::post('/cargo_despatchbill/paging-wblist', 'CargoDespatchBillController@ajaxPagingWbillList');
		Route::get('/cargo_despatchbill/print/{id}', "CargoDespatchBillController@getPrint");
		
		
		Route::get('/purchase_rental', "PurchaseRentalController@index");
		Route::get('/purchase_rental/add', "PurchaseRentalController@add");
		Route::post('/purchase_rental/save', 'PurchaseRentalController@save');
		Route::get('/purchase_rental/edit/{id}', "PurchaseRentalController@edit");
		Route::post('/purchase_rental/update/{id}', 'PurchaseRentalController@update');
		Route::get('/purchase_rental/delete/{id}', 'PurchaseRentalController@destroy');
		Route::post('/purchase_rental/paging', 'PurchaseRentalController@ajaxPaging');
		Route::get('/purchase_rental/get_driver/{no}/{id}', "PurchaseRentalController@getDriver");
		Route::get('/purchase_rental/print/{id}/{rid}', "PurchaseRentalController@getPrint");
		Route::post('/purchase_rental/search', 'PurchaseRentalController@searchReport');
		Route::post('/purchase_rental/export', 'PurchaseRentalController@dataExport');
		
		Route::get('/rental_sales', "RentalSalesController@index");
		Route::get('/rental_sales/add', "RentalSalesController@add");
		Route::post('/rental_sales/save', 'RentalSalesController@save');
		Route::get('/rental_sales/edit/{id}', "RentalSalesController@edit");
		Route::post('/rental_sales/update/{id}', 'RentalSalesController@update');
		Route::get('/rental_sales/delete/{id}', 'RentalSalesController@destroy');
		Route::post('/rental_sales/paging', 'RentalSalesController@ajaxPaging');
		Route::get('/rental_sales/get_driver/{no}/{id}', "RentalSalesController@getDriver");
		Route::get('/rental_sales/print/{id}/{rid}', "RentalSalesController@getPrint");
		Route::post('/rental_sales/search', 'RentalSalesController@searchReport');
		Route::post('/rental_sales/export', 'RentalSalesController@dataExport');
		
		Route::get('/rental_driver', "RentalDriverController@index");
		Route::get('/rental_driver/add', "RentalDriverController@add");
		Route::post('/rental_driver/save', 'RentalDriverController@save');
		Route::get('/rental_driver/edit/{id}', 'RentalDriverController@edit');
		Route::post('/rental_driver/update/{id}', 'RentalDriverController@update');
		Route::get('/rental_driver/delete/{id}', 'RentalDriverController@destroy');
		Route::get('/rental_driver/checknumber', 'RentalDriverController@checknumber');
		Route::get('/rental_driver/checkmobnumber1', 'RentalDriverController@checkmobnumber1');
		Route::get('/rental_driver/checkmobnumber2', 'RentalDriverController@checkmobnumber2');
		
		
		Route::get('/rental_supplierdriver', "RentalSupplierDriverController@index");
		Route::get('/rental_supplierdriver/add', "RentalSupplierDriverController@add");
		Route::post('/rental_supplierdriver/save', 'RentalSupplierDriverController@save');
		Route::get('/rental_supplierdriver/edit/{id}', 'RentalSupplierDriverController@edit');
		Route::post('/rental_supplierdriver/update/{id}', 'RentalSupplierDriverController@update');
		Route::get('/rental_supplierdriver/delete/{id}', 'RentalSupplierDriverController@destroy');
		
		Route::get('/rental_customerdriver', "RentalCustomerDriverController@index");
		Route::get('/rental_customerdriver/add', "RentalCustomerDriverController@add");
		Route::post('/rental_customerdriver/save', 'RentalCustomerDriverController@save');
		Route::get('/rental_customerdriver/edit/{id}', 'RentalCustomerDriverController@edit');
		Route::post('/rental_customerdriver/update/{id}', 'RentalCustomerDriverController@update');
		Route::get('/rental_customerdriver/delete/{id}', 'RentalCustomerDriverController@destroy');
		
		Route::get('/rental_report', "RentalReportController@index");
		Route::post('/rental_report/search', "RentalReportController@searchReport");

		Route::get('/sales_order_booking', "SalesOrderBookingController@index");
		Route::get('/sales_order_booking/add', "SalesOrderBookingController@add");
		Route::post('/sales_order_booking/save', 'SalesOrderBookingController@save');
		Route::get('/sales_order_booking/customer_data', "SalesOrderBookingController@getCustomer");
		Route::get('/sales_order_booking/salesman_data', "SalesOrderBookingController@getSalesman");
		Route::post('/sales_order_booking/paging', 'SalesOrderBookingController@ajaxPaging');
		Route::get('/sales_order_booking/edit/{id}', 'SalesOrderBookingController@edit');
		Route::post('/sales_order_booking/update/{id}', 'SalesOrderBookingController@update');
		Route::get('/sales_order_booking/delete/{id}', 'SalesOrderBookingController@destroy');
		Route::get('/sales_order_booking/list', 'SalesOrderBookingController@listing');
		Route::post('/sales_order_booking/paging_list', 'SalesOrderBookingController@ajaxPagingList');
		Route::post('/sales_order_booking/paging_list_com', 'SalesOrderBookingController@ajaxPagingListCom');
		Route::get('/sales_order_booking/view/{id}', 'SalesOrderBookingController@view');
		Route::post('/sales_order_booking/view/{id}', 'SalesOrderBookingController@submit');
		Route::get('/sales_order_booking/transfer/{id}', 'SalesOrderBookingController@Transfer');
		Route::get('/sales_order_booking/print/{id}/{fc}', "SalesOrderBookingController@getPrint");
		
		Route::get('/sales_order_booking/edit_force/{id}', 'SalesOrderBookingController@editForce'); //JUL7
		//Route::get('/sales_order_booking/get_order/{id}/{n}/{sid}', "CustomersDOController@getOrder");//JUL7
		
		Route::get('/sales_order_booking/assign', "SalesOrderBookingController@assignDriver");
		Route::post('/sales_order_booking/paging_ordlist', 'SalesOrderBookingController@ajaxPagingOrderList');
		Route::post('/sales_order_booking/driver_assign', 'SalesOrderBookingController@driverAssign');
		
		Route::get('/proforma_invoice', ['as' => 'proforma_invoice.index', 'uses' => 'ProformaInvoiceController@index', 'middleware' => ['permission:pfi-list|pfi-create|pfi-edit|pfi-delete']]);
		Route::get('/proforma_invoice/add', ['as'=>'proforma_invoice.add','uses'=>'ProformaInvoiceController@add','middleware' => ['permission:pfi-create']]);
		Route::get('/proforma_invoice/add/{id}', ['as'=>'proforma_invoice.add','uses'=>'ProformaInvoiceController@add','middleware' => ['permission:pfi-create']]);
		Route::get('/proforma_invoice/add/{id}/{n}', ['as'=>'proforma_invoice.add','uses'=>'ProformaInvoiceController@add','middleware' => ['permission:pfi-create']]);
		Route::post('/proforma_invoice/save', ['as' => 'proforma_invoice.save', 'uses' => 'ProformaInvoiceController@save', 'middleware' => ['permission:pfi-create']] );
		Route::get('/proforma_invoice/edit/{id}', ['as' => 'proforma_invoice.edit', 'uses' => 'ProformaInvoiceController@edit', 'middleware' => ['permission:pfi-edit']]);
		Route::post('/proforma_invoice/update/{id}', ['as' => 'proforma_invoice.update', 'uses' => 'ProformaInvoiceController@update', 'middleware' => ['permission:pfi-edit']]);
		Route::get('/proforma_invoice/customer_data', "ProformaInvoiceController@getCustomer");
		//Route::get('/proforma_invoice', "ProformaInvoiceController@index");
		//Route::get('/proforma_invoice/add', "ProformaInvoiceController@add");
		Route::get('/proforma_invoice/salesman_data', "ProformaInvoiceController@getSalesman");
		Route::get('/proforma_invoice/item_data/{id}', "ProformaInvoiceController@getItem");
		Route::get('/proforma_invoice/checkrefno', 'ProformaInvoiceController@checkRefNo');
		Route::get('/proforma_invoice/delete/{id}', ['as' => 'proforma_invoice.destroy', 'uses' => 'ProformaInvoiceController@destroy', 'middleware' => ['permission:pfi-delete']]);
		Route::get('/proforma_invoice/get_order/{id}/{n}', "ProformaInvoiceController@getOrder");
		Route::get('/proforma_invoice/item_details/{id}', "ProformaInvoiceController@getItemDetails");
		Route::get('/proforma_invoice/print/{id}', ['as' => 'proforma_invoice.getPrint', 'uses' => 'ProformaInvoiceController@getPrint', 'middleware' => ['permission:pfi-print']]);
		Route::get('/proforma_invoice/set_session', 'ProformaInvoiceController@setSessionVal');
		Route::post('/proforma_invoice/search', "ProformaInvoiceController@getSearch");
		Route::get('/proforma_invoice/print/{id}/{fc}', ['as' => 'proforma_invoice.getPrint', 'uses' => 'ProformaInvoiceController@getPrint', 'middleware' => ['permission:pfi-print']]);
		Route::post('/proforma_invoice/export', 'ProformaInvoiceController@dataExport');
		Route::get('/proforma_invoice/newcustomer_data', "ProformaInvoiceController@getNewCustomer");
		Route::get('/proforma_invoice/checkvchrno', 'ProformaInvoiceController@checkVchrNo');
		Route::post('/proforma_invoice/paging', 'ProformaInvoiceController@ajaxPaging');
		Route::get('/proforma_invoice/customer_data/{did}', "ProformaInvoiceController@getCustomer");
		Route::get('/proforma_invoice/newcustomer_data/{did}', "ProformaInvoiceController@getNewCustomer");
		Route::get('/proforma_invoice/poadd/{id}', ['as'=>'proforma_invoice.add','uses'=>'ProformaInvoiceController@poadd','middleware' => ['permission:pfi-create']]);
		Route::post('/proforma_invoice/get_orderno', 'ProformaInvoiceController@getOrderNo');
		Route::get('/proforma_invoice/getcounter/{id}', 'ProformaInvoiceController@getCounter');
		Route::get('/proforma_invoice/get_report/{id}', 'ProformaInvoiceController@getReport');
		
		
		Route::get('/item_template', "ItemTemplateController@index");
		Route::get('/item_template/add', "ItemTemplateController@add");
		Route::post('/item_template/save', 'ItemTemplateController@save');
		Route::get('/item_template/get_template/{id}/{n}', 'ItemTemplateController@getTemplate');
		Route::get('/item_template/get_items/{id}', "ItemTemplateController@getItems");
		Route::post('/item_template/save_joborder', 'ItemTemplateController@saveJoborder');
		Route::post('/item_template/upload-attachment', 'ItemTemplateController@uploadAttachment');
		Route::get('/item_template/get_template_edit/{id}/{jid}/{n}', 'ItemTemplateController@getTemplateEdit');
		Route::get('/item_template/edit/{id}', 'ItemTemplateController@edit');
		Route::post('/item_template/update', 'ItemTemplateController@update');
		Route::get('/item_template/delete/{id}', 'ItemTemplateController@destroy');
		
		Route::get('/jobprocess_report', "JobProcessReportController@index");
		Route::post('/jobprocess_report/search', "JobProcessReportController@getSearch");
		//Route::post('/jobprocess_report/print', "JobReportController@getPrint");
		//Route::post('/jobprocess_report/export', "JobReportController@dataExport");

		Route::get('/tenantmaster', "TenantMasterController@index");
		Route::get('/tenantmaster/tenant_list/{val}', "TenantMasterController@tenantList");

		Route::post('/tenantmaster/save', 'TenantMasterController@save');
		Route::get('/tenantmaster/add', "TenantMasterController@add");
		Route::get('/tenantmaster/edit/{id}', 'TenantMasterController@edit');
		Route::post('/tenantmaster/update/{id}', 'TenantMasterController@update');
		Route::get('/tenantmaster/delete/{id}', 'TenantMasterController@destroy');
		//Route::get('/flatmaster/checkcode', 'FlatMasterController@checkCode');
		
		Route::get('/tenantenquiry', "TenantEnquiryController@index");
		Route::get('/tenantenquiry/enquiry_list/{val}', "TenantEnquiryController@enquiryList");
		Route::get('/tenantenquiry/enquiry_list/{val}/{f}', "TenantEnquiryController@enquiryList");
		Route::post('/tenantenquiry/save', 'TenantEnquiryController@save');
		Route::get('/tenantenquiry/add', "TenantEnquiryController@add");
		Route::get('/tenantenquiry/edit/{id}', 'TenantEnquiryController@edit');
		Route::post('/tenantenquiry/update/{id}', 'TenantEnquiryController@update');
		Route::get('/tenantenquiry/delete/{id}', 'TenantEnquiryController@destroy');


		Route::get('/crm_template', "CrmTemplateController@index");
		Route::post('/crm_template/save', 'CrmTemplateController@save');
		
		Route::get('/dashboard_design', "DashboardDesignController@index");
		
		Route::get('/contract-connection', "ContractConnectionController@index");
		Route::get('/contract-connection/connection_list/{val}', "ContractConnectionController@connectionList");
		Route::get('/contract-connection/connection_list/{val}/{f}', "ContractConnectionController@connectionList");
        Route::get('/contract-connection/add', "ContractConnectionController@add");
		Route::post('/contract-connection/save', 'ContractConnectionController@save');
		Route::get('/contract-connection/edit/{id}', 'ContractConnectionController@edit');
		Route::post('/contract-connection/update/{id}', 'ContractConnectionController@update');
		Route::get('/contract-connection/delete/{id}', 'ContractConnectionController@destroy');
		Route::get('/contract-connection/print/{id}', 'ContractConnectionController@getPrint');
		Route::get('/contract-connection/reading/{id}', 'ContractConnectionController@reading');
		Route::get('/contract-connection/disconnection-list', 'ContractConnectionController@disconnectionList');
		Route::get('/contract-connection/disconnection_listing/{val}', "ContractConnectionController@disconnectionListing");
		Route::get('/contract-connection/disconnection_listing/{val}/{f}', "ContractConnectionController@disconnectionListing");
		Route::post('/contract-connection/readsave/{id}', 'ContractConnectionController@readUpdate');
		Route::get('/contract-connection/reading-list', 'ContractConnectionController@readingList');
		Route::get('/contract-connection/reading_listing/{val}', "ContractConnectionController@readingListing");
		Route::get('/contract-connection/reading_listing/{val}/{f}', "ContractConnectionController@readingListing");
		Route::get('/contract-connection/transfer/{id}', 'ContractConnectionController@add');
		Route::get('/contract-connection/print/{id}/{rid}', 'ContractConnectionController@getPrint');

		Route::get('/creditnotejournal', ['as' => 'creditnotejournal.index', 'uses' => 'CreditNoteJournalController@index', 'middleware' => ['permission:jv-list|jv-create|jv-edit|jv-delete']]);
		Route::get('/creditnotejournal/add', ['as'=>'creditnotejournal.add','uses'=>'CreditNoteJournalController@add','middleware' => ['permission:jv-create']]);
		Route::post('/creditnotejournal/save', "CreditNoteJournalController@save");
		Route::get('/creditnotejournal/getvoucher/{id}', "CreditNoteJournalController@getVoucher");
		Route::get('/creditnotejournal/delete/{id}/{n}', ['as' => 'creditnotejournal.destroy', 'uses' => 'CreditNoteJournalController@destroy', 'middleware' => ['permission:jv-delete']]);
		Route::get('/creditnotejournal/getvouchertype/{id}', 'CreditNoteJournalController@getVoucherType');
		Route::get('/creditnotejournal/edit/{id}', ['as' => 'creditnotejournal.edit', 'uses' => 'CreditNoteJournalController@edit', 'middleware' => ['permission:jv-edit']]);
		Route::post('/creditnotejournal/update/{id}', "CreditNoteJournalController@update");
		Route::get('/creditnotejournal/checkvchrno', 'CreditNoteJournalController@checkVchrNo');
		Route::get('/creditnotejournal/print/{id}', ['as' => 'creditnotejournal.getPrint', 'uses' => 'CreditNoteJournalController@getPrint', 'middleware' => ['permission:jv-print']]);
		Route::get('/creditnotejournal/print/{id}/{rid}', ['as' => 'creditnotejournal.getPrint', 'uses' => 'CreditNoteJournalController@getPrint', 'middleware' => ['permission:jv-print']]);
		Route::get('/creditnotejournal/add/{id}/{rid}/{vouchertype}', ['as'=>'creditnotejournal.add','uses'=>'CreditNoteJournalController@add','middleware' => ['permission:jv-create']]);
        Route::get('/creditnotejournal/getvoucherprint', "CreditNoteJournalController@getVoucherprint");
        Route::get('/creditnotejournal/set_transactions/{type}/{id}/{n}', "CreditNoteJournalController@setTransactions");
		Route::post('/creditnotejournal/paging', 'CreditNoteJournalController@ajaxPaging');
		Route::post('/creditnotejournal/recurring_add', 'CreditNoteJournalController@recurringAdd');
		
	});
	
	 Route::get('/manage', "ManageController@index");
	 Route::get('/disable', "ManageController@getDisable");
	 Route::get('/enable', "ManageController@getEnable");
	 
	 Route::get('/sign', 'SignController@index');
	 Route::post('/sign', 'SignController@index');
	 
	 Route::get('/myorder', 'MyOrderController@index');
	Route::post('/myorder/login', 'MyOrderController@login');
	Route::get('/myorder/list', 'MyOrderController@myList');
	Route::get('/myorder/set_status', 'MyOrderController@setStatus');
	Route::get('/myorder/logout', 'MyOrderController@Logout');
	Route::get('/myorder/dashboard', 'MyOrderController@dashboard');
	Route::get('/myorder/report', 'MyOrderController@report');
	Route::get('/myorder/ajax_search', 'MyOrderController@ajaxSearch');
	Route::get('/myorder/pickup', 'MyOrderController@getPickup');
	Route::get('/myorder/set_pkpstatus', 'MyOrderController@setPkpStatus');
	Route::get('/myorder/pending', 'MyOrderController@pendingList');//MAY28
});

Route::get('/apicall', 'ApicallController@index'); 
Route::post('/apicall/sts', 'ApicallController@status_chk'); 


/* Route::auth();

Route::get('/home', 'HomeController@index'); */

Route::auth();

Route::get('/home', 'HomeController@index');

