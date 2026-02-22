import $ from 'jquery';

$(document).on('click', '.btnDeleteColumn', deleteColumn)
$("#btnSalvarModalAddColumn").on('click', saveColumn)
$(document).on('click', '.buttonHeadeColuna', showModalEditTask)
$("#btnShowModalAddColumn").on('click', showModalAddColumn) // exibe modal coluna
// $("#btnShowModalAddTask").on('click', )
$(".modalAddColumn").on('click', closeModalAddColumn)
$("#modalAddColumn").on('click', function (e) {
    if ($(e.target).closest('.modal-dialog').length === 0) {
        closeModalAddColumn();
    }
});
$(".btnCloseModalAddTask").on('click', closeModalAddTask) // omite modal add task
$("#modalAddTask").on('click', function (e) {
    if ($(e.target).closest('.modal-dialog').length === 0) {
        closeModalAddTask();
    }
});

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
    //limpar inputs do modal
    let idTask = $(this).data('idTask')
    //pegar infos da task com ajax
    // popular inputs da modal
    $("#modalAddTask").show()
}

function closeModalAddTask()
{
    $("#modalAddTask").hide()
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