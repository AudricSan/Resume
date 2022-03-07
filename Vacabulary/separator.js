var section = document.querySelector('section');

var requestURL = 'Vocabulary.json';
var request = new XMLHttpRequest();
request.open('GET', requestURL);
request.responseType = 'json';

request.send(); request.onload = function () {
    var response = request.response;
    return ok(response);
};

function ok(jsonObj) {
    // console.log(response.List);
    list = jsonObj.List;
    console.log(list);

    label = "verb";
    var verb;

    list.forEach(element => {
        if (element.Label == label) {
            console.log(element);
            // verb.push(element);

        } else {
            console.log("oucou")
        }
    });

    Label: "place"
    a = JSON.stringify(verb);
    download("hello.json", a);
}

function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}  