<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Repositories\Parameter1\Parameter1Interface;
use App\Repositories\VatMaster\VatMasterInterface;
use DB;
use Session;
//use App\Repositories\Parameter2\Parameter2Interface;


class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	
	protected $parameter1;
	//protected $parameter2;
	protected $acsettings;
	protected $vat_master;
	protected $vatdata;
	protected $location;
	protected $company_data;
	
	public function __construct(Parameter1Interface $parameter1,VatMasterInterface $vat_master) {
        $this->parameter1 = $parameter1; 
		//$this->parameter2 = $parameter2;
		$this->vat_master = $vat_master;
		$this->acsettings = $this->parameter1->getParameter1(); //echo '<pre>';print_r($this->acsettings);exit;
		$this->vatdata    = $this->vat_master->getActiveVatMaster();
		//$this->company = '';
		
		
		/* if(Session::has('company')) {
			$sessionlog = true;
		} else { */
			
			$this->company_data = DB::table('company')->first(); //echo '<pre>';print_r($this->company_data);exit;
			Session::set('company', $this->company_data->company_name);
			Session::set('city', $this->company_data->city);
			Session::set('state', $this->company_data->state);
			Session::set('country', $this->company_data->country);
			Session::set('address', $this->company_data->address);
			Session::set('pin', $this->company_data->pin);
			Session::set('phone', $this->company_data->phone);
			Session::set('vatno', $this->company_data->vat_no);
			Session::set('logo', $this->company_data->logo);
			Session::set('email', $this->company_data->email);
			$location = DB::table('location')->where('is_default',1)->where('status',1)->where('deleted_at','0000-00-00 00:00:00')->select('id','code','name')->first();
			Session::put('location', $location->name);
			Session::put('location_id', $location->id);
		//}
		
		//COST ACCOUNT/PURCHASE SALES METHOD, Department GETTING...
		$resPara2 = DB::table('parameter2')->whereIn('id',[4,10,17,24,35,36,37,42])->where('status',1)->select('is_active','keyname')->orderBy('id','ASC')->get(); //echo '<pre>';print_r($resPara2);exit;
		foreach($resPara2 as $row) {
			if($row->keyname=='mod_cost_accounting')
				Session::set('cost_accounting', $row->is_active);
			elseif($row->keyname=='mod_department')
				Session::set('department', $row->is_active);
			elseif($row->keyname=='mod_purchase_enquiry')
				Session::set('pur_enquiry', $row->is_active);
		    elseif($row->keyname=='mod_item_location_warn')
				Session::set('item_location_warn', $row->is_active);
			elseif($row->keyname=='mod_location')
				Session::set('mod_location', $row->is_active);
			elseif($row->keyname=='mod_jo_to_je')
				Session::set('mod_jo_to_je', $row->is_active);
			elseif($row->keyname=='mod_vehicle_cust')
				Session::set('mod_vehicle_cust', $row->is_active);
			elseif($row->keyname=='mod_item_batch')
				Session::set('mod_item_batch', $row->is_active);
		}
		Session::set('trip_entry', $this->acsettings->trip_entry);
		
		//$this->acsettings2 = $this->parameter2->getParameter2();
    }
}
