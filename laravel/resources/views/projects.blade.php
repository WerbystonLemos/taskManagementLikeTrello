
<x-app-layout >

    <div class="mainContainer">
        
    <div class="row">
        <div id="aside" class="col-3">
            
            <button>
                <div id="menuOptionProject">
                    <i class="bi bi-trello"></i> Quadros
                </div>
            </button>

            <hr>

            <div id="contaierAreaUser">
                <div>
                    <h3>Área do Usuário</h3>
                </div>
                <div id="asideAreaUser">
                    <div id="profile">{{ gera_slug(Auth::user()->name )}}</div>
                    <span>{{ (Auth::user()->name )}}</span>
                </div>
            </div>

        </div>
        
        <div id="projectContainer" class="col-9"></div>
        
    </div>
    
    <div id="modalAddProject" class="modal" tabindex="-1">
        
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Projeto</h5>
                    <button id="btnCloseModalAddProject" type="button" class="btn-close"></button>
                </div>
                
                <div id="containerMainModal" class="modal-body">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="text" name="inputNameProject" id="inputNameProject" placeholder="Digite o nome do projeto" />
                    <textarea name="inputdescriptionProject" id="inputdescriptionProject" placeholder="Digite uma descrição mais detalhada..."></textarea>
                </div>
                
                <div class="modal-footer">
                    <button id="btnSaveProject" type="button" class="btn btn-sm btn-primary">Salvar</button>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
@vite(['resources/css/projects.css', 'resources/js/projects.js' ])