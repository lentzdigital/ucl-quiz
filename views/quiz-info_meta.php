<div class="wrap">
	<div class="form-control">
		<label>
			Fag <br>
			
			<select name="uq_course">
				<?php foreach ($courses as $course) { ?>
					<option value="<?= $course->ID ?>" <?= $course->ID == $meta['course'] ? 'selected' : '' ?>><?= $course->post_title ?></option>
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
