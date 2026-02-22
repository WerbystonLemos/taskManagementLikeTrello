import $ from 'jquery'

$(document).on('click', '.btnDestroyProject', function(e) {
    if ($(e.target).closest('.headerProject').length === 1)
    {
        let id = $(this).data('id')
        deleteProject(id)
    }
})
$(document).on('click', '#btnSaveProject', saveProject)
$("#btnCloseModalAddProject").on('click', closeModalAddProject)
$("#modalAddProject").on('click', function(e) {
    if( $(e.target).closest('.modal-dialog').length === 0 )
    {
        closeModalAddProject()
    }
})

$(document).on('click', '#btnQuadroAdd', showModalAddProject)
$(document).on('click', '.projectName', function() {
    let id = $(this).data('id')
    window.open(`/dashboard/${id}`, '_self')
})

window.onload = () => {
    loadingProjects()
}

function loadingProjects()
{
    let htmlTag = `<div id="btnQuadroAdd" class="">
                        <span>Criar novo quadro</span>
                    </div>`
    $.ajax({
        url: 'api/projects',
        success: (resp) => {
            resp.forEach( el => {
                htmlTag += `<div class="containerProject" data-id='${el.id}'>
                    <div class="project">
                        <div class="headerProject">
                            <button class="btnDestroyProject" data-id="${el.id}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                        <div class="projectName" data-id="${el.id}">
                            <span>${el.name}</span>
                        </div>
                    </div>
                </div>`
            });
            $("#projectContainer").append(htmlTag)
        },
        error: err => {
            console.log(err)
        },
        
    })
}

function showModalAddProject()
{
    $("#modalAddProject").show()
}

function closeModalAddProject()
{
    $("#modalAddProject").hide()
}

function saveProject()
{
    let nameProject         = $('#inputNameProject').val()
    let textareaDescription = $('#inputdescriptionProject').val()
    let user_id             = $('input[name=user_id]').val()

    $.ajax({
        url: '/api/saveProject',
        method: 'POST',
        data: { 
            nameProject: nameProject,
            description: textareaDescription,
            user_id: user_id,
        },
        success: () => loadingProjects(),
        error: err => console.log(err.responseJSON?.message),
        complete: closeModalAddProject()
    })
}

async function deleteProject(id)
{
    await $.ajax({
        url: `/api/destroy/${id}`,
        method: 'delete',
        success: () => {
            $(`div[data-id=${id}]`).remove()
        },
        error: (err) => console.log(err),
    })
}