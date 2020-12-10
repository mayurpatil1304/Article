<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="col-lg-5" style=" margin-top:20" >
		<a class="btn btn-secondary"  href="<?php echo base_url()?>users/index"><- Home Page</a>
		
</div>
</div>
<div class="container" style="margin-top:50px">
	<div class="row">
		<a href="adduser" class="btn btn-lg btn-primary">Add Article</a>
	</div>
</div>


<div class="container" style="margin-top:50px">

<?php if($msg=$this->session->flashdata('msg')): 
	$msg_class=$this->session->flashdata('msg_class') ?>
		<div class="row">
		<div class="col-lg-6">
		<div class="alert <?= $msg_class; ?>">
		<?=	 $msg; ?>	
	
</div>
</div>
</div>
	<?php endif; ?>

<!--<?php echo $this->db->last_query(); ?>-->

<div class="table">
<table>
	<thead>
	<tr>
		<th>Sr.No</th>
		<th>Article Title</th>
		<th>Article Body</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	</thead>
	<tbody>
		<?php if ($articles):
			$count=$this->uri->segment(3);
			?>

	<?php foreach ($articles as $art): ?>	
		<tr>
			<td><?=  ++$count; ?></td>
			<td><?= $art->article_title; ?></td>
			<td><?= $art->article_body; ?></td>
			<td><?=  anchor("admin/edituser/{$art->id}",'Edit',['class'=>'btn btn-secondary']);  ?></td>
			<td>
				<?=
				form_open('admin/delarticles'),
				form_hidden('id',$art->id),
				form_submit(['name'=>'submit','value'=>'Delete','class'=>'btn btn-danger']),
				form_close();
				?>
				
		</tr>
	<?php endforeach; ?>
	<?php else: ?>
		<tr>
			<td colspan="3">Not Data Available</td>
		</tr>
<?php endif; ?>
	
	</tbody>

</table>
 
<?= $this->pagination->create_links(); ?>
</div>
</div>

<?php	include('footer.php'); ?>