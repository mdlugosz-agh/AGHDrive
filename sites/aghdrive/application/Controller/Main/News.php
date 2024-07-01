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
        $this->response->news_list = $this->readContentList(PATH_TO_CONTENT_NEWS);
        
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
        
        // Read content of news
        $this->response->news = $this->readContent(PATH_TO_CONTENT_NEWS, $this->request->route['id'] . '.php');
        
        $this->response->template = 'news/news';

        return $this->response;
    }
}