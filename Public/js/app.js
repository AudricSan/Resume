const body = document.body
const toggle = document.getElementsByClassName("toggleDiv")
const hours = new Date().getHours()

if (hours > 7 && hours < 18) {
	console.log("day")
	lightmode()
} else {
	console.log("night")
}

function lightmode() {
	body.classList.toggle("white")
	toggle[0].classList.toggle("white")
}

function addfomrs(elem) {
	let form = elem.parentElement.parentElement.getElementsByTagName("form")
	form[0].classList.toggle("hidden")

	if (elem.innerHTML === "Remove") {
		elem.innerHTML = "Add"
	} else {
		elem.innerHTML = "Remove"
	}
}