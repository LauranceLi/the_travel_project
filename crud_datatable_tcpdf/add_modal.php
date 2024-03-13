<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel">新增行程</h4>
				</center>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="add.php">
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">圖片:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="logo" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">行程標題:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label for="introduce" class="form-label">行程簡介:</label></div>
								<div class="col-sm-10">
								<textarea class="form-control" name="introduce" id="introduce" cols="30"
									rows="3"></textarea>
								<div class="form-text"></div>
							</div>
						</div>



						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">天數:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="days" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">售價:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="price" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">出發日期:</label>
							</div>
							<div class="col-sm-10">
								<input type="date" class="form-control" name="time" required>
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
								<input type="text" class="form-control" name="seat" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">已報名人數:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="number" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-2">
								<label class="control-label modal-label">可售機位:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="sale" required>
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
				<button type="submit" name="add" class="btn btn-primary"><span
						class="glyphicon glyphicon-floppy-disk"></span> Save</a>
					</form>
			</div>

		</div>
	</div>
</div>