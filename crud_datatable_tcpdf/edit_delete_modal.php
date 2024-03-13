<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['travel_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">編輯行程</h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="edit.php">
						<input type="hidden" class="form-control" name="travel_id" value="<?php echo $row['travel_id']; ?>">
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">圖片:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="logo" value="<?php echo $row['logo']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">行程標題:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title"
									value="<?php echo $row['title']; ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label for="introduce" class="form-label">行程簡介:</label>
							</div>
							<div class="col-sm-10">
								<textarea class="form-control" name="introduce" id="introduce" cols="30"
									rows="3"><?php echo $row['introduce']; ?></textarea>
							</div>
						</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">天數:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="days" value="<?php echo $row['days']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">售價:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">出發日期:</label>
					</div>
					<div class="col-sm-10">
						<input type="date" class="form-control" name="time" value="<?php echo $row['time']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-10">
						<label for="airline">航空公司：</label>
						<select name="airline" id="airline">
							<option value="長榮航空">長榮航空</option>
							<option value="星宇航空">星宇航空</option>
							<option value="中華航空">中華航空</option>
							<option value="阿聯酋航空">阿聯酋航空</option>
							<option value="土耳其航空">土耳其航空</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">機位數量:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="seat" value="<?php echo $row['seat']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">已報名人數:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="number" value="<?php echo $row['number']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">可售機位:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="sale" value="<?php echo $row['sale']; ?>">
					</div>
				</div>


				<div class="row form-group">
					<div class="col-sm-10">
						<label for="sign_up">出團狀態：</label>
						<select name="sign_up" id="sign_up">
							<option value="報名中">報名中</option>
							<option value="額滿">額滿</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><span
					class="glyphicon glyphicon-remove"></span> Cancel</button>
			<button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>
				Update</a>
				</form>
		</div>

	</div>
</div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['travel_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">刪除行程</h4>
				</center>
			</div>
			<div class="modal-body">
				<p class="text-center">是否要刪除?</p>
				<h2 class="text-center">
					<?php echo $row['title']; ?>
				</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span
						class="glyphicon glyphicon-remove"></span> Cancel</button>
				<a href="delete.php?travel_id=<?php echo $row['travel_id']; ?>" class="btn btn-danger"><span
						class="glyphicon glyphicon-trash"></span> Yes</a>
			</div>

		</div>
	</div>
</div>