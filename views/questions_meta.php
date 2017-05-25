<div class="slides-wrapper">
	<div class="slides">
	</div>

	<div class="button-primary uq-add">+</div>
</div>

<script id="quiz-template" type="text/x-handlebars-template">
	{{#each questions as |question qindex|}}
		<div class="slide" data-index="{{ qindex }}">
			<div class="slide-name form-control">
				<label>
					Title <br>
					<input type="text" name="uq_name[]" data-key="question" class="large-text" value="{{ question.question }}">
				</label>

				<label>
					Hint <br>
					<input type="text" name="uq_hint[]" data-key="hint" class="large-text" value="{{ question.hint }}">
				</label>
			</div>

			<div class="quiz-answers">
				{{#each question.answers as |answer aindex|}}
					<div class="quiz-answer" data-index="{{ aindex }}">
						<label>
							Svar <br>
							<input type="text" name="uq_answers[{{ qindex }}][{{ aindex }}][name]" data-key="answer" class="large-text" value="{{ answer.answer }}">
						</label>

						<label>
							Rigtigt <br>
							<input type="checkbox" name="uq_answers[{{ qindex }}][{{ aindex }}][correct]" data-key="correct" class="large-text" {{#if answer.correct }}checked{{/if}}>
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
