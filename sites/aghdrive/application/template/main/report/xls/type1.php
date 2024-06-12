<?php
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
// sending HTTP headers
$workbook->send('Raport czyszczen ' . $this->data->date_from . ' - ' .
	$this->data->date_to . '.xls');

// Format options
$font_size = 15;
$standard = $workbook->addFormat(array('Size' => 15));
$standard_italic = $workbook->addFormat(array('Size' => $font_size, 'Italic' => 1));
$standard_italic_right = $workbook->addFormat(array('Size' => $font_size-3, 'Italic' => 1, 'Align' => 'right'));
$standard_right = $workbook->addFormat(array('Size' => $font_size, 'Align' => 'right'));
$bold_right = $workbook->addFormat(array('Size' => $font_size, 'Align' => 'right', 'Bold' => 1));

$title_bold = $workbook->addFormat(array('Size' => $font_size, 'Bold' => 1));
$title_bold_italic = $workbook->addFormat(array('Size' => $font_size, 'Bold' => 1, 'Italic' => 1));

// Creating a worksheet
$worksheet = $workbook->addWorksheet('Raport');
$worksheet->setInputEncoding('UTF-8');

// Column width
$worksheet->setColumn(1, 1, 60);
$worksheet->setColumn(2, 2, 20);
$worksheet->centerVertically();

// The actual data
$worksheet->mergeCells(0, 0, 0, 3);
$worksheet->writeString(0, 0, 'Raport od:' . $this->data->date_from . ' do: ' .
	$this->data->date_to, $title_bold_italic);
$worksheet->writeString(1, 0, 'Lp.', $title_bold);
$worksheet->writeString(1, 1, 'Nazwa/numer elementu', $title_bold);
$worksheet->writeString(1, 2, 'Czas', $title_bold);
$worksheet->writeString(1, 3, 'Uwagi', $title_bold);

$total_seconds = 0;

$row = 1;
$counter = 1;

foreach($this->data->clean_type as $clean_key => $clean_name) {
	
	$row++;
	$worksheet->mergeCells($row, 0, $row, 3);
	$worksheet->writeString($row, 0, $clean_name, $standard_italic);
	
	foreach($this->data->report['clean'][$clean_key]['data'] as $order) {
		
		// Check if exist element in report
		if (!$order->sidewall_id>0 and !$order->tread_segment_id>0) {
			continue;
		}
		
		$row++;
		$worksheet->writeNumber($row, 0, $counter++, $standard);
		if ($order->sidewall_id>0) {
			$worksheet->writeString($row, 1, $order->sidewall_type . ' nr ' .
				$order->sidewall_number, $standard);
		}
		if ($order->tread_segment_id>0) {
			$season = $order->tread_segment_season=='winter' ? 'Zima' : 'Lato';
			$worksheet->writeString($row, 1, 'CSP ' . $season . ' ' .
				$order->tread_segment_number, $standard);
		}
		$worksheet->writeString($row, 2, sprintf( "%02.2d:%02.2d",
			floor($order->order_report_duration/60 ), $order->order_report_duration % 60),
			$standard_right);
		
		// Remember total seconds;
		$total_seconds += $order->order_report_duration;
	}
}

$row++;
$worksheet->mergeCells($row, 0, $row, 3);
$worksheet->writeString($row, 0, "Oczekiwanie", $standard_italic);
foreach($this->data->report['waiting']['data'] as $order) {
	$row++;
	$worksheet->writeNumber($row, 0, $counter++, $standard);
	
	// Try to read previous order
	$order_prev = $order->prev;
	if (	$order_prev->order_id>0
		and ($order_prev->tread_segment_id>0 or $order_prev->sidewall_id>0)) {
			
			if ($order_prev->sidewall_id>0) {
				$worksheet->writeString($row, 1, $order_prev->sidewall_type . ' nr ' .
					$order_prev->sidewall_number, $standard);
			}
			if ($order_prev->tread_segment_id>0) {
				$season = $order_prev->tread_segment_season=='winter' ? 'Zima' : 'Lato';
				$worksheet->writeString($row, 1, 'CSP ' . $season . ' ' .
					$order_prev->tread_segment_number, $standard);
			}
			
		} else {
			$worksheet->writeString($row, 1, 'Oczekiwanie', $standard);
		}
		
		$worksheet->writeString($row, 2, sprintf( "%02.2d:%02.2d",
			floor($order->order_report_duration/60 ), $order->order_report_duration % 60),
			$standard_right);
		
		// Remember total seconds;
		$total_seconds += $order->order_report_duration;
}

$row++;
$worksheet->writeString($row, 1, 'Suma:', $bold_right);
$worksheet->writeString($row, 2, $this->sectToHourMin($total_seconds), $bold_right);
$row++;
$worksheet->writeString($row, 1, 'Data wygenerowania:', $standard_italic);
$worksheet->writeString($row, 2, $this->data->datetime_request, $standard_italic_right);

// Let's send the file
$res = $workbook->close();
if (PEAR::isError($res)) {
	App::emerg($res->getMessage());
}