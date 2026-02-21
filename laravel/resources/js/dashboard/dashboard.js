import $ from 'jquery';

$("#btnShowModalAddColumn").on('click', showModalAddColumn) // exibe modal coluna
$("#btnShowModalAddTask").on('click', showModalAddTask) // omite modal add coluna
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

function showModalAddTask()
{
    $("#modalAddTask").show()
}

function closeModalAddTask()
{
    $("#modalAddTask").hide()
}