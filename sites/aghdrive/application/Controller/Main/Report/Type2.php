<?php
require 'autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Controller_Main_Report_Type2 extends Controller
{
	protected $order = null;
	
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->response->template = 'report/type2';
		
		$this->order = new Container('order_view');
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		if ($this->qForm->isSubmitted()) {
			
			$this->action();
			
		} else {
			// Set default value
			$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
				array('date_stop_from' => date('Y-m-d'), 'date_stop_to' => date('Y-m-d'))));
		}
		
		return $this->response;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::action()
	 */
	public function action() : Data_Response
	{
		parent::action();
		
		$report = array();
		
		// Order with planed duraton
		$this->order->list(array_merge($this->qForm->sqlWhere(),
			array("recipe_code IN ('clean-coq-std', 'clean-coq-vel', 
				'clean-csp-summer', 'clean-csp-winter')",
				"order_active='yes'")), 'order_datetime_stop', 1, -1);
		
		// No data to not generate report
			if (count($this->order)==0) {
			// Add success information
			App::addAlert('info', 'Brak danych do wygenerowania raportu');
			return $this->response;
		}
		
		$spreadsheet = new Spreadsheet();
		
		// Metadata of document
		$spreadsheet->getProperties()
			->setCreator($this->request->user->name . ' ' . $this->request->user->surname)
			->setLastModifiedBy($this->request->user->name . ' ' . $this->request->user->surname)
			->setTitle('Raport czyszczenie elementów formy')
			->setSubject('')
			->setDescription('Raport czyszczenie elementów formy realizowanych przez firmę Astem Sp. z o.o. dla zakładów Olsztyn')
			->setKeywords('raport astem czyszczenie')
			->setCategory('')
			->setCompany('Astem Sp. z o.o.');
		
		$sheet = $spreadsheet->getActiveSheet();
		
		// First row
		$row = 1;
		$sheet->setCellValueByColumnAndRow(1,	$row,	'L.p.');
		$sheet->setCellValueByColumnAndRow(2,	$row,	'Data');
		$sheet->setCellValueByColumnAndRow(3,	$row,	'Nr formy');
		$sheet->setCellValueByColumnAndRow(4,	$row,	'Nr części');
		$sheet->setCellValueByColumnAndRow(5,	$row,	'COQA V + CBO');
		$sheet->setCellValueByColumnAndRow(6,	$row,	'COQB V');
		$sheet->setCellValueByColumnAndRow(7,	$row,	'COQA + CBO');
		$sheet->setCellValueByColumnAndRow(8,	$row,	'COQB');
		$sheet->setCellValueByColumnAndRow(9,	$row,	'CSP');
		$sheet->setCellValueByColumnAndRow(10,	$row,	'CBO');
		$sheet->setCellValueByColumnAndRow(11,	$row,	'UWAGI');
		$sheet->setCellValueByColumnAndRow(12,	$row,	'std/nstd');
		$sheet->setCellValueByColumnAndRow(13,	$row,	'odpowiet.');
		
		// Second row is empty
		$row++;
		
		// Report
		$row++;
		foreach($this->order as $k=>$v) {
			
			$sheet->setCellValueByColumnAndRow(1,	$row,	$k+1);
			$sheet->getStyleByColumnAndRow(2, $row)
				->getNumberFormat()
				->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
			
			$sheet->setCellValueByColumnAndRow(2, $row, $v->order_date_stop);
			
			// Sidewall
			if ($v->sidewall_id>0) {
				// STANDARD
				if ($v->sidewall_type == 'COQ STD') {
					$sheet->setCellValueByColumnAndRow(3,	$row,	$v->sidewall_number);
					if ($v->sidewall_side=='COQA') {
						$sheet->setCellValueByColumnAndRow(7,	$row,	'X');
					} else if ($v->sidewall_side=='COQB') {
						$sheet->setCellValueByColumnAndRow(8,	$row,	'X');
						$sheet->setCellValueByColumnAndRow(10,	$row,	'X');
					}
				}
				
				// Velour
				if ($v->sidewall_type == 'COQ Velour') {
					$sheet->setCellValueByColumnAndRow(3,	$row,	$v->sidewall_number);
					if ($v->sidewall_side=='COQA') {
						$sheet->setCellValueByColumnAndRow(5,	$row,	'X');
					} else if ($v->sidewall_side=='COQB') {
						$sheet->setCellValueByColumnAndRow(6,	$row,	'X');
						$sheet->setCellValueByColumnAndRow(10,	$row,	'X');
					}
				}
			}
			
			// Tread segment
			if ($v->tread_segment_id>0) {
				$sheet->setCellValueByColumnAndRow(4,	$row,	$v->tread_segment_number);
				$sheet->setCellValueByColumnAndRow(9,	$row,	$v->order_tread_segment_count);
			}
			
			// Tire mold owner
			$sheet->setCellValueByColumnAndRow(11, $row, $v->tiremold_owner_name);
			
			if ($v->tiremold_owner_name=='OLS1') {
				$sheet->getStyleByColumnAndRow(11, $row)->getFill()
					->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E8B92E');
			} else if ($v->tiremold_owner_name=='OLS2') {
				$sheet->getStyleByColumnAndRow(11, $row)->getFill()
					->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('63AE57');
			}
			
			// Overplaned
			if ($v->order_overplanned_duration==1) {
				$sheet->setCellValueByColumnAndRow(12, $row, 'NSTD');
				$sheet->getStyleByColumnAndRow(12, $row)->getFill()
					->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F0C6CD');
				$sheet->getStyleByColumnAndRow(12, $row)->getFont()
					->setColor(new Color('FFAA2524'));
			}
			
			// Tread segment airout type
			if ($v->tread_segment_id>0) {
				$sheet->setCellValueByColumnAndRow(13,	$row,	
					' ' . implode(', ', array_map('ucfirst', array_map('trim', 
						explode(',', $v->order_tread_segment_airout_type)))) . ' ');
			}
			
			$row++;
		}
		
		// Formating
		$styleThickBrownBorderOutline = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => ['argb' => 'FF000000'],
				],
			],];
		$sheet->getStyleByColumnAndRow(1, 1, 13, $this->order->data_count+2)
			->applyFromArray($styleThickBrownBorderOutline);
		
		// Auto column width
		$sheet->getColumnDimensionByColumn(1, 13)->setAutoSize(true);
		$sheet->getColumnDimension('B')->setWidth(13);
		$sheet->getColumnDimension('C')->setWidth(13);
		$sheet->getColumnDimension('D')->setWidth(13);
		$sheet->getColumnDimension('K')->setWidth(20);
		$sheet->getColumnDimension('L')->setWidth(10);
		$sheet->getColumnDimension('M')->setWidth(15);
		
		// Set font familly and size
		$sheet->getStyleByColumnAndRow(1, 1, 13, $this->order->data_count+2)
			->getFont()->setName('Calibri')->setSize(11);
		
		// Set center
		$sheet->getStyleByColumnAndRow(1, 1, 13, $this->order->data_count+2)
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet->getStyleByColumnAndRow(1, 1, 13, $this->order->data_count+2)
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		// Set font bold
		$sheet->getStyle('A1:M1')->getFont()->setBold(true);
		$sheet->getStyleByColumnAndRow(3, 3, 13, $row, $this->order->data_count+2)
			->getFont()->setBold(true);
		
		// Set background color
		$sheet->getStyle('A1:M1')->getFill()
			->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DEE5F0');
		
		$sheet->getStyle('A1:M1')->getAlignment()->setWrapText(true);
		
		$sheet->getStyle('B2:M2')->getFill()->setFillType(Fill::FILL_SOLID)
			->getStartColor()->setRGB('FEFF3D');
		
		// Alwasy save report
		$this->response->filename = 'Raport czyszczenia';
		$form_data = $this->qForm->getValue();
		if (join($form_data['date_stop_from']) == join($form_data['date_stop_to'])) {
			$this->response->filename .= ' ' . date('Y-m-d', strtotime(join('-', $form_data['date_stop_from'])));
		} else {
			$this->response->filename .=
				' od ' . date('Y-m-d', strtotime(join('-', $form_data['date_stop_from']))) .
				' do ' . date('Y-m-d', strtotime(join('-', $form_data['date_stop_to'])));
		}
		$this->response->filename .= '.xlsx';
		
		// Save report
		IOFactory::createWriter($spreadsheet, 'Xlsx')
			->save('../../' . REPORT_SAVE_DIR . '/' . $this->response->filename);
		
		$sheet->getPageMargins()->setBottom(0);
		$sheet->getPageMargins()->setLeft(0);
		$sheet->getPageMargins()->setRight(0);
		$sheet->getPageMargins()->setTop(0);
		
		$writer = new Html($spreadsheet);
		
		$this->response->report_css = $writer->generateStyles();
		$this->response->report		= $writer->generateSheetData();
	
		return $this->response;
	}
}