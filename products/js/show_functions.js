
let btnBuy = document.getElementById('btnBuy');


let btnPreBuy = document.getElementById('btnPreBuy');
btnPreBuy.addEventListener("click", function () {
	this.style.display = 'none';

	document.getElementById('divActionButtons').style.display = 'block';
});

let btnCancel = document.getElementById('btnCancel');
btnCancel.addEventListener("click", function () {
	document.getElementById('divActionButtons').style.display = 'none';
	btnPreBuy.style.display = 'block';
});

