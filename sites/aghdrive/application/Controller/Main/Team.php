<?php
class Controller_Main_Team extends Controller
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function list() : Data_Response
	{
		parent::run();
		
        // Read memeber list
        $this->response->members = array_filter(
            scandir( join(DIRECTORY_SEPARATOR, array('..', '..','application', 'content', 'team')),  
            SCANDIR_SORT_ASCENDING), 
            array($this, 'filter1'));
        
        // Set template name
        $this->response->template = 'team/list';

		return $this->response;
	}
    
    public function member() : Data_Response
    {
        parent::run();

        $this->response->template = 'team/member';

        return $this->response;
    }

    /**
     * filter1
     *
     * @param string value
     *
     * @return bool
     */
    static public function filter1(string $value) : bool
    {
        return preg_match('/^\d{3}-short\.html$/', $value)==1 ? true : false;
    }
}