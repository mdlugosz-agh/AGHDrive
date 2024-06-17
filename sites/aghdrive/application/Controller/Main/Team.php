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
            function(string $value){ return preg_match('/^\d{3}\.tpl$/', $value)==1 ? true : false; });
        
        // Remove .tpl from file data member
        $this->response->members = array_map(
            function(string $value){ return str_replace('.tpl', '', $value); }, 
            $this->response->members);

        // Set template name
        $this->response->template = 'team/list';

		return $this->response;
	}
        
    /**
     * member
     *
     * @return Data_Response
     */
    public function member() : Data_Response
    {
        parent::run();
    
        $this->response->member = $this->request->route['id'];
        $this->response->template = 'team/member';

        return $this->response;
    }
}