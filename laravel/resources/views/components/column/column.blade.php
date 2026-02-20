<div class="containerColuna">
            
    <!-- // header; -->
    <div class="headerColuna">
        <p class="titleColuna">cabecalho do quadro</p>
    </div>

    @for($x=0; $x<=2; $x++)
        <x-task.task name="" id="" titleTask="Minha task B" ></x-task.task>
    @endfor

    <!-- footer -->
    <div class="footerColuna">
        <button>
            <i class="bi bi-plus-lg"></i>
            Adicionar um cartão
        </button>
    </div>

</div>