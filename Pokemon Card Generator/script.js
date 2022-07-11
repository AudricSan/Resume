const typeColor = {
  bug: "#26de81",
  dragon: "#ffeaa7",
  electric: "#fed330",
  fairy: "#FF0069",
  fighting: "#30336b",
  fire: "#f0932b",
  flying: "#81ecec",
  grass: "#00b894",
  ground: "#EFB549",
  ghost: "#a55eea",
  ice: "#74b9ff",
  normal: "#95afc0",
  poison: "#6c5ce7",
  psychic: "#a29bfe",
  rock: "#2d3436",
  water: "#0190FF",
};

const url = " https://pokeapi.co/api/v2/pokemon/";
const container = document.getElementById("cardContainer");
const btn = document.getElementById("btn");
const btnAll = document.getElementById("btnAll");

let getPokeData = () => {
  // Generate a random number between 1 and 150
  let id = Math.floor(Math.random() * 150) + 1;

  // Combine the pokeapi url with pokemon id
  const finalUrl = url + id;

  // Fetch generated URL
  fetch(finalUrl)
    .then((response) => response.json())
    .then((data) => {
      generateCard(data, 0);
    });
};

let getAllPokeData = () => {
  for (let i = 1; i <= 150; i++) {
    const finalUrl = url + i;

    fetch(finalUrl)
      .then((response) => response.json())
      .then((data) => {
        generateCard(data, i);
      });
  }
};

//Generate Card
let generateCard = (data, i) => {
  // Get necessary data and assign it to variables
  console.log(data);
  const hp = data.stats[0].base_stat;
  const nb = data.id;
  const imgSrc = data.sprites.other.dream_world.front_default;
  const pokeName = data.name[0].toUpperCase() + data.name.slice(1);
  const statAttack = data.stats[1].base_stat;
  const statDefense = data.stats[2].base_stat;
  const statSpeed = data.stats[5].base_stat;

  // Set themeColor based on pokemon type
  const themeColor = typeColor[data.types[0].type.name];

  const card = document.createElement("div");

  card.innerHTML = `
        <div class="cc">
          <p class="nb">
            <span>ID</span>
              ${nb}
          </p>
          <p class="hp">
            <span>HP</span>
              ${hp}
          </p>
        </div>
        <img src=${imgSrc} />
        <h2 class="poke-name">${pokeName}</h2>
        <div class="types" id="${i}">
         
        </div>
        <div class="stats">
          <div>
            <h3>${statAttack}</h3>
            <p>Attack</p>
          </div>
          <div>
            <h3>${statDefense}</h3>
            <p>Defense</p>
          </div>
          <div>
            <h3>${statSpeed}</h3>
            <p>Speed</p>
          </div>
        </div>
  `;

  container.appendChild(card);
  appendTypes(data.types, i);
  styleCard(themeColor, card, i);

};

let appendTypes = (types, n) => {
  types.forEach((item) => {
    let span = document.createElement("SPAN");
    span.textContent = item.type.name;
    document.getElementById(n).appendChild(span);
  });
};

let styleCard = (color, card) => {
  card.style.background = `radial-gradient(circle at 50% 0%, ${color} 36%, #ffffff 36%)`;
  card.querySelectorAll(".types span").forEach((typeColor) => {
    typeColor.style.backgroundColor = color;
  });
};

function oneclick() {
  oldremover();
  getPokeData();
}

function allclick() {
  oldremover();
  getAllPokeData();
}

function oldremover(){
  child = container.lastElementChild;
  container.removeChild(child);
}

window.addEventListener("load", getPokeData);