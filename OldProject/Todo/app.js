function AddNew() {
    // console.log('AddNew');

    if (document.querySelector('#newtask input').value.length == 0) {
        let error = document.getElementsByClassName("error");
        error[0].style.display = 'block';

        setTimeout(() => {
            error[0].style.display = 'none';
        }, 2500);
    }

    else {
        let id = Math.random();

        document.querySelector('#tasks').innerHTML += `
            <div class="task">
                <input type="checkbox" class="checkbox" id="${id}" onchange="Editor(this.id);"/>
                
                <span id="taskname">
                    ${document.querySelector("#newtask input").value}
                </span>

                <button id="${id}" class="delete" onclick="Remover(this.id);">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>`;

        document.querySelector("#newtask input").value = "";
    }
}

function Remover(id) {
    let curent = document.getElementById(id);
    curent = curent.parentElement;
    curent.remove();
}

function Editor(id) {
    let curent = document.getElementById(id);
    curent = curent.parentElement;
    curent.classList.toggle('completed')
}