import $ from 'jquery';
import Sortable from 'sortablejs';

loadAllColumnsAndTasks($("#idProject").val())

$(document).on('click', '.btnDeleteColumn', deleteColumn)
$("#btnSalvarModalAddColumn").on('click', saveColumn)
$(document).on('click', '#buttonHeadeColunaEdit', showModalEditTask)
$("#btnShowModalAddColumn").on('click', showModalAddColumn)
$(document).on('click', ".btnShowModalAddTaskColumn", showModalSaveTask)
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
$(document).on('click', '#buttonHeadeColunaDelete', deleteTask)
$(document).on('change', '.inputTask', changeStatusTask)
$(document).on('click', '#btnAddTask', saveTask)
$(document).on('click', '#btnEditTask', editTask)

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
    let idTask      = $(this).data('idtask')
    let columns_id  = $(this).data('colunaid')
    let created_by  = $(this).data('creator') 
    let project_id  = $(this).data('projectid') 

    $.ajax({
        url: `/api/task/${idTask}`,
        method: 'get',
        success: (resp) => {
            $("#titleNameTask").html(resp[0].name)
            $("#nameTask").val(resp[0].name)
            $("#statusTask").prop('checked', resp[0].status)
            $("#profile").html(gera_slug(resp[0].users.name))
            $("#profileoWner").html(resp[0].users.name)
            $("#dateUpdateTask").html(new Date(resp[0].updated_at).toLocaleString())
            $("#descriptionTask").html(resp[0].description)
            $("#modalEditTaskColumnsId").val(columns_id)
            $("#modalEditTaskCreatedBy").val(created_by)
            $("#modalEditTaskTaskId").val(idTask)
            $("#modalEditTaskProjectId").val(project_id)
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
    let tagAddColumn = `
        <div class="containerBtnAddColuna">
            <button id="btnShowModalAddColumn" class="footerColuna">
                <i class="bi bi-plus"></i> Adicionar outra lista
            </button>
        </div>
    `
    $(".mainContainer").html('')
    dataList.forEach( col => {
        tagHtmlTask = ''
        col.tasks.forEach( (task) => {
            
            tagHtmlTask += `
                <div class='containerTasks' data-id="${task.id}">
                    <div id="task_${task.id}" class='task' data-column="${col.id}">
                        <div class='titleTaskAndInput'>
                            <input class='inputTask' type='checkbox' data-idtask='${task.id}' ${task.status ? 'checked' : ''}/>
                            <span>${task.name}</span>
                        </div>

                        <div>
                            <button id='buttonHeadeColunaDelete' class="buttonHeadeColuna" data-idtask='${task.id}' title='Deletar Task'>
                                <i class="bi bi-trash3"></i>
                            </button>
                            <button id='buttonHeadeColunaEdit' class="buttonHeadeColuna" data-idtask='${task.id}' data-colunaid='${task.columns_id}' data-projectid='${task.created_by}' data-creator='${task.created_by}' title='Editar Task'>
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

                <div class="tasksList" data-column="${col.id}">
                    ${tagHtmlTask}
                </div>

                <!-- footer -->
                <div class="footerColuna">
                    <button class="btnShowModalAddTaskColumn" data-idproject="${col.project_id}" data-idcolumn="${col.id}"> <!--project_id-->
                        <i class="bi bi-plus-lg"></i>
                        Adicionar um cartão
                    </button>
                </div>
            </div>
        `
        
    });

    $(".mainContainer").prepend(tagHtmlCol+tagAddColumn)
    activateDragAndDrop()
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

function deleteTask()
{
    let idTask = $(this).data('idtask')
    
    $.ajax({
        url: `/api/task/${idTask}`,
        method: 'delete',
        success: (resp) => {
            console.log(resp)
            $(`#task_${idTask}`).remove()
        },
        error: err => console.log(err)
    })
}

function changeStatusTask()
{
    let idTask = $(this).data('idtask')
    let status = $(this).is(':checked')

    console.log(status)
    
    $.ajax({
        url: `/api/task/${idTask}`,
        method: 'patch',
        data: { 'status': status },
        success: (resp) => console.log(resp),
        error: (err) => console.log(err)
    })
}

function saveTask()
{
    let inputColumnId           = $("#inputColumnId").val()
    let inputProjectId          = $("#inputProjectId").val()
    let inputChkbxStatusTask    = $("#inputChkbxStatusTask").is(':checked')
    let inputTitleTask          = $("#inputTitleTask").val()
    let userId                  = $(this).data('iduser')

    $.ajax({
        url: `/api/task`,
        method: 'post',
        data: {
            columns_id: inputColumnId,
            status: inputChkbxStatusTask,
            name: inputTitleTask,
            user_id: userId,
        },
        success: (res) => {
            console.log(res)
            loadAllColumnsAndTasks(inputProjectId)
        },
        error: (err) => console.log(err),
        complete: closeModalAddTask()
    })
}

function editTask()
{
    let name        = $('#nameTask').val()
    let description = $('#descriptionTask').val()
    let status      = $('#statusTask').is(':checked')
    let columns_id  = $('#modalEditTaskColumnsId').val()
    let created_by  = $('#modalEditTaskCreatedBy').val()
    let idTask      = $('#modalEditTaskTaskId').val()
    let idProject   = $('#modalEditTaskProjectId').val()

    $.ajax({
        url: `/api/task/edit/${idTask}`,
        method: 'patch',
        data: {
            "name": name,
            "description": description,
            "status": status,
            "columns_id": columns_id,
            "created_by": created_by
        },
        success: resp => {
            loadAllColumnsAndTasks(idProject)
            closeModalEditTask()
        }
    })
}

function activateDragAndDrop()
{
    $(".tasksList").each(function () {

        new Sortable(this, {
            group: 'shared',
            animation: 150,

            onEnd: function (evt) {
                let columnId = $(evt.to).data('column')
                let orderedIds = []

                $(evt.to).children('.containerTasks').each(function () {
                    orderedIds.push($(this).data('id'))
                })

                updateTasksOrder(columnId, orderedIds)
            }
        });

    });

    new Sortable(document.querySelector(".mainContainer"), {
        animation: 150,
        draggable: ".containerColuna",

        onEnd: function (evt) {
            let orderedColumns = []

            $(".mainContainer").children(".containerColuna").each(function () {
                orderedColumns.push($(this).data("id"))
            })

            updateColumnsOrder(orderedColumns)
        }
    })
}

function updateTasksOrder(columnId, orderedIds)
{
    $.ajax({
        url: `/api/task/reorder`,
        method: 'PATCH',
        data: {
            column_id: columnId,
            ordered_ids: orderedIds
        },
        success: resp => console.log(resp),
        error: err => console.log(err)
    })
}

function updateColumnsOrder(orderedColumns)
{
    $.ajax({
        url: `/api/column/reorder`,
        method: 'patch',
        data: { ordered_ids: orderedColumns },
        success: resp => console.log(resp),
        error: err => console.log(err)
    })
}