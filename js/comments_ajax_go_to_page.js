function go_to_page(event) {
	event.preventDefault();
	var request = new XMLHttpRequest();
	request.open('GET',this.getAttribute('href'), true);
	request.onreadystatechange = function() {
		if (request.readyState == 4 )
			if (request.status == 200) {
				var parser = new DOMParser();
				var doc = parser.parseFromString(request.responseText, "text/html");
				
				var comments_view_old = document.getElementById('comments_view');
				var comments_view_new = doc.getElementById('comments_view');
				comments_view_old.replaceWith(comments_view_new);
				addListeners();
				if (event.target.parentNode.classList.contains('bottom'))
					window.location.hash = '#comments_view';
			}
	}
	request.send();
}

function addListeners() {
	var pages = document.getElementsByClassName('page_num');
	for (var i = 0; i < pages.length; i++)
		pages[i].addEventListener('click', go_to_page);
}

window.onload = addListeners;
