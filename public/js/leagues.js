function saveEditLeague($dataArray) {
  $("#btn-edit-league").attr("disabled", "disabled");
  $.ajax({
    type: "POST",
    url: siteUrl+'/api/leagues/edit/?id=' + $dataArray.id,
    timeout: 0,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    dataType: "json",
    data: JSON.stringify({
      referal_league_id: $('#edit-league [name="referal_league_id"]').val(),
      name: $('#edit-league [name="name"]').val(),
      country: $('#edit-league [name="country"]').val(),
      logo: $('#edit-league [name="logo"]').val(),
      flag: $('#edit-league [name="flag"]').val(),
    }),
    success: function (data) {
      $("#msg-send-edit").html(
        `<div class="alert alert-success" role="alert">Alterado com sucesso!</div>`
      );
      console.log(data);

      $("#btn-edit-league").attr("disabled", "disabled");
      listAllLeagues();
    },
    error: function (xhr, textStatus, error) {
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
      $("#btn-edit-league").removeAttr("disabled");
      $("#msg-send-edit").html(
        `<div class="alert alert-danger" role="alert">Ocorreu um erro no cadastro.</div>`
      );
    },
  });
}

function showEditData(id) {
  $.ajax({
    type: "GET",
    url: siteUrl+'/api/leagues-by-id/?id=' + id,
    timeout: 0,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    dataType: "json",
    success: function (data) {
      $('#edit-league [name="referal_league_id"]').val(data.referal_league_id);
      $('#edit-league [name="name"]').val(data.name);
      $('#edit-league [name="flag"]').val(data.flag);
      $('#edit-league [name="country"]').val(data.country);
      $('#edit-league [name="logo"]').val(data.logo);
      let jsonLeague = {
        id: data.id,
        referal_league_id: data.referal_league_id,
        name: data.name,
        flag: data.flag,
        country: data.country,
        logo: data.logo,
      };
      $('input[name="json-league"]').val(JSON.stringify(jsonLeague));
    },
    error: function (xhr, textStatus, error) {
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
    },
  });
}

function confirmDelete(id) {
  let inputId = $('input[name="id-league"]').val(id);
  //pagar informacoes da League
  getLeagueById(id);
}

function editLeague() {
  let legueObject = $('input[name="json-league"]').val();
  legueObject = JSON.parse(legueObject);
  $("#btn-edit-league").removeAttr("disabled");

  saveEditLeague(legueObject);
}

function saveLeague($dataArray = []) {
  $("#btn-save-league").attr("disabled", "disabled");
  $.ajax({
    type: "POST",
    url: siteUrl+'/api/leagues',
    timeout: 0,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    dataType: "json",
    data: JSON.stringify({
      referal_league_id: $dataArray.referal_league_id,
      name: $dataArray.name,
      country: $dataArray.country,
      logo: $dataArray.logo,
      flag: $dataArray.flag,
      createdAt: "2023-04-20 14:04:31",
    }),
    success: function (data) {
      $("#msg-send").html(
        `<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>`
      );
      //clear form data
      $(":input", "#add-league")
        .not(":button, :submit, :reset, :hidden")
        .val("");
      $("#btn-save-league").attr("disabled", "disabled");
    },
    error: function (xhr, textStatus, error) {
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
      $("#btn-save-league").removeAttr("disabled");
      $("#msg-send").html(
        `<div class="alert alert-danger" role="alert">Ocorreu um erro no cadastro.</div>`
      );
    },
  });
}

function addLeague() {
  const formData = $("form#add-league").serializeArray();
  dataArray = [];
  let referal_league_id,
    name,
    country,
    logo,
    flag = "";
  let league_id_value,
    name_value,
    country_value,
    logo_value,
    flag_value = "";
  $.each(formData, function (i, field) {
    if (field.name === "referal_league_id") {
      referal_league_id = field.name;
      league_id_value = field.value;
    }
    if (field.name === "name") {
      name = field.name;
      name_value = field.value;
    }
    if (field.name === "country") {
      country = field.name;
      country_value = field.value;
    }
    if (field.name === "logo") {
      logo = field.name;
      logo_value = field.value;
    }
    if (field.name === "flag") {
      flag = field.name;
      flag_value = field.value;
    }
    dataArray.push({
      referal_league_id: league_id_value,
      name: name_value,
      country: country_value,
      logo: logo_value,
      flag: flag_value,
    });
  });
  //teste de envio
  console.log(dataArray.length);
  if (dataArray.length === 5) {
    //processar o envio das informações
    saveLeague(dataArray[4]);
  } else {
    $("#msg-send").html(
      `<div class="alert alert-danger" role="alert">Ocorreu um erro no cadastro.  Preencha todos os campos.</div>`
    );
  }
}

function getLeagueById(id){
    $('input[name="json-league"]').val('');
    $.ajax({
        type: 'GET',
        url: siteUrl+'/api/leagues-by-id/?id='+id,
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        success: function(data){
            
            let jsonLeague = {
                id : data.id,
                referal_league_id : data.referal_league_id,
                name : data.name,
                flag : data.flag,
                country : data.country,
                logo :  data.logo,
            };
            //adionar ao html do modal
            $('span#referal_id_league').html(data.referal_league_id);
            $('span#name_league').html(data.name);
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}
function searchLeaguesByName(){

    let name =$('#search-leagues-name').val();
    if(name !== ""){
        $.ajax({
            type: 'GET',
            url: siteUrl+'/api/leagues/search/?name='+name,
            timeout: 0,
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            dataType: "json",
            success: function(data){
                console.log(data);
                let html = ``;
                for (let index = 0; index < data.success.length; index++) {
                    html += `<tr>
                        <td>${data.success[index].referal_league_id}</td>
                        <td>${data.success[index].name}</td>
                        <td>${data.success[index].country}</td>
                        <td>${data.success[index].flag}</td>
                        <td>${data.success[index].logo}</td>
                        <td>
                            <a href="#editLeagueModal" onclick="enableButton();showEditData(${data.success[index].id})"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteleagueModal" onclick="enableButton();confirmDelete(${data.success[index].id});" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>`;
                    
                }
                if(data.success.length == 0){
                    html += `<tr>
                        <td colspan="6">Nenhum registro correspondente. <a href="#reload" onclick="listAllLeagues();">Clique aqui</a> para recarregar os dados.</td>
                        
                    </tr>`;
                }
                
                $('#table-league').html(html); 
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
               
            }
        });
    } else {
        listAllLeagues();
    }
}
function deleteLeague(){
    
    let id = $('input[name="id-league"]').val();
    $('#btn-delete-league').attr("disabled", "disabled");
    //onclick="deleteLeague(${data[index].id})"
    $.ajax({
        type: 'DELETE',
        url: siteUrl+'/api/leagues/delete/?id='+id,
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        success: function(data){
            console.log(data);
            listAllLeagues();
            $('#msg-send-delete').html(`<div class="alert alert-success" role="alert">Apagado com sucesso!</div>`);
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
            $('#msg-send-delete').html(`<div class="alert alert-danger" role="alert">Ocorreu um erro ao apagar.</div>`);
        }
    });
}
function listAllLeagues(){
    //table-league
    $.ajax({
        type: 'GET',
        url: siteUrl+'/api/leagues',
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        success: function(data){
            console.log(data);
            let html = ``;
            for (let index = 0; index < data.length; index++) {
                html += `<tr>
                    <td>${data[index].referal_league_id}</td>
                    <td>${data[index].name}</td>
                    <td>${data[index].country}</td>
                    <td>${data[index].flag}</td>
                    <td>${data[index].logo}</td>
                    <td>
                        <a href="#editLeagueModal" onclick="enableButton();showEditData(${data[index].id})"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <a href="#deleteleagueModal" onclick="enableButton();confirmDelete(${data[index].id});" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                    </td>
                </tr>`;
                
            }
            
            $('#table-league').html(html);
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}
