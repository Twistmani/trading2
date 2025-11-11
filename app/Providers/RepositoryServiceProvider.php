<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Repositories\Category\CategoryInterface', 'App\Repositories\Category\CategoryRepository');
		$this->app->bind('App\Repositories\Company\CompanyInterface', 'App\Repositories\Company\CompanyRepository');
		$this->app->bind('App\Repositories\Group\GroupInterface', 'App\Repositories\Group\GroupRepository');
		$this->app->bind('App\Repositories\Unit\UnitInterface', 'App\Repositories\Unit\UnitRepository');
		$this->app->bind('App\Repositories\Itemmaster\ItemmasterInterface', 'App\Repositories\Itemmaster\ItemmasterRepository');
		$this->app->bind('App\Repositories\Bank\BankInterface', 'App\Repositories\Bank\BankRepository');
		$this->app->bind('App\Repositories\Currency\CurrencyInterface', 'App\Repositories\Currency\CurrencyRepository');
		$this->app->bind('App\Repositories\Area\AreaInterface', 'App\Repositories\Area\AreaRepository');
		$this->app->bind('App\Repositories\Location\LocationInterface', 'App\Repositories\Location\LocationRepository');
		$this->app->bind('App\Repositories\Country\CountryInterface', 'App\Repositories\Country\CountryRepository');
		$this->app->bind('App\Repositories\Department\DepartmentInterface', 'App\Repositories\Department\DepartmentRepository');
		$this->app->bind('App\Repositories\Division\DivisionInterface', 'App\Repositories\Division\DivisionRepository');
		$this->app->bind('App\Repositories\Terms\TermsInterface', 'App\Repositories\Terms\TermsRepository');
		$this->app->bind('App\Repositories\Salesman\SalesmanInterface', 'App\Repositories\Salesman\SalesmanRepository');
		$this->app->bind('App\Repositories\Jobmaster\JobmasterInterface', 'App\Repositories\Jobmaster\JobmasterRepository');
		$this->app->bind('App\Repositories\Parameter1\Parameter1Interface', 'App\Repositories\Parameter1\Parameter1Repository');
		$this->app->bind('App\Repositories\Parameter2\Parameter2Interface', 'App\Repositories\Parameter2\Parameter2Repository');
		$this->app->bind('App\Repositories\Accategory\AccategoryInterface', 'App\Repositories\Accategory\AccategoryRepository');
		$this->app->bind('App\Repositories\Acgroup\AcgroupInterface', 'App\Repositories\Acgroup\AcgroupRepository');
		$this->app->bind('App\Repositories\AccountMaster\AccountMasterInterface', 'App\Repositories\AccountMaster\AccountMasterRepository');
		$this->app->bind('App\Repositories\VoucherType\VoucherTypeInterface', 'App\Repositories\VoucherType\VoucherTypeRepository');
		$this->app->bind('App\Repositories\AccountSetting\AccountSettingInterface', 'App\Repositories\AccountSetting\AccountSettingRepository');
		$this->app->bind('App\Repositories\HeaderFooter\HeaderFooterInterface', 'App\Repositories\HeaderFooter\HeaderFooterRepository');
		$this->app->bind('App\Repositories\TemplateName\TemplateNameInterface', 'App\Repositories\TemplateName\TemplateNameRepository');
		$this->app->bind('App\Repositories\VoucherNo\VoucherNoInterface', 'App\Repositories\VoucherNo\VoucherNoRepository');
		$this->app->bind('App\Repositories\PurchaseOrder\PurchaseOrderInterface', 'App\Repositories\PurchaseOrder\PurchaseOrderRepository');
		$this->app->bind('App\Repositories\Employee\EmployeeInterface', 'App\Repositories\Employee\EmployeeRepository');
		$this->app->bind('App\Repositories\Quotation\QuotationInterface', 'App\Repositories\Quotation\QuotationRepository');
		$this->app->bind('App\Repositories\ItemUnit\ItemUnitInterface', 'App\Repositories\ItemUnit\ItemUnitRepository');
		$this->app->bind('App\Repositories\SupplierDo\SupplierDoInterface', 'App\Repositories\SupplierDo\SupplierDoRepository');
		$this->app->bind('App\Repositories\PurchaseInvoice\PurchaseInvoiceInterface', 'App\Repositories\PurchaseInvoice\PurchaseInvoiceRepository');
		$this->app->bind('App\Repositories\PurchaseReturn\PurchaseReturnInterface', 'App\Repositories\PurchaseReturn\PurchaseReturnRepository');
		$this->app->bind('App\Repositories\QuotationSales\QuotationSalesInterface', 'App\Repositories\QuotationSales\QuotationSalesRepository');
		$this->app->bind('App\Repositories\SalesOrder\SalesOrderInterface', 'App\Repositories\SalesOrder\SalesOrderRepository');
		$this->app->bind('App\Repositories\CustomerDo\CustomerDoInterface', 'App\Repositories\CustomerDo\CustomerDoRepository');
		$this->app->bind('App\Repositories\SalesReturn\SalesReturnInterface', 'App\Repositories\SalesReturn\SalesReturnRepository');
		$this->app->bind('App\Repositories\SalesInvoice\SalesInvoiceInterface', 'App\Repositories\SalesInvoice\SalesInvoiceRepository');
		$this->app->bind('App\Repositories\CustomerReceipt\CustomerReceiptInterface', 'App\Repositories\CustomerReceipt\CustomerReceiptRepository');
		$this->app->bind('App\Repositories\OtherReceipt\OtherReceiptInterface', 'App\Repositories\OtherReceipt\OtherReceiptRepository');
		$this->app->bind('App\Repositories\SupplierPayment\SupplierPaymentInterface', 'App\Repositories\SupplierPayment\SupplierPaymentRepository');
		$this->app->bind('App\Repositories\OtherPayment\OtherPaymentInterface', 'App\Repositories\OtherPayment\OtherPaymentRepository');
		$this->app->bind('App\Repositories\ManualJournal\ManualJournalInterface', 'App\Repositories\ManualJournal\ManualJournalRepository');
		$this->app->bind('App\Repositories\Journal\JournalInterface', 'App\Repositories\Journal\JournalRepository');
		$this->app->bind('App\Repositories\VatMaster\VatMasterInterface', 'App\Repositories\VatMaster\VatMasterRepository');
		$this->app->bind('App\Repositories\VoucherwiseReport\VoucherwiseReportInterface', 'App\Repositories\VoucherwiseReport\VoucherwiseReportRepository');
		$this->app->bind('App\Repositories\GoodsIssued\GoodsIssuedInterface', 'App\Repositories\GoodsIssued\GoodsIssuedRepository');
		$this->app->bind('App\Repositories\GoodsReturn\GoodsReturnInterface', 'App\Repositories\GoodsReturn\GoodsReturnRepository');
		$this->app->bind('App\Repositories\ReceiptVoucher\ReceiptVoucherInterface', 'App\Repositories\ReceiptVoucher\ReceiptVoucherRepository');
		$this->app->bind('App\Repositories\PaymentVoucher\PaymentVoucherInterface', 'App\Repositories\PaymentVoucher\PaymentVoucherRepository');
		$this->app->bind('App\Repositories\PettyCash\PettyCashInterface', 'App\Repositories\PettyCash\PettyCashRepository');
		$this->app->bind('App\Repositories\LogDetails\LogDetailsInterface', 'App\Repositories\LogDetails\LogDetailsRepository');
		$this->app->bind('App\Repositories\OtherAccountSetting\OtherAccountSettingInterface', 'App\Repositories\OtherAccountSetting\OtherAccountSettingRepository');
		$this->app->bind('App\Repositories\LocationTransfer\LocationTransferInterface', 'App\Repositories\LocationTransfer\LocationTransferRepository');
		$this->app->bind('App\Repositories\StockTransferin\StockTransferinInterface', 'App\Repositories\StockTransferin\StockTransferinRepository');
		$this->app->bind('App\Repositories\StockTransferout\StockTransferoutInterface', 'App\Repositories\StockTransferout\StockTransferoutRepository');
		$this->app->bind('App\Repositories\Forms\FormsInterface', 'App\Repositories\Forms\FormsRepository');
		$this->app->bind('App\Repositories\CreditNote\CreditNoteInterface', 'App\Repositories\CreditNote\CreditNoteRepository');
		$this->app->bind('App\Repositories\CreditNoteJournal\CreditNoteJournalInterface', 'App\Repositories\CreditNoteJournal\CreditNoteJournalRepository');
		$this->app->bind('App\Repositories\DebitNote\DebitNoteInterface', 'App\Repositories\DebitNote\DebitNoteRepository');
		$this->app->bind('App\Repositories\Parameter4\Parameter4Interface', 'App\Repositories\Parameter4\Parameter4Repository');
		$this->app->bind('App\Repositories\WageEntry\WageEntryInterface', 'App\Repositories\WageEntry\WageEntryRepository');
		$this->app->bind('App\Repositories\CustomerEnquiry\CustomerEnquiryInterface', 'App\Repositories\CustomerEnquiry\CustomerEnquiryRepository');
		$this->app->bind('App\Repositories\Production\ProductionInterface', 'App\Repositories\Production\ProductionRepository');
		$this->app->bind('App\Repositories\Manufacture\ManufactureInterface', 'App\Repositories\Manufacture\ManufactureRepository');
		$this->app->bind('App\Repositories\MaterialRequisition\MaterialRequisitionInterface', 'App\Repositories\MaterialRequisition\MaterialRequisitionRepository');
		$this->app->bind('App\Repositories\PurchaseSplit\PurchaseSplitInterface', 'App\Repositories\PurchaseSplit\PurchaseSplitRepository');
		$this->app->bind('App\Repositories\SalesSplit\SalesSplitInterface', 'App\Repositories\SalesSplit\SalesSplitRepository');
		$this->app->bind('App\Repositories\PurchaseRental\PurchaseRentalInterface', 'App\Repositories\PurchaseRental\PurchaseRentalRepository');
		$this->app->bind('App\Repositories\RentalSales\RentalSalesInterface', 'App\Repositories\RentalSales\RentalSalesRepository');
		$this->app->bind('App\Repositories\ProformaInvoice\ProformaInvoiceInterface', 'App\Repositories\ProformaInvoice\ProformaInvoiceRepository');
		$this->app->bind('App\Repositories\PackingList\PackingListInterface', 'App\Repositories\PackingList\PackingListRepository');
		$this->app->bind('App\Repositories\SalesSplitReturn\SalesSplitReturnInterface', 'App\Repositories\SalesSplitReturn\SalesSplitReturnRepository');
		$this->app->bind('App\Repositories\PurchaseSplitReturn\PurchaseSplitReturnInterface', 'App\Repositories\PurchaseSplitReturn\PurchaseSplitReturnRepository');



	}

}
