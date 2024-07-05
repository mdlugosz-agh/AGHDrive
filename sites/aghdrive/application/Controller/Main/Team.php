<?php
class Controller_Main_Team extends Controller
{
	    
    /**
     * list
     *
     * @return Data_Response
     */
    public function list() : Data_Response
	{
		parent::run();
        
        // Read news list
        $this->response->members = $this->readContentList(PATH_TO_CONTENT_TEAM, SCANDIR_SORT_ASCENDING);
        
        // Set template name
        $this->response->template = 'team/list';
        
		return $this->response;
	}
       
    public function member() : Data_Response
    {
        parent::run();
        
        // Read content of news
        $this->response->member = $this->readContent(PATH_TO_CONTENT_TEAM, $this->request->route['id'] . '.php');
        
        $this->response->template = 'team/member';

        return $this->response;
    }
}