const body = document.body
const toggle = document.getElementsByClassName("toggleDiv")
const hours = new Date().getHours()

if (hours > 7 && hours < 18) {
	console.log("day")
} else {
	console.log("night")
	darkmode()
}

function darkmode() {
	body.classList.toggle("dark")
	toggle[0].classList.toggle("dark")
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