import $ from 'jquery';
showModalAddTask()

// exibe modal coluna
$("#btnShowModalAddColumn").on('click', showModalAddColumn)
$("#btnShowModalAddTask").on('click', showModalAddTask)
// omite modal add coluna
$(".modalAddColumn").on('click', closeModalAddColumn)
$("#modalAddColumn").on('click', function (e) {
    if ($(e.target).closest('.modal-dialog').length === 0) {
        closeModalAddColumn();
    }
});
// omite modal add task
$(".btnCloseModalAddTask").on('click', closeModalAddTask)
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