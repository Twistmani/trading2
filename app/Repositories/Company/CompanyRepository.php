<?php namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use Illuminate\Support\Facades\File; 

use Image;
use Config;
use DB;
use Cache;

class CompanyRepository extends AbstractValidator implements CompanyInterface {
	
	protected $company;
	
	protected static $rules = [
		'company_name' => 'required|unique:company',
		//'logo' => 'mimes:jpeg,bmp,png,jpg'
	];
	
	public function __construct(Company $company) {
		$this->company = $company;
		$config = Config::get('siteconfig');
		$this->width = $config['modules']['company']['image_size']['width'];
        $this->height = $config['modules']['company']['image_size']['height'];
        $this->thumbWidth = $config['modules']['company']['thumb_size']['width'];
        $this->thumbHeight = $config['modules']['company']['thumb_size']['height'];
        $this->imgDir = $config['modules']['company']['image_dir'];

	}
	
	public function all()
	{
		
	}
	
	public function paginate($page = 1, $limit = 10, $all = false)
	{
		
	}
	
	public function find($id)
	{
		return $this->company->where('id', $id)->first();
	}
	
	public function create($attributes)
	{
		
	}
	
	public function update($id, $company)
	{
		//echo '<pre>';print_r($company);exit;
		$image = '';
		$file = (isset($company['image'])) ?$company['image'] :null;
		if($file) {
	        $image = time().'.'.$file->getClientOriginalExtension();
			$destinationPath = public_path() . $this->imgDir.'/'.$image;
			$destinationPathThumb = public_path() . $this->imgDir.'/thumb_'.$image;
            Image::make($file->getRealPath())->resize($this->width, $this->height, function($constraint) { $constraint->aspectRatio(); })->save($destinationPath);
            Image::make($file->getRealPath())->resize($this->thumbWidth, $this->thumbHeight, function($constraint) { $constraint->aspectRatio(); })->save($destinationPathThumb);
		}
	
		$this->company = $this->find($id);
		$this->company->company_name = $company['company_name'];
		$this->company->email = $company['email'];
		$this->company->phone = $company['phone'];
		$this->company->address = $company['address'];
		$this->company->city = $company['city'];
		$this->company->state = $company['state'];
		$this->company->country = $company['country'];
		$this->company->vat_no = $company['vat_no'];
		$this->company->pin = $company['pin'];
		$this->company->website = $company['website'];
		$this->company->logo =isset($company['image'])?$image:((isset($company['delete_logo'])) && $company['delete_logo']==1)?$image:$company['image_logo'];
		$this->company->save();
		return true;
	}
	
	public function delete($id)
	{
			
	}

	public function getCompany()
	{
		return $this->company->first();
	}
	
	public function getDashboardData()
	{
		$sales = DB::table('sales_invoice')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$items = DB::table('itemmaster')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$purchase = DB::table('purchase_invoice')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$order = DB::table('purchase_order')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$quotation = DB::table('quotation_sales')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$employee = DB::table('employee')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$payment = DB::table('payment_voucher')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$receipt = DB::table('receipt_voucher')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$account = DB::table('account_master')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$sorder = DB::table('sales_order')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$dorder = DB::table('customer_do')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$salesret = DB::table('sales_return')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$purchaseret = DB::table('purchase_return')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		
		return ['sales' => $sales, 'items' => $items, 'purchase' => $purchase,'salesret' => $salesret,'purchaseret' => $purchaseret, 
				'order' => $order, 'quotation' => $quotation, 'employee' => $employee,'dorder' => $dorder,
				'payment' => $payment, 'receipt' => $receipt, 'account' => $account, 'sorder' => $sorder];
	}
	
	public function getCrmDashboardData()
	{
		$ce_net = DB::table('customer_enquiry')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$ce_pending = DB::table('customer_enquiry')->where('doc_status',0)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$ce_aprvd = DB::table('customer_enquiry')->where('doc_status',1)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$ce_rjctd = DB::table('customer_enquiry')->where('doc_status',2)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		
		$qs_net = DB::table('quotation_sales')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$qs_pending = DB::table('quotation_sales')->where('doc_status',0)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$qs_aprvd = DB::table('quotation_sales')->where('doc_status',1)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$qs_rjctd = DB::table('quotation_sales')->where('doc_status',2)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		
		$so_net = DB::table('sales_order')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$so_pending = DB::table('sales_order')->where('doc_status',0)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$so_aprvd = DB::table('sales_order')->where('doc_status',1)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$so_rjctd = DB::table('sales_order')->where('doc_status',2)->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		
		$ld_net = DB::table('leads')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$sespect = DB::table('leads')->where('lead_status','Suspect')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$propect = DB::table('leads')->where('lead_status','Prospective')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$enqry = DB::table('leads')->where('lead_status','Enquiry')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		
		$sales = DB::table('sales_invoice')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$items = DB::table('itemmaster')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$purchase = DB::table('purchase_invoice')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$order = DB::table('purchase_order')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$employee = DB::table('employee')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$payment = DB::table('payment_voucher')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$receipt = DB::table('receipt_voucher')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$account = DB::table('account_master')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$dorder = DB::table('customer_do')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$salesret = DB::table('sales_return')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		$purchaseret = DB::table('purchase_return')->where('status',1)->where('deleted_at', '0000-00-00 00:00:00')->count();
		
		return ['ce_net' =>$ce_net, 'ce_aprvd' => $ce_aprvd, 'ce_pending' => $ce_pending, 'ce_rjctd' => $ce_rjctd,
				'qs_net' =>$qs_net, 'qs_aprvd' => $qs_aprvd, 'qs_pending' => $qs_pending, 'qs_rjctd' => $qs_rjctd,
				'so_net' =>$so_net, 'so_aprvd' => $so_aprvd, 'so_pending' => $so_pending, 'so_rjctd' => $so_rjctd,
				'ld_net' =>$ld_net, 'sespect' => $sespect, 'propect' => $propect, 'enqry' => $enqry,
				'sales' => $sales, 'items' => $items, 'purchase' => $purchase,'salesret' => $salesret,'purchaseret' => $purchaseret, 
				'order' => $order, 'quotation' => '', 'employee' => $employee,'dorder' => $dorder,
				'payment' => $payment, 'receipt' => $receipt, 'account' => $account, 'sorder' => ''];
	}
	
}