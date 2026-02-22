<x-app-layout >

    <div class="mainContainer">
        
        @foreach( \App\Http\Controllers\ColumnController::getColumnsWithTasksByProjectId($id) as $column)
        <div class="containerColuna" data-id="{{ $column->id }}">
            
            <!-- // header; -->
            <div class="headerColuna">
                <p class="titleColuna">{{$column->name}}</p>
                <button class="btnDeleteColumn" data-idcolumn="{{ $column->id }}" >
                    <i class="bi bi-trash3"></i>
                </button>
            </div>

            @foreach($column->tasks as $task)
            <div class="task">
                <div class="titleTaskAndInput">
                    <input class="inputTask" type="checkbox" name="" id="">
                    {{$task->name}}
                </div>
                <button class="buttonHeadeColuna" data-idTask="{{$task->id}}"><i class="bi bi-pencil-square"></i></button>
            </div>
            @endforeach

            <!-- footer -->
            <div class="footerColuna">
                <button id="btnShowModalAddTask" class="btnShowModalAddTaskColumn">
                    <i class="bi bi-plus-lg"></i>
                    Adicionar um cartão
                </button>
            </div>

        </div>
        @endforeach

        <div class="containerBtnAddColuna">
            <button id="btnShowModalAddColumn" class="footerColuna">
                <i class="bi bi-plus"></i> Adicionar outra lista
            </button>
        </div>
    
    </div>

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
    
    <!-- modal add task -->
     <div id="modalAddTask" class="modal modal-lg" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">NOME DA TASK</h5>
                    <button type="button" class="btn-close btnCloseModalAddTask"></button>
                </div>
                
                <div class="modal-body">
                    <div class="containerContentModalAddTask">
                        
                        <div id="containerDescriptionTask">
                            <div class="content-group">
                                <input type="checkbox" id="statusTask" name="statusTask" />
                                <input type="" id="nameTask" name="nameTask" value="Digite o título  da task" />
                            </div>
                            
                            <textarea name="descriptionTask" id="descriptionTask" placeholder="Adicione uma descrição mais detalhada..."></textarea>
                        </div>
                        
                        <div id="containerCommentTask">
                            <div id="titleInfo">
                                <i class="bi bi-chat-left-dots"></i> 
                                <p>Comentários</p>
                            </div>
                            <div id="containerUserInfos">
                                <div class="profile">
                                    {{ gera_slug(Auth::user()->name)}}
                                </div>
                                <p>
                                    <span class="containerUserInfosUser">{{Auth::user()->name}}</span> adicionou esse cartão em <span class="containerUserInfosDate">{{date('d/m/Y H:m')}}</span>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>    

</x-app-layout>
@vite(['resources/css/dashboard.css','resources/js/dashboard/dashboard.js' ])