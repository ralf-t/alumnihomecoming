$(function() {


	var min = 1946,
	max = new Date(),
	select = document.getElementById('batch');

	for (var i = max.getFullYear() - 1; i>=min; i--){
		var opt = document.createElement('option');
		opt.value = i;
		opt.innerHTML = i;
		select.appendChild(opt);
	}
});
