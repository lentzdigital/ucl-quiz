<div class="wrap">
	<div class="form-control">
		<label>
			Fag <br>
			
			<select name="uc_course">
				<?php foreach ($courses as $course) { ?>
					<option value="<?= $course['id'] ?>"><?= $course['name'] ?></option>
				<?php } ?>
			</select>
		</label>
	</div>

	<div class="form-control">
		<label>
			Niveau <br>
			
			<select name="uc_course">
				<?php foreach ($levels as $key => $value) { ?>
					<option value="<?= $key ?>"><?= $value ?></option>
				<?php } ?>
			</select>
		</label>
	</div>
</div>
