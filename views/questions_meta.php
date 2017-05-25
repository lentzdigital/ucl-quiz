<div class="slides-wrapper">
	<div class="slides">
		<?php foreach ($questions as $qindex => $question) { ?>
			<div class="slide" data-index="<?= $qindex ?>">
				<div class="slide-name form-control">
					<label>
						Title <br>
						<input type="text" name="uq_name[]" class="large-text" value="<?= $question['name'] ?>">
					</label>

					<label>
						Hint <br>
						<input type="text" name="uq_hint[]" class="large-text" value="<?= $question['hint'] ?>">
					</label>
				</div>

				<div class="quiz-answers">
					<?php foreach ($question['answers'] as $index => $answer) { ?>
						<div class="quiz-answer" data-index="<?= $index ?>">
							<label>
								Svar <br>
								<input type="text" name="uq_answers[<?= $qindex ?>][<?= $index ?>][name]" class="large-text" value="<?= $answer['name'] ?>">
							</label>

							<label>
								Rigtigt <br>
								<input type="checkbox" name="uq_answers[<?= $qindex ?>][<?= $index ?>][correct]" class="large-text" <?= $answer['correct'] ? 'checked' : '' ?>>
							</label>
						</div>
					<?php } ?>
				</div>

				<div class="button ss-delete">x</div>
			</div>
		<?php } ?>
	</div>

	<div class="button-primary uq-add">+</div>
</div>

<script id="quiz-template" type="text/x-handlebars-template">
	{{#each questions as |question qindex|}}
		<div class="slide" data-index="{{ qindex }}">
			<div class="slide-name form-control">
				<label>
					Title <br>
					<input type="text" name="uq_name[]" class="large-text" value="{{ question.question }}">
				</label>

				<label>
					Hint <br>
					<input type="text" name="uq_hint[]" class="large-text" value="{{ question.hint }}">
				</label>
			</div>

			<div class="quiz-answers">
				{{#each question.answers as |answer aindex|}}
					<div class="quiz-answer" data-index="{{ aindex }}">
						<label>
							Svar <br>
							<input type="text" name="uq_answers[{{ qindex }}][{{ aindex }}][name]" class="large-text" value="{{ answer.answer }}">
						</label>

						<label>
							Rigtigt <br>
							<input type="checkbox" name="uq_answers[{{ qindex }}][{{ aindex }}][correct]" class="large-text" {{#if answer.correct }}checked{{/if}}>
						</label>

						<div class="button uq-delete-answer">Slet svar</div>
					</div>
				{{/each}}
				<div class="button uq-add-answer">Tilføj svar</div>
			</div>

			<div class="button uq-delete">x</div>
		</div>
	{{/each}}
</script>
