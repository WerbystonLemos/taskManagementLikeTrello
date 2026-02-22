<x-app-layout >
    <input type="hidden" id="idProject" name="idProject" value="{{ $id }}">

    <div class="mainContainer"></div>

    <!-- modal add column -->
    <div id="modalAddColumn" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Coluna</h5>
                    <button type="button" class="btn-close modalAddColumn"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <input id="inputAddNameColumn" type="text" placeholder="Digite o nome da coluna..." />
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button id="btnSalvarModalAddColumn" type="button" class="btn btn-sm btn-primary" data-idProject="{{$id}}">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- modal edit task -->
    <div id="modalEditTask" class="modal modal-lg" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 id="titleNameTask" class="modal-title">NOME DA TASK</h5>
                    <button id="btnCloseModalEditTask" type="button" class="btn-close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="containerContentModalAddTask">
                        
                        <div id="containerDescriptionTask">
                            <div class="content-group d-flex align-items-center justify-content-center gap-2">
                                <input type="hidden" id="modalEditTaskColumnsId" name="modalEditTaskColumnsId"/>
                                <input type="hidden" id="modalEditTaskCreatedBy" name="modalEditTaskCreatedBy"/>
                                <input type="hidden" id="modalEditTaskTaskId" name="modalEditTaskTaskId"/>
                                <input type="hidden" id="modalEditTaskProjectId" name="modalEditTaskProjectId"/>
                                <input type="checkbox" id="statusTask" name="statusTask" />
                                <input type="text" id="nameTask" name="nameTask" value="Digite o título  da task" />
                            </div>
                            
                            <textarea name="descriptionTask" id="descriptionTask" placeholder="Adicione uma descrição mais detalhada..."></textarea>
                        </div>
                        
                        <div id="containerCommentTask">
                            <div id="titleInfo">
                                <i class="bi bi-info-circle"></i>
                                <p>Informações</p>
                            </div>
                            <div id="containerUserInfos">
                                <div id="profile" class="profile"></div>
                                <p>
                                    <span id="profileoWner" class="containerUserInfosUser"></span> adicionou esse cartão em <span id="dateUpdateTask" class="containerUserInfosDate"></span>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button id="btnEditTask" type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>    

    <!-- modal add task -->
    <div id="modalAddTask" class="modal modal-md"  tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Task</h5>
                    <button id="btnCloseModalAddTask" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div id="containerBodyModalAddTask" class="modal-body d-flex align-items-center justify-content-center gap-1.5">
                    <input name="inputColumnId" id="inputColumnId" type="hidden" />
                    <input name="inputProjectId" id="inputProjectId" type="hidden" />
                    <input id="inputChkbxStatusTask" type="checkbox" />
                    <input id="inputTitleTask" name="inputTitleTask" class="bordered rounded-2" type="text" placeholder="Digite o título da task..." />
                </div>
                
                <div class="modal-footer">
                    <button id="btnAddTask" type="button" class="btn btn-primary" data-iduser="{{Auth::user()->id}}">Salvar</button>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
@vite(['resources/css/dashboard.css','resources/js/dashboard/dashboard.js' ])