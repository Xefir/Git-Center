window.addEventListener('load', function () {
	var sections = document.querySelectorAll('section');
	for (var i = 0; i < sections.length; i++) {
		callRequest('status', sections[i].id);
	}
});

function callRequest(action, section, message) {
	var pre = document.querySelector('#' + section + ' pre');
	pre.innerHTML = '<span class="loading">Loading ...</span>';

	var label = document.querySelector('#' + section + ' .label');
	label.classList.remove('label-success');
	label.classList.remove('label-important');
	label.classList.add('label-warning');
	label.innerHTML = 'Loading';

	var buttons = document.querySelectorAll('#' + section + ' button');
	for (var button in buttons) {
		if (buttons.hasOwnProperty(button)) {
			buttons[button].disabled = true;
		}
	}

	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'ajax.php');
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send('action=' + action + '&section=' + section + '&message=' + message);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
			pre.innerHTML = xhr.responseText;

			var splitLabel = xhr.responseText.split("\n").reverse();
			label.classList.remove('label-warning');
			if ((typeof splitLabel[1] !== 'undefined' && !splitLabel[1].match(/nothing to commit/)) || xhr.responseText.match(/by [0-9]* commit/)) {
				label.classList.add('label-important');
				label.innerHTML = 'Update needed';
			} else {
				label.classList.add('label-success');
				label.innerHTML = 'OK';
			}

			for (var button in buttons) {
				if (buttons.hasOwnProperty(button)) {
					buttons[button].disabled = false;
				}
			}
			document.querySelector('#' + section + ' input').value = '';
		}
	};
}
