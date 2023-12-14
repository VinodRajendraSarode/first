<?php
$this->PhpExcel->createWorksheet();
$this->PhpExcel->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
	array('label' => __('Service Name'), 'width' => 'auto'),
	array('label' => __('Comapny Name'), 'width' => 'auto'),
	array('label' => __('Contract End Date'), 'width' => 'auto'),
	array('label' => __('Service Period'), 'width' => 'auto'),
);

// heading
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true, 'offset'=>0));

foreach ($subscriptions as $i=>$subscription) { debug($subscription);exit;
	$date=date_create($service['Sale']['contract_end_date']);
	$contractDate = date_format($date,"d/m/Y");
	
	$this->PhpExcel->addTableRow(array(
		$SalesDetail['Service']['service'],
		$SalesDetail['Sale']['Company']['company_name'],
		$contractDate,
		$SalesDetail['SalesDetail']['service_period'],
	));
}
$this->PhpExcel->addTableFooter();
$this->PhpExcel->output('contract_due_report_'.date('dm').'.xls');
exit;
