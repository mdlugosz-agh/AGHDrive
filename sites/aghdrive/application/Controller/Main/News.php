<?php
class Controller_Main_News extends Controller
{	
    /**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function list() : Data_Response
	{
		parent::run();
        
        // Read news list
        $this->response->news_list = $this->readContent(PATH_TO_CONTENT_NEWS);

        // Set template name
        $this->response->template = 'news/list';
        
		return $this->response;
	}
        
    /**
     * member
     *
     * @return Data_Response
     */
    public function news() : Data_Response
    {
        parent::run();
    
        $this->response->news = $this->request->route['id'];
        $this->response->template = 'news/news';

        return $this->response;
    }
}