import $ from 'jquery';

loadAllColumnsAndTasks($("#idProject").val())
$(document).on('click', '.btnDeleteColumn', deleteColumn)
$("#btnSalvarModalAddColumn").on('click', saveColumn)
$(document).on('click', '#buttonHeadeColunaEdit', showModalEditTask)
$("#btnShowModalAddColumn").on('click', showModalAddColumn)
$(".btnShowModalAddTaskColumn").on('click', showModalSaveTask)
$(".modalAddColumn").on('click', closeModalAddColumn)
$("#modalAddColumn").on('click', function (e) {
    if ($(e.target).closest('.modal-dialog').length === 0) {
        closeModalAddColumn();
    }
});
$("#btnCloseModalEditTask").on('click', closeModalEditTask)
$(document).on('click', "#modalEditTask", function (e) {
    if ($(e.target).closest('.modal-dialog').length === 0) {
        closeModalEditTask();
    }
});
$("#btnCloseModalAddTask").on('click', closeModalAddTask)
$(document).on('click', '#modalAddTask', function (e) {
    if ($(e.target).closest('.modal-dialog').length === 0)
    {
        closeModalAddTask()
    }
})

function showModalAddColumn()
{
    $("#modalAddColumn").show()
}

function closeModalAddColumn()
{
    $("#modalAddColumn").hide()
}

function showModalEditTask()
{
    let idTask          = $(this).data('idtask')

    $.ajax({
        url: `/api/task/${idTask}`,
        method: 'get',
        success: (resp) => {
            console.log(resp[0])
            $("#titleNameTask").html(resp[0].name)
            $("#nameTask").val(resp[0].name)
            $("#statusTask").prop('checked', resp[0].status)
            $("#profile").html(gera_slug(resp[0].users.name))
            $("#profileoWner").html(resp[0].users.name)
            $("#dateUpdateTask").html(new Date(resp[0].updated_at).toLocaleString())
            $("#descriptionTask").html(resp[0].description)
        },
        error: err => console.log(err)
    })

    $("#modalEditTask").show()
}

function closeModalEditTask()
{
    $("#modalEditTask").hide()
}

function saveColumn()
{
    let idproject = $(this).data('idproject')
    let titleColumn = $("inputAddNameColumn").val()

    $.ajax({
        url: '/api/saveColumn',
        methos: 'post',
        data: {
            'name': titleColumn,
            'project_id': idproject,
        },
        success: () => {},
        error: (err) => console.log(err)
    })
}

async function deleteColumn()
{
    let idColumn = $(this).data('idcolumn')
    
    await $.ajax({
        url: `/api/deleteColumn/${idColumn}`,
        method: 'delete',
        success: () => $(`div[data-id=${idColumn}]`).remove(),
        error: (err) => console.log(err)
    })
}

function showModalSaveTask()
{
    $("#modalAddTask").show()
    let idProject   = $(this).data('idproject')
    let idColumn    = $(this).data('idcolumn')
    
    $("#inputProjectId").val(idProject)
    $("#inputColumnId").val(idColumn)
}

function closeModalAddTask()
{
    $("#modalAddTask").hide()
}

function loadAllColumnsAndTasks(id)
{
    $.ajax({
        url: `/api/columnsWithTasksByIdProject/${id}`,
        method: 'get',
        success: (resp) => {
            makeHtmlREnder(resp)
        },
        error: err => console.log(err),
    })
}

/**
 * recebe o array com todas colunas e suas task
 * e gera o html a ser renderizado na dashboard
 * 
 * @param {array} dataList 
 */
function makeHtmlREnder(dataList)
{
    let tagHtmlCol  = ''
    let tagHtmlTask = ''

    dataList.forEach( col => {
        tagHtmlTask = ''
        col.tasks.forEach( (task) => {
            tagHtmlTask += `
                <div class='containerTasks'>
                    <div class='task'>
                        <div class='titleTaskAndInput'>
                            <input class='inputTask' type='checkbox' name='' id=''>
                            <span>${task.name}</span>
                        </div>

                        <div>
                            <button id='buttonHeadeColunaDelete' class="buttonHeadeColuna" data-idtask='${task.id}'>
                                <i class="bi bi-trash3"></i>
                            </button>
                            <button id='buttonHeadeColunaEdit' class="buttonHeadeColuna" data-idtask='${task.id}'>
                                <i class='bi bi-pencil-square'></i>
                            </button>
                        </div>
                    </div>
                </div>
            `
            
        })

        tagHtmlCol += `
            <div class="containerColuna" data-id="${col.id}">

                <!-- // header; -->
                <div class="headerColuna">
                    <p class="titleColuna">${col.name}</p>
                    <button class="btnDeleteColumn" data-idcolumn="${col.name}" >
                        <i class="bi bi-trash3"></i>
                    </button>
                </div>

                ${tagHtmlTask}

                <!-- footer -->
                <div class="footerColuna">
                    <button id="btnShowModalAddTask" class="btnShowModalAddTaskColumn" data-idproject="${col.project_id}" data-idcolumn="${col.project_id}">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar um cartão
                    </button>
                </div>

            </div>
        `
        
    });

    $(".mainContainer").prepend(tagHtmlCol)
}

function gera_slug(nome)
{
    let partes = nome.trim().split(/\s+/);

    if ( partes.length === 1) {
        return nome.slice(0, 2).toUpperCase();

    }

    return (
        partes[0].slice(0, 1) +
        partes[partes.length - 1].slice(0, 1)
    ).toUpperCase();
}