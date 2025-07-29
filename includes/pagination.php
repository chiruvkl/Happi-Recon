<?php
	class Pagination
	{
		public $current_page = 1;
		public $limit = 10;
		public $total_rows = 0;
		public $base_url = '';
		public $get_string = '';
		public $total_pages = 0;
		public $allow_display_pages = TRUE;
		public $num_display_pages = 7;
		public $first_page = 1;
		public $last_page = 0;
		public $first_page_link_name = 'First';
		public $last_page_link_name = 'Last';
		public $next_page = 0;
		public $prev_page = 0;
		public $next_page_link_name = 'Next';
		public $prev_page_link_name = 'Prev';
		public $link_start_tag = '<div class="pagination">';
		public $link_end_tag = '</div>';
		public $current_page_class = 'current';
		
		public $links = '';
		
		public function __construct($params = array())
		{
			if(!empty($params))
				$this->initialize($params);
		}

		public function initialize($params = array())
		{
			if(!empty($params))
			{
				foreach($params as $var => $val)
				{
					$this->$var = $val;
				}
			}
		}

		public function create_links()
		{
			$this->links = '';
			$this->build_get_string();
			
			if($this->total_rows > 0 && $this->limit != 0)
			{
				$this->total_pages = ceil(intval($this->total_rows) / intval($this->limit));
				$this->last_page = $this->total_pages;
				$this->next_page = intval($this->current_page) + 1;
				$this->prev_page = intval($this->current_page) - 1;
			}
			
			if(($this->current_page < 1) OR ($this->total_pages < $this->current_page))
				return FALSE;
			
			$pages_arr = array($this->first_page, $this->last_page);
			$current_class = '';
			
			$this->links .= $this->link_start_tag;
			
			if($this->total_pages > $this->num_display_pages)
			{
				if($this->first_page)
				{
					$url = $this->base_url . '?' . $this->get_string . 'page=' . $this->first_page;		
					$current_class = '';	
						
					if($this->current_page == $this->first_page)
					{
						$url = '#';
						$current_class = $this->current_page_class;
					}
					
					$this->links .= "<a href='$url' class='$current_class'>" . $this->first_page_link_name . "</a>";
				}
				
				if($this->prev_page && ($this->prev_page > $this->first_page))
				{
					$url = $this->base_url . '?' . $this->get_string . 'page=' . $this->prev_page;	
					$current_class = '';	
						
					if($this->current_page == $this->prev_page)
					{
						$url = '#';	
						$current_class = $this->current_page_class;
					}
					
					$this->links .= "<a href='$url' class='$current_class'>" . $this->prev_page_link_name . "</a>";
				}
			}
			
			if($this->allow_display_pages)
			{
				if($this->current_page == $this->first_page || $this->current_page == $this->last_page)
				{
					$this->num_display_pages = $this->num_display_pages + 2;
				}
				
				$num = floor($this->num_display_pages / 2);
				$start = $this->current_page - $num;
				$last = $this->current_page + $num;
				if($start < $this->first_page)
					$start = $this->first_page;
				if($last > $this->last_page)
					$last = $this->last_page;
			}
			else
			{
				$start = $this->first_page;
				$last = $this->last_page;
			}
			
			if($this->total_pages <= $this->num_display_pages)
			{
				$start = 1;
				$last = $this->total_pages;
				
				$pages_arr = array();
			}
			
			for($i = $start; $i <= $last; $i++)
			{
				if(!in_array($i, $pages_arr))
				{
					$url = $this->base_url . '?' . $this->get_string . 'page=' . $i;
					$current_class = '';	
						
					if($this->current_page == $i)
					{
						$url = '#';	
						$current_class = $this->current_page_class;
					}	
					
					$this->links .= "<a href='$url' class='$current_class'>$i</a>";
				}
			}
			
			if($this->total_pages > $this->num_display_pages)
			{
				if($this->next_page && ($this->next_page < $this->last_page))
				{
					$url = $this->base_url . '?' . $this->get_string . 'page=' . $this->next_page;	
					$current_class = '';	
						
					if($this->current_page == $this->next_page)
					{
						$url = '#';	
						$current_class = $this->current_page_class;
					}
					
					$this->links .= "<a href='$url' class='$current_class'>" . $this->next_page_link_name . "</a>";
				}
				
				if($this->last_page)
				{
					$url = $this->base_url . '?' . $this->get_string . 'page=' . $this->last_page;	
					$current_class = '';	
						
					if($this->current_page == $this->last_page)
					{
						$url = '#';	
						$current_class = $this->current_page_class;
					}
					
					$this->links .= "<a href='$url' class='$current_class'>" . $this->last_page_link_name . "</a>";
				}
			}
			
			$this->links .= $this->link_end_tag;
			
			return $this->links;
		}

		private function build_get_string()
		{
			$get_string = $this->get_string;
			
			if(is_array($get_string) && !empty($get_string))
			{
				$this->get_string = '';
				
				foreach($get_string as $key => $val)
				{
					$this->get_string .= $key . '=' . $val . '&';
				}
			}
		}

	}
?>