<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Transactions</h3>
		<!-- <div class="card-tools">
			<a href="?page=accounts/manage_account" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="indi-list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Account #</th>
						<th>Name</th>
						<th>Amount(US$)</th>
						<th>Transaction</th>
						<th>Date Created</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT t.*,concat(a.lastname,', ',a.firstname, a.middlename) as `name`,a.account_number from `transactions` t inner join `accounts` a on a.id = t.account_id order by unix_timestamp(t.date_created) desc ");
						while($row = $qry->fetch_assoc()):
					?>
					
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['account_number'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td class='text-right'><?php echo number_format($row['amount'],2) ?></td>
							<td><?php echo $row['remarks'] ?></td>
							<td><?php echo $row['date_created'] ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	var indiList;
	$(document).ready(function(){
		// $('.view_data').click(function(){
		// 	uni_modal("Indiviual Details","accounts/view_details.php?code="+$(this).attr('data-id'))
		// })
	})
	$(function(){
		$('#indi-list').dataTable()
	})
</script>