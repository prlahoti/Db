
<!--
In application/controllers
Main.php

In application/views
login_view.php


In application/models
Opt.php
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Opt');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function get()
	{
		$data=array('id'=>$this->input->post('id'),'name'=>$this->input->post('name'));

		if ($this->input->post('select'))
		{
			$this->sel($data);
		}
		elseif ($this->input->post('insert'))
		{
			$this->ins($data);
		}
		elseif($this->input->post('update'))
		{
			$this->upd($data);
		}
		elseif($this->input->post('delete'))
		{
			$this->del($data);
		}
	}
	
	public function ins($data)
	{
		if (empty($data['id']) && !empty($data['name']))
		{
			$result=$this->Opt->insert($data);
			if ($result==true)
			{
				echo "Inserted Successfully";
				$this->index();
			}
			else
			{
				echo "Error";
				$this->index();
			}
		}
		elseif(empty($id) && empty($name))
		{
			echo "Both Fields Empty";
			$this->index(); 
		}
		else
		{
			echo "Only Name To Be Entered";
			$this->index();
		}
	}


	public function sel($data)
	{
		if (empty($data['id']) && !empty($data['name']))
		{	
			$status='name';
			$query=$this->Opt->select($data,$status);
			$this->show($query);
			
		}
		elseif (!empty($data['id']) && empty($data['name']))
		{	
			$status='id';
			$query=$this->Opt->select($data,$status);
			$this->show($query);
			
		}
		elseif(!empty($data['id']) && !empty($data['name']))
		{
			$status='both';
			$query=$this->Opt->select($data,$status);
			$this->show($query);
		}
		elseif(empty($id) && empty($name))
		{
			echo "Both Fields Empty";
			$this->index(); 
		}
		
	}

	public function show($query)
	{
		if($query->num_rows()>0)
            {
                foreach($query->result() as $row) 
                {
                    echo "ID=".$row->id . "   " ."NAME=". $row->name . '<br>';
                }
            }
        else
        {
            echo "No results to show";
        }
		$this->index();
	}

	public function del($data)
	{
		if (empty($data['id']) && !empty($data['name']))
		{
			$status='name';
			$result=$this->Opt->delete($data,$status);
			if ($result>'-1')
			{
				echo $result." row(s) Deleted Successfully";
				$this->index();
			}
			else
			{
				echo "Error";
				$this->index();
			}
		}
		
		elseif(!empty($data['id']))
		{
			$status='id';
			$result=$this->Opt->delete($data,$status);
			if ($result>'-1')
			{
				echo $result." row(s) Deleted Successfully";
				$this->index();
			}
			else
			{
				echo "Error";
				$this->index();
			}
		}

		elseif(empty($id) && empty($name))
		{
			echo "Both Fields Empty";
			$this->index(); 
		}
	}

	public function upd($data)
	{
		if(!empty($data['id']) && !empty($data['name']))
		{
			$result=$this->Opt->update($data);
			if($result>'-1')
			{
				echo $result." row(s) Updated Successfully";
				$this->index();
			}
			else
			{
				echo "Error";
				$this->index();
			}	
		}
		else
		{
			echo "Field(s) empty!!";
			$this->index();
		}	
	}
}

?>
