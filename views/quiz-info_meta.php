<div class="wrap">
	<div class="form-control">
		<label>
			Fag <br>
			
			<select name="uq_course">
				<?php foreach ($courses as $course) { ?>
					<option value="<?= $course['id'] ?>" <?= $course['id'] == $meta['course'] ? 'selected' : '' ?>><?= $course['name'] ?></option>
				<?php } ?>
			</select>
		</label>
	</div>

	<div class="form-control">
		<label>
			Niveau <br>
			
			<select name="uq_level">
				<?php foreach ($levels as $key => $value) { ?>
					<option value="<?= $key ?>" <?= $key == $meta['level'] ? 'selected' : '' ?>><?= $value ?></option>
				<?php } ?>
			</select>
		</label>
	</div>
</div>
