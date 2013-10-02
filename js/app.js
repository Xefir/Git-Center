window.addEventListener('load', function() {
	var sections = document.querySelectorAll('section');
	for (var i = 0; i < sections.length; i++) {
		callRequest(sections[i].id);
	}
});

function callRequest(section) {
	var pre = document.querySelector('#' + section + ' pre');
	pre.innerHTML = '<span class="loading">Loading ...</span>';
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'ajax.php');
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send('section=' + section);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
			var data = JSON.parse(xhr.responseText);
			pre.innerHTML = data['pre'];
		}
	};
}
