$(document).ready(function () {

  $("#showmenu").click(function (e) {
    $("#menu").toggleClass("show");
  });
  $("#menu a").click(function (event) {
    if ($(this).next('ul').length) {
      event.preventDefault();
      $(this).next().toggle('fast');
      $(this).children('i:last-child').toggleClass('fa-caret-down fa-caret-left');
    }
  });

  var maskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
    options = {
      onKeyPress: function (val, e, field, options) {
        field.mask(maskBehavior.apply({}, arguments), options);
      }
    };

  $('.celNum').mask(maskBehavior, options);

  $("#cadastrarAnimal").validate({
    rules: {
      name: {
        required: true,
        maxlength: 100,
        minlength: 2,
      },
      size: {
        required: true,
      },
      type: {
        required: true,
      },
      adopted: {
        required: true,
      },
      description: {
        required: true,
        maxlength: 300,
        minlength: 5,
      }
    }
  }),
    $("#cadastrarUsuario").validate({
      rules: {
        nameProfile: {
          required: true,
          maxlength: 50,
          minlength: 5,
        },
        emailProfile: {
          required: true,
        },
        passProfile: {
          required: true,
          maxlength: 10,
          minlength: 4,
        },
        typeAccount: {
          required: true,
        }
      }
    }),
    $("#cadastrarPatrocinio").validate({
      rules: {
        namePatrocinio: {
          required: true,
          maxlength: 100,
          minlength: 2,
        },
        celPatrocinio: {
          required: true,
        }
      }
    }),
    $("#postAnimal").validate({
      rules: {
        tituloPost: {
          required: true,
          maxlength: 100,
          minlength: 2,
        },
        animal: {
          required: true,
        },
        finalidade: {
          required: true,
        },
        description: {
          required: true,
          maxlength: 300,
          minlength: 5,
        }
      }
    }),
    $("#editarAnimal").validate({
      rules: {
        nameAnimal: {
          required: true,
          maxlength: 50,
          minlength: 2,
        },
        porteAnimal: {
          required: true,
        },
        typeAnimal: {
          required: true,
        },
        adoptedAnimal: {
          required: true,
        },
        descriptionAnimal: {
          required: true,
          maxlength: 300,
          minlength: 5,
        }
      }
    }),
    $("#editarUsuario").validate({
      rules: {
        nomeProfile: {
          required: true,
          maxlength: 50,
          minlength: 2,
        },
        mailProfile: {
          required: true,
        },
        passProfile: {
          required: true,
          maxlength: 10,
          minlength: 4,
        },
        tipoConta: {
          required: true,
        }
      }
    }),
    $("#editarPatrocinador").validate({
      rules: {
        nomePatrocinador: {
          required: true,
          maxlength: 100,
          minlength: 2,
        },
        celPatrocinador: {
          required: true,
        }
      }
    })
})


/*** Input selecionar imagem Animais ***/
const fileSelect = document.getElementById("fileSelect"),
  fileElem = document.getElementById("fileElem"),
  fileList = document.getElementById("fileList");

fileSelect.addEventListener("click", function (e) {
  if (fileElem) {
    fileElem.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    fileList.innerHTML = "<p>Nenhum arquivo selecionado!</p>";
  } else {
    fileList.innerHTML = "";
    const list = document.createElement("ul");
    fileList.appendChild(list);
    for (let i = 0; i < files.length; i++) {
      const li = document.createElement("li");
      list.appendChild(li);

      const img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function () {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      const info = document.createElement("span");
      info.innerHTML = files[i].name;
      li.appendChild(info);

    }
  }
}

function cadastroSuccess() {
  var element = document.getElementById("alertSuccess");
  element.classList.add("show");
}

function editarSuccess() {
  var element = document.getElementById("alertWarning");
  element.classList.add("show");
}

function removerSuccess() {
  var element = document.getElementById("alertDanger");
  element.classList.add("show");
}

/*** Valores Modal Editar Animais ***/
var rIndexAnimais, tableAnimais = document.getElementById("tabelaAnimais");

function selectedRowToInput() {
  for (var i = 1; i < tableAnimais.rows.length; i++) {
    tableAnimais.rows[i].onclick = function () {
      rIndexAnimais = this.rowIndex;
      document.getElementById("idAnimal").value = this.cells[0].innerHTML;
      document.getElementById("nameAnimal").value = this.cells[2].innerHTML;
      document.getElementById("porteAnimal").value = this.cells[3].innerHTML;
      document.getElementById("typeAnimal").value = this.cells[4].innerHTML;
      document.getElementById("adoptedAnimal").value = this.cells[5].innerHTML;
      document.getElementById("descriptionAnimal").value = this.cells[6].innerHTML;
    };
  }
}
selectedRowToInput();

function editHtmlTbleSelectedRow() {
  var idAnimal = document.getElementById("idAnimal").value,
    nomeAnimal = document.getElementById("nameAnimal").value,
    porteAnimal = document.getElementById("porteAnimal").value,
    tipoAnimal = document.getElementById("typeAnimal").value;
  statusAnimal = document.getElementById("adoptedAnimal").value;
  sobreAnimal = document.getElementById("descriptionAnimal").value;
  if (!checkEmptyInput()) {
    tableAnimais.rows[rIndexAnimais].cells[0].innerHTML = idAnimal;
    tableAnimais.rows[rIndexAnimais].cells[1].innerHTML = nomeAnimal;
    tableAnimais.rows[rIndexAnimais].cells[2].innerHTML = porteAnimal;
    tableAnimais.rows[rIndexAnimais].cells[3].innerHTML = tipoAnimal;
    tableAnimais.rows[rIndexAnimais].cells[3].innerHTML = statusAnimal;
    tableAnimais.rows[rIndexAnimais].cells[3].innerHTML = sobreAnimal;
  }
}

/*** Valores Modal Editar Profile ***/
var rIndexProfile, tabelaProfile = document.getElementById("tabelaProfile");

function selectedRowToInputProfile() {
  for (var i = 1; i < tabelaProfile.rows.length; i++) {
    tabelaProfile.rows[i].onclick = function () {
      rIndexProfile = this.rowIndexProfile;
      document.getElementById("idProfile").value = this.cells[0].innerHTML;
      document.getElementById("nomeProfile").value = this.cells[1].innerHTML;
      document.getElementById("mailProfile").value = this.cells[2].innerHTML;
      document.getElementById("celProfile").value = this.cells[3].innerHTML;
      document.getElementById("tipoConta").value = this.cells[5].innerHTML;
    };
  }
}
selectedRowToInputProfile();

function editHtmlTbleSelectedRowProfile() {
  var idProfile = document.getElementById("idProfile").value,
    nomeProfile = document.getElementById("nomeProfile").value,
    emailProfile = document.getElementById("mailProfile").value,
    celProfile = document.getElementById("celProfile").value;
  tipoProfile = document.getElementById("tipoConta").value;
  if (!checkEmptyInput()) {
    tabelaProfile.rows[rIndexProfile].cells[0].innerHTML = idProfile;
    tabelaProfile.rows[rIndexProfile].cells[1].innerHTML = nomeProfile;
    tabelaProfile.rows[rIndexProfile].cells[2].innerHTML = emailProfile;
    tabelaProfile.rows[rIndexProfile].cells[3].innerHTML = celProfile;
    tabelaProfile.rows[rIndexProfile].cells[5].innerHTML = tipoProfile;
  }
}

/*** Valores Modal Editar Patrocinador ***/
var rIndexPatrocinador, tabelaPatrocinador = document.getElementById("tabelaPatrocinador");

function selectedRowToInputPatrocinador() {
  for (var i = 1; i < tabelaPatrocinador.rows.length; i++) {
    tabelaPatrocinador.rows[i].onclick = function () {
      rIndexPatrocinador = this.rowIndexPatrocinador;
      document.getElementById("idPatrocinador").value = this.cells[0].innerHTML;
      document.getElementById("nomePatrocinador").value = this.cells[2].innerHTML;
      document.getElementById("mailPatrocinador").value = this.cells[3].innerHTML;
      document.getElementById("celPatrocinador").value = this.cells[4].innerHTML;
    };
  }
}
selectedRowToInputPatrocinador();

function editHtmlTbleSelectedRowPatrocinador() {
  var idPatrocinador = document.getElementById("idPatrocinador").value,
    nomePatrocinador = document.getElementById("nomePatrocinador").value,
    emailPatrocinador = document.getElementById("mailPatrocinador").value,
    celPatrocinador = document.getElementById("celPatrocinador").value;
  if (!checkEmptyInput()) {
    tabelaPatrocinador.rows[rIndexPatrocinador].cells[0].innerHTML = idPatrocinador;
    tabelaPatrocinador.rows[rIndexPatrocinador].cells[2].innerHTML = nomePatrocinador;
    tabelaPatrocinador.rows[rIndexPatrocinador].cells[3].innerHTML = emailPatrocinador;
    tabelaPatrocinador.rows[rIndexPatrocinador].cells[4].innerHTML = celPatrocinador;
  }
}


/*** Valores Modal Editar Patrocinador ***/
var rIndexNotificacao, tabelaNotificacao = document.getElementById("listNot");

function selectedRowToInputNotificacao() {
  for (var i = 1; i < tabelaNotificacao.rows.length; i++) {
    tabelaNotificacao.rows[i].onclick = function () {
      rIndexNotificacao = this.rowIndexNotificacao;
      document.getElementById("idNot").value = this.cells[0].innerHTML;
      document.getElementById("editarTitulo").value = this.cells[1].innerHTML;
      document.getElementById("editarPatrocinador").value = this.cells[2].innerHTML;
      document.getElementById("editarStatus").value = this.cells[3].innerHTML;
      document.getElementById("descriptionNot").value = this.cells[4].innerHTML;
    };
  }
}
selectedRowToInputNotificacao();

function editHtmlTbleSelectedRowNotificacao() {
  var idNot = document.getElementById("idNot").value,
      editarTitulo = document.getElementById("editarTitulo").value,
      editarPatrocinador = document.getElementById("editarPatrocinador").value,
      editarStatus = document.getElementById("editarStatus").value;
      descriptionNot = document.getElementById("descriptionNot").value;
  if (!checkEmptyInput()) {
    tabelaNotificacao.rows[rIndexNotificacao].cells[0].innerHTML = idNot;
    tabelaNotificacao.rows[rIndexNotificacao].cells[1].innerHTML = editarTitulo;
    tabelaNotificacao.rows[rIndexNotificacao].cells[2].innerHTML = editarPatrocinador;
    tabelaNotificacao.rows[rIndexNotificacao].cells[3].innerHTML = editarStatus;
    tabelaNotificacao.rows[rIndexNotificacao].cells[4].innerHTML = descriptionNot;
  }
}


