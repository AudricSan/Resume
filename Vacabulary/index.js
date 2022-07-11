var section = document.querySelector('section');

var requestURL = 'Vocabulary.json';
var request = new XMLHttpRequest();
request.open('GET', requestURL);
request.responseType = 'json';

request.send(); request.onload = function () {
    var response = request.response;
    showResponse(response);
};

function showResponse(jsonObj) {
    var myArticle = document.createElement('article');
    var Name = document.createElement('h2');
    var Version = document.createElement('p');
    var Creation = document.createElement('p');
    var Active = document.createElement('p');
    var lastuse = document.createElement('p');
    var score = document.createElement('p');

    var ListOFWord = document.createElement('ul');
    var ListOFWordname = document.createElement('p');

    ListOFWord.appendChild(ListOFWordname);

    Name.textContent = jsonObj.Name;
    Version.textContent = 'Version: ' + jsonObj.Version;
    Creation.textContent = 'Creation: ' + jsonObj.Creation;
    Active.textContent = 'Active Statut: ' + jsonObj.Active;
    lastuse.textContent = 'last use: ' + jsonObj.lastuse;
    score.textContent = 'score: ' + jsonObj.score;
    ListOFWordname.textContent = 'List Item:';

    list = jsonObj.List;
    list.forEach(element => {
        var Items = document.createElement('li');
        var Name = document.createElement('p');

        var word = document.createElement('ul');
        var Francais = document.createElement('li');
        var English = document.createElement('li');
        var Rōmanji = document.createElement('li');
        var Kanji = document.createElement('li');
        var Kana = document.createElement('li');
        var Label = document.createElement('li');
        var Type = document.createElement('li');

        Name.innerText = element.Francais;
        Francais.innerText = "Francais : " + element.Francais;
        English.innerText = "English  : " + element.English;
        Rōmanji.innerText = "Rōmanji  : " + element.Rōmanji;
        Kanji.innerText = "Kanji    : " + element.Kanji;
        Kana.innerText = "Kana     : " + element.Kana;
        Label.innerText = "Label    : " + element.Label;
        Type.innerText = "Type     : " + element.Type;

        Items.appendChild(Name);
        word.appendChild(Francais);
        word.appendChild(English);
        word.appendChild(Rōmanji);
        word.appendChild(Kanji);
        word.appendChild(Kana);
        word.appendChild(Label);
        word.appendChild(Type);

        Items.appendChild(word);
        ListOFWord.appendChild(Items);
    });

    myArticle.appendChild(Name);
    myArticle.appendChild(Version);
    myArticle.appendChild(Creation);
    myArticle.appendChild(Active);
    myArticle.appendChild(lastuse);
    myArticle.appendChild(score);
    myArticle.appendChild(ListOFWord);

    section.appendChild(myArticle);
}