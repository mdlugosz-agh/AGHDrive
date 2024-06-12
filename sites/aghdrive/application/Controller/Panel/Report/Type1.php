<?php
class Controller_Panel_Report_Type1 extends Controller_Main_Report_Type1
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		if ($this->request->isset('output') and $this->request->output=='xls') {
			// If export to xls change templat
			$this->response->template = '../../application/template/main/report/xls/type1.php';
		}
	}
}