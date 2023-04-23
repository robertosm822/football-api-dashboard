const siteUrl = $('input[name="url_site"]').val();
function editTeam()
{
    let teamObject = $('input[name="json-team"]').val();
    teamObject = JSON.parse(teamObject);
    $('#btn-edit-team').removeAttr("disabled");

    saveEditTeam(teamObject);
}
function saveEditTeam($dataArray)
{
    $('#btn-edit-team').attr('disabled', 'disabled');
    $.ajax({
        type: 'POST',
        url: siteUrl + '/api/teams/edit/?id=' + $dataArray.id,
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        data: JSON.stringify({
            referal_league_id: $('#edit-team [name="referal_team_id"]').val(),
            name: $('#edit-team [name="name"]').val(),
            country: $('#edit-team [name="country"]').val(),
            logo: $('#edit-team [name="logo"]').val(),
            flag: $('#edit-team [name="flag"]').val()
        }),
    success: function (data) {
        $('#msg-send-team-edit').html(` < div class = "alert alert-success" role = "alert" > Alterado com sucesso! < / div > `);
        console.log(data);

        $('#btn-edit-team').attr('disabled', 'disabled');
        listAllTeams();
    },
        error: function (xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
            $('#btn-edit-team').removeAttr("disabled");
            $('#msg-send-team-edit').html(` < div class = "alert alert-danger" role = "alert" > Ocorreu um erro no cadastro.< / div > `);
        }
    });
}

function showEditDataTeam(id)
{
    $.ajax({
        type: 'GET',
        url: siteUrl + '/api/teams/get-by-id/?id=' + id,
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#edit-team [name="referal_team_id"]').val(data.referal_team_id);
            $('#edit-team [name="name"]').val(data.name);
            $('#edit-team [name="league"]').val(data.league);
            $('#edit-team [name="country"]').val(data.country);
            $('#edit-team [name="logo"]').val(data.logo);
            let jsonTeam = {
                id : data.id,
                referal_league_id : data.referal_team_id,
                name : data.name,
                league: data.league,
                country : data.country,
                logo :  data.logo,
            };
            $('input[name="json-team"]').val(JSON.stringify(jsonTeam));
        },
        error: function (xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function enableButtonTeam()
{
    $('#btn-save-team').removeAttr("disabled");
    $('#btn-edit-team').removeAttr("disabled");
    $('#btn-delete-team').removeAttr("disabled");
    $('#msg-send-team').html('');
    $('#msg-send-team-edit').html('');
    $('#msg-send-team-delete').html('');
}

function activeMenu()
{
    let currentLocation = window.location.pathname;
    if (currentLocation === '/teams/index') {
        $('#league-menu').removeClass('active');
        $('#team-menu').addClass('active');
    } else {
        $('#team-menu').removeClass('active');
        $('#league-menu').addClass('active');
    }

}
//versao para Teams
function addTeam()
{
    const formData = $("form#add-team").serializeArray();
    dataArray = [];
    let referal_team_id, league,name, logo,country = "";
    let team_id_value, name_value,country_value, logo_value = "";
    $.each(formData, function (i, field) {
        if (field.name === "referal_team_id") {
            referal_team_id = field.name;
            team_id_value = field.value;
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

        dataArray.push({
            referal_team_id : team_id_value,
            name : name_value,
            country: country_value,
            logo: logo_value
        });

    });
    //teste de envio
    console.log(dataArray);
    if (dataArray.length === 5) {
        //processar o envio das informações
        saveTeam(dataArray[4]);
    } else {
        $('#msg-send-team').html(` < div class = "alert alert-danger" role = "alert" > Ocorreu um erro no cadastro.  Preencha todos os campos.< / div > `);
    }

}

function saveTeam($dataArray=[])
{

    $('#btn-save-league').attr('disabled', 'disabled');
    $.ajax({
        type: 'POST',
        url: siteUrl + '/api/teams/save',
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        data: JSON.stringify({
            referal_team_id: $dataArray.referal_team_id,
            name: $dataArray.name,
            country: $dataArray.country,
            logo: $dataArray.logo,
            createdAt: ''
        }),
    success: function (data) {
        $('#msg-send-team').html(` < div class = "alert alert-success" role = "alert" > Cadastrado com sucesso! < / div > `);
        //clear form data
        $(':input','#add-team')
        .not(':button, :submit, :reset, :hidden')
        .val('');
        $('#btn-save-team').attr('disabled', 'disabled');
    },
        error: function (xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
            $('#btn-save-team').removeAttr("disabled");
            $('#msg-send-team').html(` < div class = "alert alert-danger" role = "alert" > Ocorreu um erro no cadastro.< / div > `);
        }
    });
}

function confirmDeleteTeam(id)
{
    let inputId = $('input[name="id-team"]').val(id);
   //pagar informacoes da League
    getTeamById(id);

}
function deleteTeam()
{
    let id = $('input[name="id-team"]').val();
    $("#btn-delete-team").attr("disabled", "disabled");
    //onclick="deleteLeague(${data[index].id})"
    $.ajax({
        type: "DELETE",
        url: siteUrl + '/api/teams/delete/?id=' + id,
        timeout: 0,
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            listAllTeams();
            $("#msg-send-team-delete").html(
                ` < div class = "alert alert-success" role = "alert" > Apagado com sucesso! < / div > `
            );
        },
        error: function (xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
            $("#msg-send-team-delete").html(
                ` < div class = "alert alert-danger" role = "alert" > Ocorreu um erro ao apagar.< / div > `
            );
        },
    });
}
function getTeamById(id)
{
    $('input[name="json-team"]').val("");
    $.ajax({
        type: "GET",
        url: siteUrl + '/api/teams/get-by-id/?id=' + id,
        timeout: 0,
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        dataType: "json",
        success: function (data) {
            let jsonLeague = {
                id: data.id,
                referal_team_id: data.referal_team_id,
                name: data.name,
                league: data.league,
                country: data.country,
                logo: data.logo,
            };
          //adionar ao html do modal
            $("span#referal_id_team").html(data.referal_team_id);
            $("span#name_team").html(data.name);
        },
        error: function (xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        },
    });
}

function listAllTeams()
{
    //table-league
    $.ajax({
        type: 'GET',
        url: siteUrl + '/api/teams/list/',
        timeout: 0,
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        dataType: "json",
        success: function (data) {
            console.log(data[0]);
            let html = ``;
            for (let index = 0; index < data.length; index++) {
                html += ` < tr >
                    < td > ${data[index].referal_team_id} < / td >
                    < td > ${data[index].name} < / td >
                    < td > ${data[index].country} < / td >
                    < td > ${data[index].logo} < / td >
                    < td >
                        < a href = "#editTeamModal" onclick = "enableButtonTeam();showEditDataTeam(${data[index].id})"  class = "edit" data - toggle = "modal" > < i class = "material-icons" data - toggle = "tooltip" title = "Edit" > & #xE254; < / i > < / a >
                        < a href = "#deleteTeamModal" onclick = "enableButtonTeam();confirmDeleteTeam(${data[index].id});" class = "delete" data - toggle = "modal" > < i class = "material-icons" data - toggle = "tooltip" title = "Delete" > & #xE872; < / i > < / a >
                    <  / td >
                <  / tr > `;
            }

            $('#table-team').html(html);
        },
        error: function (xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function enableButton()
{
    $('#btn-save-league').removeAttr("disabled");
    $('#btn-edit-league').removeAttr("disabled");
    $('#btn-delete-league').removeAttr("disabled");
    $('#msg-send').html('');
    $('#msg-send-edit').html('');
    $('#msg-send-delete').html('');
}

//mudar acao do botao do header
function modifyActionButton()
{
    let currentLocation = window.location.pathname;
    if (currentLocation === '/teams/index') {
        $('#btn-search').attr('onclick', 'searchTeamsByName()');
    } else {
        $('#btn-search').attr('onclick', 'searchLeaguesByName()');
    }
}

function searchTeamsByName()
{
    let name = $("#search-leagues-name").val();

    if (name !== "") {
        $.ajax({
            type: "GET",
            url: siteUrl + '/api/teams/search/?name=' + name,
            timeout: 0,
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            dataType: "json",
            success: function (data) {
                console.log(data.success[0]);
                let html = ``;
                for (let index = 0; index < data.success.length; index++) {
                    html += ` < tr >
                            < td > ${data.success[index].referal_team_id} < / td >
                            < td > ${data.success[index].name} < / td >
                            < td > ${data.success[index].country} < / td >
                            < td > ${data.success[index].logo} < / td >
                            < td >
                                < a href = "#editTeamModal" onclick = "enableButtonTeam();showEditDataTeam(${data.success[index].id})"  class = "edit" data - toggle = "modal" > < i class = "material-icons" data - toggle = "tooltip" title = "Edit" > & #xE254; < / i > < / a >
                                < a href = "#deleteTeamModal" onclick = "enableButtonTeam();confirmDeleteTeam(${data.success[index].id});" class = "delete" data - toggle = "modal" > < i class = "material-icons" data - toggle = "tooltip" title = "Delete" > & #xE872; < / i > < / a >
                            <  / td >
                      <  / tr > `;
                }
                if (data.success.length == 0) {
                    html += ` < tr >
                          < td colspan = "6" > Nenhum registro correspondente. <a href = "#reload" onclick = "listAllLeagues();" > Clique aqui < / a > para recarregar os dados.< / td >

                      <  / tr > `;
                }

                $("#table-team").html(html);
            },
            error: function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            },
        });
    } else {
        listAllLeagues();
    }
}