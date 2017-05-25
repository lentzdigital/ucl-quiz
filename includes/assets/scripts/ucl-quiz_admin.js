jQuery( document ).ready( function( $ ) {
	var data = { questions: question_data };

	renderTemplate(data);

	$('.slides').sortable({
		placeholder: "slide-placeholder",
		stop: function(event, ui) {
			var newOrder = [];

			$('.slides .slide').each(function(item, v) {
				var oldIndex = $(this).attr('data-index');

				newOrder.push(data.questions[oldIndex]);
			});

			data.questions = newOrder;
		}
	});

	$(document).on('click', '.uq-add', function() {
		data.questions.push({question: '', hint: '', answers: []});

		renderTemplate(data);
	});

	$(document).on('click', '.uq-delete', function() {
		var index = $(this).closest('.slide').attr('data-index');
		data.questions.splice(index, 1);

		renderTemplate(data);
	});

	$(document).on('click', '.uq-add-answer', function() {
		var qindex = $(this).closest('.slide').attr('data-index');
		data.questions[qindex].answers.push({answer: '', correct: false});

		renderTemplate(data);
	});

	$(document).on('click', '.uq-delete-answer', function() {
		var qindex = $(this).closest('.slide').attr('data-index');
		var aindex = $(this).closest('.quiz-answer').attr('data-index');
		data.questions[qindex].answers.splice(aindex, 1);

		renderTemplate(data);
	});

	$(document).on('keyup', '.slides input', function() {
		var input = $(this),
			qindex = input.closest('.slide').attr('data-index'),
			aindex = input.closest('.quiz-answer').attr('data-index'),
			key = input.attr('data-key'),
			value = input.val();

		//Convert to boolean if it's a checkbox
		if (input.attr('type') == 'checkbox') {
			value = input.prop('checked')
		}

		if (typeof aindex === 'undefined') {
			data.questions[qindex][key] = value
		}else {
			data.questions[qindex][aindex][key] = value
		}
	});
});


function renderTemplate(data) {
	var template = Handlebars.compile(jQuery("#quiz-template").html());

	jQuery('.slides').html(template(data));
}
