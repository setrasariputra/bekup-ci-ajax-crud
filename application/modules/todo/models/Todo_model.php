<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Todo_model extends CI_Model {
	
	function __Construct()
	{
		parent::__Construct();
		$this->load->model('crud');
		$this->load->library('filter');
	}

	function Tabledata()
	{		
		$field=$this->filter->FilterInput($this->uri->segment(4));
		$sort=$this->filter->FilterInput($this->uri->segment(5));
		$numberpaging=$this->filter->FilterInput($this->uri->segment(6));
		
		if(empty($field)) {
			$field='tbl_task.id';
			$sort='desc';
		}
		?>
		<table width="100%" style="margin:auto;" class="table table-bordered table-striped" cellpadding="5">
			<tr>
				<th class="text-center" width="40px">No</th>
				<th>Task</th>
				<th>Date</th>
				<th>Time</th>
				<th width="150px" class="text-center">Action</th>
			</tr>
			<?php
			$limit=20;
			$start_paging=$numberpaging*$limit;			
			$this->db->select('
				tbl_task.id,
				tbl_task.task,
				tbl_task.date,
				tbl_task.time,
			');
			$this->db->from('tbl_task');
			$this->db->order_by($field,$sort);
			$this->db->limit($limit,$start_paging);
			$query=$this->db->get();				
			if($query->num_rows() > 0) {				
				$no=$start_paging + 1;
				foreach($query->result() as $row) {
					?>
					<tr>
						<td align="center"><?php echo $no;?>.</td>
						<td><?php echo $row->task;?></td>
						<td><?php echo $row->date;?></td>
						<td><?php echo $row->time;?></td>
						<td align="center">
							<input type="button" class="btn btn-xs btn-warning load-dialog" value="Update" id="form-update-todo##<?php echo site_url("action/todo/form_update/$row->id");?>##form-update-todo" />
							<input type="button" class="btn btn-xs btn-danger delete" value="Delete" id="<?php echo site_url('action/todo/delete/'.$row->id);?>##<?php echo site_url('action/todo/tabledata');?>##todo-tabledata##sort-field-todo##sort-todo##number-paging-todo##max-paging-todo##display-todo" />
						</td>
					</tr>
					<?php
					$no++;
				}
			}else{
				?>
					<tr><td colspan="5" align="center"><br /><i>- There are no items in your data list -</i><br /><br /></td></tr>
				<?php
			}
			?>
			</table>
		<?php
			$this->db->select('id');
			$this->db->from('tbl_task');
						
			$query=$this->db->get();
			$num=$query->num_rows();
			$total_data=$num;
			$max_paging=ceil($total_data/$limit);
			?>
			<input type="hidden" class="max-paging-todo" value="<?php echo $max_paging;?>" />
			<br /><br />
		<?php		
		
	}
	
	function Insert()
	{
		$output=array('output'=>'false');

		$task=$this->filter->FilterInput($this->input->post('task'));
		$date=date('Y-m-d');
		$time=date('H:i:s');

		// Empty validation
		$arrayvalues=array('task'=>$task);
		$check_empty=$this->crud->EmptyValidation($arrayvalues);		

		// Duplicate validation
		$arrayvalues=array('task'=>$task);
		$check_duplicate=$this->crud->DuplicateValidation("tbl_task",$arrayvalues);
			
		if(!empty($check_empty)) {
			$output=array('output'=>"Please fill the empty field...!\n($check_empty)");
		}else
		if(!empty($check_duplicate)) {
			$output=array('output'=>"Duplicate field, please change with another value...!\n($check_duplicate)");		
		}else{
			$arrayvalues=array('task'=>$task,'date'=>$date,'time'=>$time);
			$query=$this->crud->InsertDefault('tbl_task',$arrayvalues);
			if($query) {
				$output=array('output'=>'true');
			}
		}
		echo json_encode($output);
	}	
	
	function Delete()
	{
		$output=array('output'=>'false');
		$id=$this->filter->FilterInput($this->uri->segment(4));
		
		$arraywhere=array('id'=>$id);
		$query=$this->crud->DeleteDefault('tbl_task',$arraywhere);
		if($query) {
			$output=array('output'=>'true');
		}
		
		echo json_encode($output);
	}		
	
	function Update()
	{
		$output=array('output'=>'false');

		$id=$this->filter->FilterInput($this->input->post('id'));
		$task=$this->filter->FilterInput($this->input->post('task'));

		// Empty validation
		$arrayvalues=array('task'=>$task);
		$check_empty=$this->crud->EmptyValidation($arrayvalues);

		// Duplicate validation
		$arrayvalues=array('id !='=>$id,'task'=>$task);
		$check_duplicate=$this->crud->DuplicateValidation("tbl_task",$arrayvalues);
			
		if(!empty($check_empty)) {
			$output=array('output'=>"Please fill the empty field...!\n($check_empty)");
		}else
		if(!empty($check_duplicate)) {
			$output=array('output'=>"Duplicate field, please change with another value...!\n($check_duplicate)");		
		}else{				
			$arrayvalues=array('task'=>$task);
			$arraywhere=array('id'=>$id);
			$query=$this->crud->UpdateDefault('tbl_task',$arrayvalues,$arraywhere);
			if($query) {
				$output=array('output'=>'true');
			}
		}
		echo json_encode ($output);

	}
	
	function FormInsert()
	{
		?>
		<form method="POST" action="<?php echo site_url('action/todo/insert');?>" class="form-submit" name="form-insert-todo##<?php echo site_url('action/todo/tabledata');?>##todo-tabledata##number-paging-todo##display-number-paging-todo##none##none##none##max-paging-todo##display-max-paging-todo" data-csrf="<?php echo site_url('action/get_CSRF_token');?>">
			<?php echo $this->crud->CreateToken();?>
			<table width="100%" class="table table-bordered table-striped">
				<tr><td>Task</td><td>:</td><td><input type="text" class="form-control" name="task" /></td></tr>
				<tr><td colspan="3"><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></td></tr>
			</table>
		</form>		
		<?php
	}

	function FormUpdate()
	{
		$id=$this->filter->FilterInput($this->uri->segment(4));
		$arrdata=$this->TodoDetail($id);
		?>
		<form method="POST" action="<?php echo site_url('action/todo/update');?>" class="form-submit" name="form-update-todo##<?php echo site_url('action/todo/tabledata');?>##todo-tabledata##number-paging-todo##display-number-paging-todo##sort-field-todo##sort-todo##number-paging-todo##max-paging-todo##display-max-paging-todo" data-csrf="<?php echo site_url('action/get_CSRF_token');?>">
			<?php echo $this->crud->CreateToken();?>
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<table width="100%" class="table table-bordered table-striped"> 
				<tr><td>Task</td><td>:</td><td><input type="text" class="form-control" name="task" value="<?php echo $arrdata["task"];?>" /></td></tr>
				<tr><td colspan="3"><input type="submit" name="submit" value="Update" class="btn btn-primary" /></td></tr>
			</table>
		</form>
		<?php
	}

	function TodoDetail($id)
	{
		$output=false;
		
		$this->db->select('*');
		$this->db->where('id',$id);
		$query=$this->db->get('tbl_task');
		if($query->num_rows() > 0) {
			$row=$query->row();
			$fields = $this->db->list_fields('tbl_task');
			foreach ($fields as $field) {
				$output[$field]=$row->$field;
			} 			
		}
		return $output;
	}

}
?>